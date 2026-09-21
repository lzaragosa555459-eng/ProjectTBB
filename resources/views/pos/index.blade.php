<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>The Brewing Bar - POS</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #222;
        }

        .pos-container {
            display: flex;
            height: 100vh;
        }

        /* Left side */
        .menu-section {
            width: 65%;
            padding: 24px;
            overflow-y: auto;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .header p {
            margin-top: 5px;
            color: #777;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .menu-card {
            background: white;
            border-radius: 10px;
            padding: 18px;
            border: 1px solid #ddd;
            cursor: pointer;
        }

        .menu-card:hover {
            border-color: #333;
        }

        .menu-card h3 {
            margin: 0 0 8px;
        }

        .menu-card .price {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .menu-card button {
            width: 100%;
            padding: 9px;
            border: none;
            border-radius: 6px;
            background: #222;
            color: white;
            cursor: pointer;
        }

        /* Right side */
        .cart-section {
            width: 35%;
            background: white;
            border-left: 1px solid #ddd;
            padding: 24px;
            display: flex;
            flex-direction: column;
        }

        .cart-section h2 {
            margin-top: 0;
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
        }

        .empty-cart {
            color: #888;
            text-align: center;
            margin-top: 40px;
        }

        .cart-summary {
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total {
            font-size: 22px;
            font-weight: bold;
        }

        .checkout-button {
            width: 100%;
            padding: 14px;
            margin-top: 15px;
            border: none;
            border-radius: 8px;
            background: #222;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .option-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .option-modal-content {
            background: white;
            width: 420px;
            max-width: 90%;
            padding: 24px;
            border-radius: 12px;
        }

        .option-modal-content h2 {
            margin-top: 0;
        }

        .option-group {
            margin-bottom: 20px;
        }

        .option-group h3 {
            margin-bottom: 10px;
        }

        .option-choice {
            display: block;
            margin-bottom: 8px;
        }

        .option-modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .option-modal-actions button {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .option-modal-actions button:last-child {
            background: #222;
            color: white;
        }
    </style>
</head>

<body>

    <div class="pos-container">

        <!-- MENU -->
        <section class="menu-section">

            <div class="header">
                <h1>The Brewing Bar</h1>
                <p>Point of Sale</p>
            </div>

            <div class="menu-grid">

                @foreach ($menuItems as $menuItem)

                <div class="menu-card">

                    <h3>{{ $menuItem->name }}</h3>

                    <div class="price">
                        ₱{{ number_format($menuItem->base_price, 2) }}
                    </div>

                    <button
                        type="button"
                        class="add-to-cart"
                        data-id="{{ $menuItem->id }}"
                        data-name="{{ $menuItem->name }}"
                        data-price="{{ $menuItem->base_price }}"
                        data-options='@json($menuItem->optionGroups)'>
                        Add to Order
                    </button>

                </div>

                @endforeach

            </div>

        </section>

        <!-- CART -->
        <section class="cart-section">

            <h2>Current Order</h2>

            <div
                class="cart-items"
                id="cartItems">
                <div class="empty-cart">
                    No items added.
                </div>
            </div>

            <div class="cart-summary">

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotal">₱0.00</span>
                </div>

                <div class="summary-row">
                    <span>Discount</span>
                    <span>₱0.00</span>
                </div>

                <div class="summary-row total">
                    <span>Total</span>
                    <span id="total">₱0.00</span>
                </div>
                <button
                    type="button"
                    onclick="openCheckoutModal()">
                    Checkout
                </button>

            </div>

        </section>

    </div>
    <div id="optionModal" class="option-modal">

        <div class="option-modal-content">

            <h2 id="optionMenuName"></h2>

            <div id="optionGroups"></div>

            <div class="option-modal-actions">

                <button
                    type="button"
                    onclick="closeOptionModal()">
                    Cancel
                </button>

                <button
                    type="button"
                    onclick="confirmOptions()">
                    Add to Order
                </button>

            </div>

        </div>

    </div>
    <div id="checkoutModal" class="option-modal">

        <div class="option-modal-content">

            <h2>Checkout</h2>

            <div style="margin-bottom: 20px;">

                <div style="
                display: flex;
                justify-content: space-between;
                margin-bottom: 8px;
            ">
                    <span>Subtotal</span>
                    <strong id="checkoutSubtotal">
                        ₱0.00
                    </strong>
                </div>

                <div style="
                display: flex;
                justify-content: space-between;
                margin-bottom: 8px;
            ">
                    <span>Discount</span>
                    <strong id="checkoutDiscount">
                        ₱0.00
                    </strong>
                </div>

                <div style="
                display: flex;
                justify-content: space-between;
                font-size: 20px;
                border-top: 1px solid #ddd;
                padding-top: 10px;
            ">
                    <strong>Total</strong>
                    <strong id="checkoutTotal">
                        ₱0.00
                    </strong>
                </div>

            </div>


            <div class="option-group">

                <h3>Order Type</h3>

                <label class="option-choice">
                    <input
                        type="radio"
                        name="order_type"
                        value="Dine-in"
                        checked>
                    Dine-in
                </label>

                <label class="option-choice">
                    <input
                        type="radio"
                        name="order_type"
                        value="Takeout">
                    Takeout
                </label>

            </div>


            <div class="option-group">

                <h3>Payment Method</h3>

                <label class="option-choice">
                    <input
                        type="radio"
                        name="payment_method"
                        value="Cash"
                        checked>
                    Cash
                </label>

                <label class="option-choice">
                    <input
                        type="radio"
                        name="payment_method"
                        value="GCash">
                    GCash
                </label>

            </div>


            <div id="cashPaymentFields">

                <label>
                    Amount Received
                </label>

                <input
                    type="number"
                    id="amountReceived"
                    min="0"
                    step="0.01"
                    placeholder="₱0.00"
                    style="
                    width: 100%;
                    padding: 10px;
                    margin-top: 5px;
                    margin-bottom: 10px;
                    box-sizing: border-box;
                ">

                <div style="
                display: flex;
                justify-content: space-between;
            ">
                    <span>Change</span>

                    <strong id="changeAmount">
                        ₱0.00
                    </strong>
                </div>

            </div>


            <div
                id="gcashPaymentFields"
                style="display: none;">

                <label>
                    GCash Reference Number
                </label>

                <input
                    type="text"
                    id="gcashReference"
                    maxlength="4"
                    placeholder="4-digit reference number"
                    style="
                    width: 100%;
                    padding: 10px;
                    margin-top: 5px;
                    box-sizing: border-box;
                ">

            </div>


            <div class="option-modal-actions">

                <button
                    type="button"
                    onclick="closeCheckoutModal()">
                    Cancel
                </button>

                <button
                    type="button"
                    onclick="placeOrder()">
                    Place Order
                </button>

            </div>

        </div>

    </div>
    <script>
        let cart = [];
        let selectedMenuItem = null;

        document.querySelectorAll('.add-to-cart').forEach(button => {

            button.addEventListener('click', function() {

                const id = Number(this.dataset.id);
                const name = this.dataset.name;
                const price = Number(this.dataset.price);

                const options = JSON.parse(
                    this.dataset.options
                );

                if (options.length > 0) {

                    const menuItem = {
                        id: id,
                        name: name,
                        price: price,
                        options: options.map(group => ({
                            id: group.id,
                            name: group.name,
                            is_required: group.pivot.is_required,
                            values: group.option_values
                        }))
                    };

                    openOptionModal(menuItem);

                } else {

                    addToCart(id, name, price);

                }

            });

        });


        function addToCart(id, name, price) {

            const existingItem = cart.find(
                item => item.id === id
            );

            if (existingItem) {

                existingItem.quantity++;

            } else {

                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    quantity: 1
                });

            }

            renderCart();
        }


        function renderCart() {

            const cartItems =
                document.getElementById('cartItems');

            if (cart.length === 0) {

                cartItems.innerHTML = `
                <div class="empty-cart">
                    No items added.
                </div>
            `;

                document.getElementById('subtotal').textContent =
                    '₱0.00';

                document.getElementById('total').textContent =
                    '₱0.00';

                return;
            }

            let subtotal = 0;

            cartItems.innerHTML = '';

            cart.forEach(item => {

                const itemSubtotal =
                    item.price * item.quantity;

                subtotal += itemSubtotal;

                cartItems.innerHTML += `
                <div style="
                    padding: 12px 0;
                    border-bottom: 1px solid #eee;
                ">

                    <div style="
                        display: flex;
                        justify-content: space-between;
                    ">

                        <strong>${item.name}</strong>

                        <span>
                            ₱${itemSubtotal.toFixed(2)}
                        </span>

                    </div>

                    <div style="
                        margin-top: 5px;
                        color: #777;
                    ">
                        ${
                            item.options && item.options.length > 0
                                ? item.options.map(option => option.name).join(', ')
                                : ''
                        }
                    </div>

                    <div style="
                        margin-top: 5px;
                        color: #777;
                    ">
                        ${item.quantity} ×
                        ₱${item.price.toFixed(2)}
                    </div>

                </div>
            `;

            });

            document.getElementById('subtotal').textContent =
                `₱${subtotal.toFixed(2)}`;

            document.getElementById('total').textContent =
                `₱${subtotal.toFixed(2)}`;
        }


        function openOptionModal(menuItem) {

            selectedMenuItem = menuItem;

            document.getElementById('optionMenuName').textContent =
                menuItem.name;

            const optionGroups =
                document.getElementById('optionGroups');

            optionGroups.innerHTML = '';

            menuItem.options.forEach(group => {

                let html = `
                <div class="option-group">

                    <h3>
                        ${group.name}
                        ${group.is_required ? '*' : ''}
                    </h3>
            `;

                group.values.forEach(value => {

                    html += `
                    <label class="option-choice">

                        <input
                            type="radio"
                            name="option_group_${group.id}"
                            value="${value.id}"
                        >

                        ${value.name}

                    </label>
                `;

                });

                html += `
                </div>
            `;

                optionGroups.innerHTML += html;

            });

            document.getElementById('optionModal').style.display =
                'flex';
        }


        function closeOptionModal() {

            document.getElementById('optionModal').style.display =
                'none';

            selectedMenuItem = null;
        }


        function confirmOptions() {

            if (!selectedMenuItem) {
                return;
            }

            const selectedOptions = [];

            for (const group of selectedMenuItem.options) {

                const selected =
                    document.querySelector(
                        `input[name="option_group_${group.id}"]:checked`
                    );

                if (group.is_required && !selected) {

                    alert(
                        `Please select a ${group.name}.`
                    );

                    return;
                }

                if (selected) {

                    const value =
                        group.values.find(
                            option => option.id === Number(selected.value)
                        );

                    selectedOptions.push({
                        id: value.id,
                        name: value.name,
                        price_adjustment: Number(
                            value.price_adjustment
                        )
                    });

                }

            }

            const optionPriceAdjustment =
                selectedOptions.reduce(
                    (total, option) =>
                    total + option.price_adjustment,
                    0
                );

            const finalPrice =
                selectedMenuItem.price +
                optionPriceAdjustment;

            cart.push({

                id: selectedMenuItem.id,

                name: selectedMenuItem.name,

                price: finalPrice,

                quantity: 1,

                options: selectedOptions

            });

            closeOptionModal();

            renderCart();
        }

        function openCheckoutModal() {

            if (cart.length === 0) {

                alert('Please add an item to the order.');

                return;
            }

            const subtotal = cart.reduce(
                (total, item) =>
                total + (item.price * item.quantity),
                0
            );

            document.getElementById(
                    'checkoutSubtotal'
                ).textContent =
                `₱${subtotal.toFixed(2)}`;

            document.getElementById(
                    'checkoutTotal'
                ).textContent =
                `₱${subtotal.toFixed(2)}`;

            document.getElementById(
                'checkoutModal'
            ).style.display = 'flex';
            document
                .querySelectorAll('input[name="payment_method"]')
                .forEach(radio => {

                    radio.addEventListener('change', function() {

                        const cashFields =
                            document.getElementById(
                                'cashPaymentFields'
                            );

                        const gcashFields =
                            document.getElementById(
                                'gcashPaymentFields'
                            );

                        if (this.value === 'Cash') {

                            cashFields.style.display = 'block';
                            gcashFields.style.display = 'none';

                        } else {

                            cashFields.style.display = 'none';
                            gcashFields.style.display = 'block';

                        }

                    });

                });
            document
                .getElementById('amountReceived')
                .addEventListener('input', function() {

                    const totalText =
                        document.getElementById(
                            'checkoutTotal'
                        ).textContent;

                    const total =
                        parseFloat(
                            totalText.replace('₱', '')
                        ) || 0;

                    const received =
                        parseFloat(this.value) || 0;

                    const change =
                        received - total;

                    document.getElementById(
                            'changeAmount'
                        ).textContent =
                        `₱${Math.max(change, 0).toFixed(2)}`;

                });
        }



        function closeCheckoutModal() {

            document.getElementById(
                'checkoutModal'
            ).style.display = 'none';
        }

        async function placeOrder() {

            if (cart.length === 0) {
                alert('Please add an item to the order.');
                return;
            }

            const orderType =
                document.querySelector(
                    'input[name="order_type"]:checked'
                ).value;

            const paymentMethod =
                document.querySelector(
                    'input[name="payment_method"]:checked'
                ).value;

            const amountReceived =
                parseFloat(
                    document.getElementById(
                        'amountReceived'
                    ).value
                ) || 0;

            const gcashReference =
                document.getElementById(
                    'gcashReference'
                ).value.trim();

            const items = cart.map(item => ({

                menu_item_id: item.id,

                quantity: item.quantity,

                notes: null,

                options: item.options ?
                    item.options.map(option => option.id) : []

            }));

            const data = {

                cashier_id: 2,

                order_type: orderType,

                items: items,

                payment_method: paymentMethod,

                amount_received: amountReceived,

                reference_number: paymentMethod === 'GCash' ?
                    gcashReference : null,

                proof_path: null
            };

            try {

                const response = await fetch(
                    '/orders', {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',

                            'Accept': 'application/json',

                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },

                        body: JSON.stringify(data)
                    }
                );

                const result =
                    await response.json();

                if (!response.ok) {

                    console.error(result);

                    alert(
                        result.message ||
                        'Failed to create order.'
                    );

                    return;
                }

                alert(
                    `Order ${result.order.order_number} created successfully.`
                );

                cart = [];

                renderCart();

                closeCheckoutModal();

            } catch (error) {

                console.error(error);

                alert(
                    'Something went wrong while creating the order.'
                );
            }
        }
    </script>
</body>

</html>