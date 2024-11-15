<?= view('header') ?>
<h2>Invoices</h2>

<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Total Amount</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= esc($invoice['id']); ?></td>
                <td><?= esc($invoice['customer_name']); ?></td>
                <td><?= esc(number_format($invoice['final_amount'], 2)); ?></td>
                <td><?= esc(date('Y-m-d', strtotime($invoice['created_at']))); ?></td>
                <td>
                    <a href="<?= site_url('/invoice/view/')?><?= esc($invoice['id']); ?>">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= view('footer') ?>