<?= view('header') ?>
<h2>Customers with Products in Cart</h2>

<table  border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= esc($customer['name']) ?></td>
                <td><?= esc($customer['email']) ?></td>
                <td><?= esc($customer['contact_number']) ?></td>
                <td>
                    <a href="<?= site_url('cart/view/' . $customer['id']) ?>" class="btn btn-primary">View Cart</a>
                    <!-- Optionally, a button for generating the invoice -->
                    <a href="<?= site_url('invoice/create/' . $customer['id']) ?>" class="btn btn-success">Create Invoice</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= view('footer') ?>