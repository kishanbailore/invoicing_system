<?= view('header'); ?>
<h2><?= isset($product) ? 'Edit Product' : 'Add New Product' ?></h2>

<form action="<?= isset($product) ? site_url('/products/update/' . $product['id']) : site_url('/products/store') ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?= isset($product) ? esc($product['name']) : old('name') ?>">

    <label for="description">Description:</label>
    <textarea name="description"><?= isset($product) ? esc($product['description']) : old('description') ?></textarea>

    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" value="<?= isset($product) ? esc($product['price']) : old('price') ?>">

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" value="<?= isset($product) ? esc($product['quantity']) : old('quantity') ?>">

    <label for="category_id">Category:</label>
    <select name="category_id" id="category_id">
        <option value="">Select Category</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= esc($category['id']) ?>" 
                <?= isset($product) && $product['category_id'] == $category['id'] ? 'selected' : '' ?>>
                <?= esc($category['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit"><?= isset($product) ? 'Update Product' : 'Create Product' ?></button>
</form>
<?= view('footer'); ?>