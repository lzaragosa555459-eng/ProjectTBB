<?php

namespace Database\Seeders;

use App\Models\Kitchen_Order_Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class KitchenOrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $order = Order::where('order_number', 'ORD-0001')->first();
        $orderItem = $order->orderItems()->first();

        $cook = User::where('email', 'cook@thebrewingbar.test')->first();

        Kitchen_Order_Item::create([
            'order_item_id' => $orderItem->id,
            'prepared_by' => $cook->id,
            'status' => 'Pending',
            'started_at' => null,
            'completed_at' => null,
        ]);
    }
}
