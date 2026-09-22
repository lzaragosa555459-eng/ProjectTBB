<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 style="
                margin: 0;
                color: #6b4328;
                font-size: 24px;
                font-weight: bold;
            ">
                Point of Sale
            </h2>

            <p style="
                margin: 5px 0 0;
                color: #76543c;
                font-size: 14px;
            ">
                Create and process customer orders
            </p>
        </div>
    </x-slot>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3e4d2;
            color: #6b4328;
        }

        /* =========================
       POS MAIN LAYOUT
    ========================= */

        .pos-container {
            display: flex;
            height: calc(100vh - 85px);
            overflow: hidden;
            background: #f3e4d2;
        }

        /* =========================
       MENU SECTION
    ========================= */

        .menu-section {
            width: 65%;
            padding: 16px 26px 20px;
            overflow-y: auto;
            min-height: 0;
            background: #f8f1e8;
        }

        /* Hide old POS heading */
        .header {
            display: none;
        }

        /* =========================
       CATEGORY TABS
    ========================= */

        .category-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 14px;
            padding: 9px;
            background: #c9a98e;
            border-radius: 7px;
        }

        .category-tab {
            flex: 1;
            padding: 8px 12px;

            border: 1px solid #a97856;
            border-radius: 6px;

            background: transparent;
            color: #6b4328;

            font-family: Georgia, serif;
            font-size: 12px;
            font-weight: bold;

            cursor: pointer;
        }

        .category-tab:hover {
            background: #d8b99a;
        }

        .category-tab.active {
            background: #b48765;
            color: white;
            border-color: #b48765;
        }

        /* =========================
       MENU GRID
    ========================= */

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        /* =========================
       MENU CARD
    ========================= */

        .menu-card {
            background: #d0ad91;
            border: 1px solid #b99173;
            border-radius: 9px;

            padding: 8px;

            cursor: pointer;

            box-shadow: 0 2px 4px rgba(107, 67, 40, 0.18);

            transition: 0.15s;
        }

        .menu-card:hover {
            transform: translateY(-1px);
            border-color: #8b5e3c;
            box-shadow: 0 4px 8px rgba(107, 67, 40, 0.22);
        }

        /* =========================
       PRODUCT PHOTO
    ========================= */

        .menu-card-photo {
            height: 66px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #b99173;

            border-radius: 6px;

            margin-bottom: 7px;

            color: white;

            font-family: Georgia, serif;
            font-size: 12px;
            font-weight: bold;
        }

        /* =========================
       PRODUCT INFO
    ========================= */

        .menu-card h3 {
            margin: 0;

            color: #6b4328;

            font-family: Georgia, serif;
            font-size: 13px;
            font-weight: bold;
        }

        .menu-card-category {
            margin-top: 2px;

            color: #76543c;

            font-family: Georgia, serif;
            font-size: 10px;
            font-style: italic;
        }

        .menu-card .price {
            margin-top: 5px;

            color: #6b4328;

            font-size: 12px;
            font-weight: bold;
        }

        /* Hide Add to Order button */
        .menu-card button {
            display: none;
        }

        /* =========================
       CART
    ========================= */

        .cart-section {
            width: 35%;

            background: #c9a98e;

            border-left: 1px solid #b99173;

            padding: 14px 12px;

            display: flex;
            flex-direction: column;

            min-height: 0;
            overflow: hidden;

            box-shadow: -3px 0 8px rgba(107, 67, 40, 0.08);
        }

        .cart-section h2 {
            margin: 0 0 10px;

            padding: 8px 10px;

            background: #a97856;
            color: white;

            border-radius: 6px 6px 0 0;

            font-family: Georgia, serif;
            font-size: 21px;
        }

        /* =========================
       CART ITEMS
    ========================= */

        .cart-items {
            flex: 1;
            overflow-y: auto;
            min-height: 0;
        }

        .empty-cart {
            text-align: center;

            margin-top: 30px;

            color: #76543c;

            font-size: 13px;
        }

        /* =========================
       CART SUMMARY
    ========================= */

        .cart-summary {
            border-top: 1px solid #a97856;

            padding-top: 10px;
            margin-top: 8px;
        }

        .summary-row {
            display: flex;

            justify-content: space-between;

            margin-bottom: 7px;

            color: #6b4328;

            font-size: 13px;
            font-weight: bold;
        }

        .discount-buttons {
            display: flex;
            gap: 8px;

            margin: 8px 0;
        }

        .discount-button {
            flex: 1;

            padding: 8px;

            border: 1px solid #a97856;
            border-radius: 6px;

            background: #d8b99a;

            color: #6b4328;

            font-family: Georgia, serif;
            font-size: 11px;
            font-weight: bold;

            cursor: pointer;
        }

        .discount-button:hover {
            background: #b99173;
        }

        .discount-button.active {
            background: #a97856;

            border-color: #a97856;

            color: white;
        }

        .total {
            border-top: 1px solid #a97856;

            padding-top: 8px;
            margin-top: 8px;

            font-size: 17px;
        }

        .checkout-button {
            width: 100%;

            padding: 9px;

            margin-top: 8px;

            border: 1px solid #a97856;
            border-radius: 6px;

            background: #d8b99a;

            color: #6b4328;

            font-family: Georgia, serif;
            font-size: 12px;
            font-weight: bold;

            cursor: pointer;
        }

        .checkout-button:hover {
            background: #b99173;
            color: white;
        }

        /* =========================
       OPTION MODAL
    ========================= */

        .option-modal {
            display: none;

            position: fixed;
            inset: 0;

            background: rgba(60, 35, 20, 0.55);

            align-items: center;
            justify-content: center;

            z-index: 1000;
        }

        .option-modal-content {
            background: #fffaf4;

            width: 420px;
            max-width: 90%;

            padding: 24px;

            border-radius: 10px;

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .option-modal-content h2 {
            margin-top: 0;

            color: #6b4328;

            font-family: Georgia, serif;
        }

        .option-group {
            margin-bottom: 18px;
        }

        .option-group h3 {
            margin-bottom: 9px;

            color: #6b4328;

            font-size: 15px;
        }

        .option-choice {
            display: block;

            margin-bottom: 8px;

            color: #76543c;

            font-size: 14px;
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
            background: #8b5e3c;
            color: white;
        }

        /* =========================
       RESPONSIVE
    ========================= */

        @media (max-width: 900px) {

            .pos-container {
                flex-direction: column;
                height: auto;
            }

            .menu-section,
            .cart-section {
                width: 100%;
            }

            .cart-section {
                min-height: 450px;
            }

            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <div class="pos-container">

        <!-- MENU -->
        <section class="menu-section">

            <div class="category-tabs">

                <button
                    type="button"
                    class="category-tab active"
                    onclick="filterCategory('All', this)">
                    ALL
                </button>

                <button
                    type="button"
                    class="category-tab"
                    onclick="filterCategory('Coffee', this)">
                    COFFEE
                </button>

                <button
                    type="button"
                    class="category-tab"
                    onclick="filterCategory('Non-Coffee', this)">
                    NON-COFFEE
                </button>

                <button
                    type="button"
                    class="category-tab"
                    onclick="filterCategory('Pastries', this)">
                    PASTRIES
                </button>

                <button
                    type="button"
                    class="category-tab"
                    onclick="filterCategory('Food', this)">
                    FOOD
                </button>

            </div>

            <div class="menu-grid">

                @foreach ($menuItems as $menuItem)

                <div
                    class="menu-card"
                    data-category="{{ $menuItem->category->name }}"
                    onclick="this.querySelector('.add-to-cart').click()">

                    <div class="menu-card-photo">
                        PHOTO
                    </div>

                    <h3>
                        {{ $menuItem->name }}
                    </h3>

                    <div class="menu-card-category">
                        {{ $menuItem->category->name ?? 'Menu Item' }}
                    </div>

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
                    <span id="discount">₱0.00</span>
                </div>

                <div class="discount-buttons">

                    <button
                        type="button"
                        id="noDiscountButton"
                        class="discount-button active"
                        onclick="selectDiscount('None')">
                        No Discount
                    </button>

                    <button
                        type="button"
                        id="seniorPwdButton"
                        class="discount-button"
                        onclick="selectDiscount('Senior/PWD')">
                        Senior/PWD
                    </button>

                </div>

                <div class="summary-row total">
                    <span>Total</span>
                    <span id="total">₱0.00</span>
                </div>
                <button
                    type="button"
                    class="checkout-button"
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

        let discountType = 'None';
        const DISCOUNT_RATE = 0.20;

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

                document.getElementById('discount').textContent =
                    '₱0.00';

                document.getElementById('total').textContent =
                    '₱0.00';

                return;
            }

            let subtotal = 0;

            cartItems.innerHTML = '';

            cart.forEach((item, index) => {

                const itemSubtotal =
                    item.price * item.quantity;

                subtotal += itemSubtotal;

                const optionText =
                    item.options && item.options.length > 0 ?
                    item.options.map(option => option.name).join(' • ') :
                    '';

                cartItems.innerHTML += `
            <div style="
                padding: 14px 0;
                border-bottom: 1px solid #eee;
            ">

                <div style="
                    display: flex;
                    justify-content: space-between;
                    gap: 10px;
                ">

                    <strong>
                        ${item.name}
                    </strong>

                    <strong>
                        ₱${itemSubtotal.toFixed(2)}
                    </strong>

                </div>

                ${
                    optionText
                        ? `
                            <div style="
                                margin-top: 6px;
                                color: #8b6a50;
                                font-size: 13px;
                                font-weight: 600;
                            ">
                                ${optionText}
                            </div>
                        `
                        : ''
                }

                <div style="
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    margin-top: 10px;
                ">

                    <div style="
                        display: flex;
                        align-items: center;
                        gap: 8px;
                    ">

                        <button
                            type="button"
                            onclick="decreaseQuantity(${index})"
                            style="
                                width: 32px;
                                height: 32px;
                                border: 1px solid #ddd;
                                background: white;
                                border-radius: 6px;
                                cursor: pointer;
                                font-size: 18px;
                            "
                        >
                            −
                        </button>

                        <span style="
                            min-width: 24px;
                            text-align: center;
                            font-weight: bold;
                        ">
                            ${item.quantity}
                        </span>

                        <button
                            type="button"
                            onclick="increaseQuantity(${index})"
                            style="
                                width: 32px;
                                height: 32px;
                                border: 1px solid #ddd;
                                background: white;
                                border-radius: 6px;
                                cursor: pointer;
                                font-size: 18px;
                            "
                        >
                            +
                        </button>

                    </div>

                    <button
                        type="button"
                        onclick="removeCartItem(${index})"
                        style="
                            border: none;
                            background: none;
                            color: #c00;
                            cursor: pointer;
                        "
                    >
                        Remove
                    </button>

                </div>

                <div style="
                    margin-top: 6px;
                    color: #777;
                    font-size: 13px;
                ">
                    ₱${item.price.toFixed(2)} each
                </div>

            </div>
        `;

            });

            let discountAmount = 0;

            if (discountType === 'Senior/PWD') {

                discountAmount =
                    subtotal * DISCOUNT_RATE;

            }

            const total =
                subtotal - discountAmount;

            document.getElementById('subtotal').textContent =
                `₱${subtotal.toFixed(2)}`;

            document.getElementById('discount').textContent =
                `₱${discountAmount.toFixed(2)}`;

            document.getElementById('total').textContent =
                `₱${total.toFixed(2)}`;
        }

        function increaseQuantity(index) {

            cart[index].quantity++;

            renderCart();
        }


        function decreaseQuantity(index) {

            if (cart[index].quantity > 1) {

                cart[index].quantity--;

            } else {

                cart.splice(index, 1);

            }

            renderCart();
        }


        function removeCartItem(index) {

            cart.splice(index, 1);

            renderCart();
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
                    ${Number(value.price_adjustment) > 0
                        ? `(+₱${Number(value.price_adjustment).toFixed(2)})`
                        : ''}

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

            let discountAmount = 0;

            if (discountType === 'Senior/PWD') {

                discountAmount =
                    subtotal * DISCOUNT_RATE;

            }

            const total =
                subtotal - discountAmount;

            document.getElementById(
                    'checkoutSubtotal'
                ).textContent =
                `₱${subtotal.toFixed(2)}`;

            document.getElementById(
                    'checkoutDiscount'
                ).textContent =
                `₱${discountAmount.toFixed(2)}`;

            document.getElementById(
                    'checkoutTotal'
                ).textContent =
                `₱${total.toFixed(2)}`;


            // Reset payment fields

            document.getElementById(
                'amountReceived'
            ).value = '';

            document.getElementById(
                'changeAmount'
            ).textContent = '₱0.00';

            document.getElementById(
                'gcashReference'
            ).value = '';


            // Default to Cash

            document.querySelector(
                'input[name="payment_method"][value="Cash"]'
            ).checked = true;

            document.getElementById(
                'cashPaymentFields'
            ).style.display = 'block';

            document.getElementById(
                'gcashPaymentFields'
            ).style.display = 'none';


            document.getElementById(
                'checkoutModal'
            ).style.display = 'flex';
        }

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

                const subtotal =
                    cart.reduce(
                        (total, item) =>
                        total + (item.price * item.quantity),
                        0
                    );

                let discountAmount = 0;

                if (discountType === 'Senior/PWD') {

                    discountAmount =
                        subtotal * DISCOUNT_RATE;

                }

                const total =
                    subtotal - discountAmount;

                const received =
                    parseFloat(this.value) || 0;

                const change =
                    received - total;

                document.getElementById(
                        'changeAmount'
                    ).textContent =
                    `₱${Math.max(change, 0).toFixed(2)}`;

            });

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

            let amountReceived = 0;

            if (paymentMethod === 'Cash') {
                amountReceived =
                    parseFloat(
                        document.getElementById(
                            'amountReceived'
                        ).value
                    ) || 0;
            }

            const gcashReference =
                document.getElementById(
                    'gcashReference'
                ).value.trim();

            const subtotal = cart.reduce(
                (total, item) =>
                total + (item.price * item.quantity),
                0
            );

            let discountAmount = 0;

            if (discountType === 'Senior/PWD') {
                discountAmount = subtotal * DISCOUNT_RATE;
            }

            const totalAmount = subtotal - discountAmount;

            // Cash validation
            if (paymentMethod === 'Cash') {

                if (amountReceived < total) {

                    alert(
                        'Amount received is not enough.'
                    );

                    return;
                }

            }


            // GCash validation
            if (paymentMethod === 'GCash') {

                if (!/^\d{4}$/.test(gcashReference)) {

                    alert(
                        'GCash reference number must be exactly 4 digits.'
                    );

                    return;
                }

            }


            const items = cart.map(item => ({
                menu_item_id: item.id,
                quantity: item.quantity,
                notes: null,
                options: item.options ?
                    item.options.map(option => option.id) : []
            }));


            const data = {

                order_type: orderType,

                items: items,

                discount_type: discountType,

                discount_amount: discountAmount,

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

        function selectDiscount(type) {

            discountType = type;

            document
                .getElementById('noDiscountButton')
                .classList.toggle(
                    'active',
                    type === 'None'
                );

            document
                .getElementById('seniorPwdButton')
                .classList.toggle(
                    'active',
                    type === 'Senior/PWD'
                );

            renderCart();
        }

        function filterCategory(category, button) {

            document
                .querySelectorAll('.category-tab')
                .forEach(tab => {
                    tab.classList.remove('active');
                });

            button.classList.add('active');

            document
                .querySelectorAll('.menu-card')
                .forEach(card => {

                    const cardCategory =
                        card.dataset.category;

                    if (
                        category === 'All' ||
                        cardCategory === category
                    ) {

                        card.style.display = '';

                    } else {

                        card.style.display = 'none';

                    }

                });
        }
    </script>

</x-app-layout>