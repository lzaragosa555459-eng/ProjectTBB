<?php

namespace App\Services;

use App\Models\Inventory_Stock;
use App\Models\Inventory_Transactions;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class InventoryService
{
    public function deductForOrder(Order $order, User $user): void
    {
        DB::transaction(function () use ($order, $user) {

            $alreadyDeducted = Inventory_Transactions::where(
                'reference_type',
                'Order'
            )
                ->where(
                    'reference_id',
                    $order->id
                )
                ->exists();

            if ($alreadyDeducted) {
                return;
            }

            foreach ($order->orderItems as $orderItem) {

                foreach ($orderItem->menuItem->recipeItems as $recipeItem) {

                    $quantityUsed =
                        $recipeItem->quantity_required
                        * $orderItem->quantity;

                    $this->deductStock(
                        $recipeItem->inventory_item_id,
                        $quantityUsed,
                        $user,
                        $order
                    );
                }

                foreach ($orderItem->options as $selectedOption) {

                    $adjustments =
                        $orderItem->menuItem
                        ->recipeAdjustments()
                        ->where(
                            'option_value_id',
                            $selectedOption->option_value_id
                        )
                        ->get();

                    foreach ($adjustments as $adjustment) {

                        $quantityUsed =
                            $adjustment->quantity_adjustment
                            * $orderItem->quantity;

                        $this->deductStock(
                            $adjustment->inventory_item_id,
                            $quantityUsed,
                            $user,
                            $order
                        );
                    }
                }
            }
        });
    }

    private function deductStock(
        int $inventoryItemId,
        float $quantity,
        User $user,
        Order $order
    ): void {
        $stock = Inventory_Stock::where(
            'inventory_item_id',
            $inventoryItemId
        )
            ->lockForUpdate()
            ->first();

        if (!$stock) {
            throw new RuntimeException(
                'No inventory stock record found.'
            );
        }

        if ($stock->current_quantity < $quantity) {
            throw new RuntimeException(
                'Insufficient inventory stock.'
            );
        }

        $stock->decrement(
            'current_quantity',
            $quantity
        );

        Inventory_Transactions::create([
            'inventory_stock_id' => $stock->id,
            'supplier_id' => null,
            'recorded_by' => $user->id,
            'transaction_type' => 'Sale',
            'quantity' => -$quantity,
            'unit_cost' => null,
            'reference_type' => 'Order',
            'reference_id' => $order->id,
            'reason' => 'Inventory used for order ' . $order->order_number,
            'transaction_date' => now(),
        ]);
    }
}
