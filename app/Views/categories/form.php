<?= view('header'); ?>

<h2><?= isset($category) ? 'Edit Category' : 'Add New Category' ?></h2>

<form action="<?= isset($category) ? site_url('/categories/update/' . $category['id'] ) : site_url('/categories/store') ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?= isset($category) ? esc($category['name']) : old('name') ?>">

    <label for="description">Description:</label>
    <textarea name="description"><?= isset($category) ? esc($category['description']) : old('description') ?></textarea>

    <button type="submit"><?= isset($category) ? 'Update Category' : 'Create Category' ?></button>
</form>
<?= view('footer'); ?>