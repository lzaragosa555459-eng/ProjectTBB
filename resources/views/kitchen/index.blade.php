<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Kitchen Orders
        </h2>
    </x-slot>

    <div class="py-6">
        @if (session('success'))
        <div style="
        background: #dcfce7;
        color: #166534;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    ">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div style="
        background: #fee2e2;
        color: #991b1b;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    ">
            {{ session('error') }}
        </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="orders">

                @forelse ($orders as $orderItems)

                @php
                $firstKitchenOrder = $orderItems->first();
                $order = $firstKitchenOrder->orderItem->order;
                @endphp

                <div class="order-card">

                    <div class="order-number">
                        {{ $order->order_number }}
                    </div>

                    @foreach ($orderItems as $kitchenOrder)

                    <div style="
                padding: 12px 0;
                border-bottom: 1px solid #eee;
            ">

                        <div class="item-name">
                            {{ $kitchenOrder->orderItem->menuItem->name }}
                        </div>

                        <div class="quantity">
                            Quantity:
                            {{ $kitchenOrder->orderItem->quantity }}
                        </div>

                        @if ($kitchenOrder->orderItem->options->count())
                        <div class="options">
                            <strong>Options:</strong>

                            @foreach ($kitchenOrder->orderItem->options as $option)
                            {{ $option->optionValue->name }}

                            @if (!$loop->last)
                            ,
                            @endif
                            @endforeach
                        </div>
                        @endif

                        @if ($kitchenOrder->orderItem->notes)
                        <div class="notes">
                            <strong>Notes:</strong>
                            {{ $kitchenOrder->orderItem->notes }}
                        </div>
                        @endif

                        <div class="status">
                            {{ $kitchenOrder->status }}
                        </div>

                        @if ($kitchenOrder->preparedBy)
                        <div class="prepared-by">
                            Prepared by:
                            {{ $kitchenOrder->preparedBy->name }}
                        </div>
                        @endif

                        @if (Auth::user()->role_id === 3 && $kitchenOrder->status === 'Pending')
                        <form
                            method="POST"
                            action="/kitchen/{{ $kitchenOrder->id }}/start"
                            style="margin-top: 15px;">
                            @csrf

                            <button type="submit">
                                Start Preparing
                            </button>
                        </form>
                        @endif

                        @if (Auth::user()->role_id === 3 && $kitchenOrder->status === 'Preparing')
                        <form
                            method="POST"
                            action="/kitchen/{{ $kitchenOrder->id }}/complete"
                            style="margin-top: 15px;">
                            @csrf

                            <button type="submit">
                                Mark as Ready
                            </button>
                        </form>
                        @endif

                    </div>

                    @endforeach

                    @php
                    $allReady = $orderItems->every(
                    fn ($kitchenOrder) => $kitchenOrder->status === 'Ready'
                    );
                    @endphp

                    @if (Auth::user()->role_id === 3 && $allReady)
                    <form
                        method="POST"
                        action="/orders/{{ $order->id }}/complete"
                        style="margin-top: 15px;">
                        @csrf
                        <button
                            type="submit"
                            style="
                            background: #111827;
                            color: white;
                            padding: 10px 16px;
                            border: none;
                            border-radius: 6px;
                            font-weight: 600;
                            cursor: pointer;
                        ">
                            Complete Order
                        </button>
                    </form>
                    @endif

                </div>

                @empty

                <p>No kitchen orders.</p>

                @endforelse

            </div>

        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top: 40px;">

        <h3 style="
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
    ">
            Completed Orders
        </h3>

        <div class="orders">

            @forelse ($completedOrders as $orderItems)

            @php
            $firstKitchenOrder = $orderItems->first();
            $order = $firstKitchenOrder->orderItem->order;
            @endphp

            <div class="order-card">

                <div class="order-number">
                    {{ $order->order_number }}
                </div>

                @foreach ($orderItems as $kitchenOrder)

                <div style="
                        padding: 12px 0;
                        border-bottom: 1px solid #eee;
                    ">

                    <div class="item-name">
                        {{ $kitchenOrder->orderItem->menuItem->name }}
                    </div>

                    <div class="quantity">
                        Quantity:
                        {{ $kitchenOrder->orderItem->quantity }}
                    </div>

                    <div class="status">
                        Completed
                    </div>

                    @if ($kitchenOrder->preparedBy)
                    <div class="prepared-by">
                        Prepared by:
                        {{ $kitchenOrder->preparedBy->name }}
                    </div>
                    @endif

                </div>

                @endforeach

                @if ($order->completed_at)
                <div style="margin-top: 15px; color: #555;">
                    Completed at:
                    {{ $order->completed_at }}
                </div>
                @endif

            </div>

            @empty

            <p>No completed orders.</p>

            @endforelse

        </div>

    </div>
    <style>
        .orders {
            display: grid;
            grid-template-columns: repeat(auto-fill,
                    minmax(280px, 1fr));
            gap: 20px;
        }

        .order-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .order-number {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .item-name {
            font-size: 18px;
            font-weight: bold;
        }

        .quantity {
            margin-top: 5px;
        }

        .status {
            margin-top: 15px;
            padding: 8px 12px;
            display: inline-block;
            border-radius: 6px;
            background: #eee;
            font-weight: bold;
        }

        .options {
            margin-top: 10px;
            color: #555;
        }

        .notes {
            margin-top: 10px;
            color: #555;
        }
    </style>

</x-app-layout>