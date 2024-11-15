<?= view('header'); ?>

<h2>Product List</h2>

<a href="<?= site_url('/products/create'); ?>" >Add New Product</a>

<?php if (session()->getFlashdata('message')): ?>
    <p><?= session()->getFlashdata('message') ?></p>
<?php endif; ?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= esc($product['id']) ?></td>
            <td><?= esc($product['name']) ?></td>
            <td><?= esc($product['description']) ?></td>
            <td><?= esc($product['price']) ?></td>
            <td><?= esc($product['quantity']) ?></td>
            <td><?= esc($product['category_id']) ?></td>
            <td>
                <a href="<?= site_url('/products/edit/')?><?= $product['id'] ?>">Edit</a> |
                <a href="<?= site_url('/products/delete/')?><?= $product['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                <a href="<?= site_url('/cart/add/') ?><?= esc($product['id']) ?>" target="_blank">Add to Cart</a>
            </td>
            
        </tr>
    <?php endforeach; ?>
</table>
<?= view('footer'); ?>