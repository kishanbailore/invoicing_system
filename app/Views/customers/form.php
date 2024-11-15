<?= view('header'); ?>
<h2><?= isset($customer) ? 'Edit Customer' : 'Add New Customer' ?></h2>

<form action="<?= isset($customer) ? site_url('/customers/update/' . $customer['id']) : site_url('/customers/store') ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?= isset($customer) ? esc($customer['name']) : old('name') ?>">

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= isset($customer) ? esc($customer['email']) : old('email') ?>">

    <label for="address">Address:</label>
    <textarea name="address"><?= isset($customer) ? esc($customer['address']) : old('address') ?></textarea>

    <label for="contact_number">Contact Number:</label>
    <input type="text" name="contact_number" value="<?= isset($customer) ? esc($customer['contact_number']) : old('contact_number') ?>">

    <button type="submit"><?= isset($customer) ? 'Update Customer' : 'Create Customer' ?></button>
</form>
<?= view('footer'); ?>