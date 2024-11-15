<?= view('header'); ?>
<h2>Create Product</h2>

<form action="/products/store" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?= old('name') ?>">

    <label for="description">Description:</label>
    <textarea name="description"><?= old('description') ?></textarea>

    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" value="<?= old('price') ?>">

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" value="<?= old('quantity') ?>">

    <button type="submit">Create Product</button>
</form>
<?= view('footer'); ?>