<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="mb-4">Product List</h1>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<a href="/products/create" class="btn btn-primary mb-3">Add New Product</a>

<?php if (!empty($products) && is_array($products)): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= esc($product['name']) ?></td>
                    <td><?= esc($product['price']) ?></td>
                    <td><?= esc($product['description']) ?></td>
                    <td>
                        <a href="/products/edit/<?= esc($product['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form action="/products/delete/<?= esc($product['id']) ?>" method="post" class="d-inline">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No products found.</p>
<?php endif; ?>

<?= $this->endSection() ?>
