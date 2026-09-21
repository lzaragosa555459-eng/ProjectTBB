<?php

namespace Database\Seeders;

use App\Models\Menu_Items;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $cashier = User::where('email', 'cashier@thebrewingbar.test')->first();
        $porkSisig = Menu_Items::where('name', 'Pork Sisig')->first();

        Order::create([
            'cashier_id' => $cashier->id,
            'order_number' => 'ORD-0001',
            'order_type' => 'Dine-in',
            'status' => 'Pending',
            'subtotal' => $porkSisig->base_price,
            'discount_amount' => 0,
            'total_amount' => $porkSisig->base_price,
            'ordered_at' => now(),
            'completed_at' => null,
        ]);
    }
}
