<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $order = Order::where('order_number', 'ORD-0001')->first();

        $cashier = User::where(
            'email',
            'cashier@thebrewingbar.test'
        )->first();

        Payment::create([
            'order_id' => $order->id,
            'received_by' => $cashier->id,
            'payment_method' => 'Cash',
            'amount' => $order->total_amount,
            'amount_received' => 120,
            'change_amount' => 0,
            'reference_number' => null,
            'proof_path' => null,
            'paid_at' => now(),
        ]);
    }
}
