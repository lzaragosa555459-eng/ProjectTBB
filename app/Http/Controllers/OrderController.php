<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Menu_Items;
use App\Models\Option_Values;
use App\Models\Order_Item;
use App\Models\Order_Item_Options;
use App\Models\Kitchen_Order_Item;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cashier_id' => 'required|exists:users,id',
            'order_type' => 'required|string|max:50',
            'items' => 'required|array|min:1',

            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.notes' => 'nullable|string',

            'items.*.options' => 'nullable|array',
            'items.*.options.*' => 'exists:option_values,id',
        ]);
        $subtotal = 0;

        foreach ($validated['items'] as $item) {

            $menuItem = Menu_Items::findOrFail(
                $item['menu_item_id']
            );

            $itemPrice = $menuItem->base_price;

            if (!empty($item['options'])) {
                foreach ($item['options'] as $optionId) {

                    $option = Option_Values::findOrFail($optionId);

                    $itemPrice += $option->price_adjustment;
                }
            }

            $subtotal += $itemPrice * $item['quantity'];
        }

        $discountAmount = 0;

        $totalAmount = $subtotal - $discountAmount;
        $validated['subtotal'] = $subtotal;
        $validated['discount_amount'] = $discountAmount;
        $validated['total_amount'] = $totalAmount;

        $validated['order_number'] = 'ORD-' . str_pad(
            Order::count() + 1,
            4,
            '0',
            STR_PAD_LEFT
        );

        $validated['status'] = 'Pending';
        $validated['ordered_at'] = now();
        $validated['completed_at'] = null;

        $order = Order::create($validated);
        foreach ($validated['items'] as $item) {

            $menuItem = Menu_Items::findOrFail(
                $item['menu_item_id']
            );

            $itemPrice = $menuItem->base_price;

            if (!empty($item['options'])) {
                foreach ($item['options'] as $optionId) {

                    $option = Option_Values::findOrFail($optionId);

                    $itemPrice += $option->price_adjustment;
                }
            }

            $orderItem = Order_Item::create([
                'order_id' => $order->id,
                'menu_item_id' => $menuItem->id,
                'quantity' => $item['quantity'],
                'unit_price' => $itemPrice,
                'subtotal' => $itemPrice * $item['quantity'],
                'notes' => $item['notes'] ?? null,
            ]);

            if (!empty($item['options'])) {

                foreach ($item['options'] as $optionId) {

                    $option = Option_Values::findOrFail($optionId);

                    Order_Item_Options::create([
                        'order_item_id' => $orderItem->id,
                        'option_value_id' => $option->id,
                        'price_adjustment' => $option->price_adjustment,
                    ]);
                }
            }
            Kitchen_Order_Item::create([
                'order_item_id' => $orderItem->id,
                'prepared_by' => null,
                'status' => 'Pending',
                'started_at' => null,
                'completed_at' => null,
            ]);
        }
        return response()->json([
            'message' => 'Order created successfully.',
            'order' => $order,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
