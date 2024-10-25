<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="mb-4">Add Product</h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form action="/products/store" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" class="form-control" id="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?= $this->endSection() ?>
