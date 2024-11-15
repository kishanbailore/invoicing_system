<?= view('header'); ?>
<h2>Customer List</h2>

<a href="<?= site_url('/customers/create'); ?>">Add New Customer</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Contact Number</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($customers as $customer): ?>
        <tr>
            <td><?= esc($customer['id']) ?></td>
            <td><?= esc($customer['name']) ?></td>
            <td><?= esc($customer['email']) ?></td>
            <td><?= esc($customer['address']) ?></td>
            <td><?= esc($customer['contact_number']) ?></td>
            <td>
                <a href="<?= site_url("/customers/edit/") ?><?= $customer['id'] ?>">Edit</a> |
                <a href="<?= site_url("/customers/delete/") ?><?= $customer['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?= view('footer'); ?>