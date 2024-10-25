<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="mb-4">Edit Product</h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form action="/products/update/<?= esc($product['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= esc($product['name']) ?>" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" class="form-control" id="price" name="price" value="<?= esc($product['price']) ?>" required>
    </div>
    <div class="form-group">
        <label for="image">Upload New Image (Optional)</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?= $this->endSection() ?>
