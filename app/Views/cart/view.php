<?= view('header') ?>
<h1>Your Cart</h1>

    <!-- Customer Information -->
    <h2>Customer Details</h2>
    <p><strong>Name:</strong> <?= esc($customer['name']) ?>
    <strong>Email:</strong> <?= esc($customer['email']) ?><strong> Address:</strong> <?= esc($customer['address']) ?>
    <strong>Contact:</strong> <?= esc($customer['contact_number']) ?></p>

    <!-- Cart Items -->
    <?php if (empty($cartItems)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                    <td><?= esc($item['product_name']); ?></td>
                     <td><?= esc(number_format($item['price'], 2)); ?></td>
                    <td><?= esc($item['quantity']); ?></td>
                     <td><?= esc(number_format($item['price'] * $item['quantity'], 2)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td><?= esc(number_format($totalAmount, 2)) ?></td>
                </tr>
            </tfoot>
        </table>

        <!-- Invoice Generation -->
         <a href="<?= site_url('/invoice/create/'.esc($customer['id'])) ?>"> Generate Invoice </a>
        
    <?php endif; ?>
<?= view('footer') ?>