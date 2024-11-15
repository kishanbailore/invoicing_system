<?= view('header'); ?>
<h2>Create Invoice</h2>
<form method="post" action="<?= site_url('/invoice/store') ?>">
    <input type="hidden" name="customer_id" value="<?= esc($customer['id']); ?>">
    
    <h3>Customer: <?= esc($customer['name']); ?></h3>
    
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?= esc($item['product_name']); ?></td>
                    <td><?= esc(number_format($item['price'], 2)); ?></td>
                    <td><?= esc($item['quantity']); ?></td>
                    <td><?= esc(number_format($item['total_price'], 2)); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Total Amount: <?= esc(number_format($totalAmount, 2)); ?></h3>
    <input type="hidden" name="total_amount" value=<?= esc($totalAmount); ?>
    <label for="discount">Discount:</label>
    <input type="number" name="discount" value="<?= esc($discount); ?>" step="0.01">

    <label for="tax">Tax:</label>
    <input type="number" name="tax" value="<?= esc($tax); ?>" step="0.01">

    <h3>Final Amount: <?= esc(number_format($finalAmount, 2)); ?></h3>
    <input type="hidden" name="final_amount" value=<?= esc($finalAmount); ?>

    <label for="payment_method">Payment Method:</label>
    <select name="payment_method">
        <option value="cash">Cash</option>
        <option value="credit">Credit</option>
        <option value="paypal">PayPal</option>
    </select>

    <button type="submit">Generate Invoice</button>
</form>
<?= view('footer'); ?>
