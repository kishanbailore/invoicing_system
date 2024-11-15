<?= view('header'); ?>

<h2>Category List</h2>

<a href="<?= site_url('/categories/create'); ?>">Add New Category</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= esc($category['id']) ?></td>
            <td><?= esc($category['name']) ?></td>
            <td><?= esc($category['description']) ?></td>
            <td>
                <a href="<?= site_url('/categories/edit/') ?><?= $category['id'] ?>">Edit</a> |
                <a href="<?= site_url('/categories/delete/') ?><?= $category['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?= view('footer'); ?>