<?= view('header'); ?>
<h2>Add Product to Cart</h2>
<?php if (isset($message)): ?>
    <div class="success"><?= esc($message) ?></div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="error"><?= esc($error) ?></div>
<?php endif; ?>
<form action="<?= site_url('/cart/addToCart') ?>" method="post">
    <input type="hidden" name="product_id" value="<?= esc($product['id']) ?>">
    <p>Product: <?= esc($product['name']) ?></p>
    <p>Price: <?= esc($product['price']) ?></p>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" min="1" max="<?= esc($product['quantity']) ?>" required>

    <h3>Customer Details</h3>
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?= isset($customer) ? esc($customer['name']) : old('name') ?>">

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= isset($customer) ? esc($customer['email']) : old('email') ?>">

    <label for="address">Address:</label>
    <textarea name="address"><?= isset($customer) ? esc($customer['address']) : old('address') ?></textarea>

    <label for="contact_number">Contact Number:</label>
    <input type="text" name="contact_number" value="<?= isset($customer) ? esc($customer['contact_number']) : old('contact_number') ?>">


    <button type="submit">Add to Cart</button>
</form>
<?= view('footer'); ?>