<?= view('header'); ?>
<h2>Invoice #<?= esc($invoice['id']); ?> for <?= esc($customer['name']); ?></h2>
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
        <?php foreach ($invoiceItems as $item): ?>
            <tr>
                <td><?= esc($item['product_name']); ?></td>
                <td><?= esc(number_format($item['price'], 2)); ?></td>
                <td><?= esc($item['quantity']); ?></td>
                <td><?= esc(number_format($item['total'], 2)); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Total Amount: <?= esc(number_format($invoice['total_amount'], 2)); ?></h3>
<h3>Discount: <?= esc(number_format($invoice['discount'], 2)); ?></h3>
<h3>Tax: <?= esc(number_format($invoice['tax'], 2)); ?></h3>
<h3>Final Amount: <?= esc(number_format($invoice['final_amount'], 2)); ?></h3>

<h3>Payment Method: <?= esc($invoice['payment_method']); ?></h3>

<a href="<?= site_url('/invoices') ?>">Back to Invoice List</a>
<?= view('footer'); ?>