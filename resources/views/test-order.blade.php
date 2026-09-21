<!DOCTYPE html>
<html>

<head>
    <title>Test Order</title>
</head>

<body>

    <h1>Test Order</h1>

    <form method="POST" action="/orders">
        @csrf

        <input type="hidden" name="cashier_id" value="2">
        <input type="hidden" name="order_type" value="Dine-in">

        <input type="hidden" name="items[0][menu_item_id]" value="6">
        <input type="hidden" name="items[0][quantity]" value="1">
        <input type="hidden" name="items[0][notes]" value="Test order">

        <input type="hidden" name="items[0][options][]" value="3">

        <input type="hidden" name="payment_method" value="Cash">
        <input type="hidden" name="amount_received" value="110">

        <button type="submit">
            Create Test Order
        </button>
    </form>

</body>

</html>