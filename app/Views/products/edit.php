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

<form action="/products/update/<?= esc($product['id']) ?>" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= esc($product['name']) ?>" required>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" name="price" id="price" class="form-control" value="<?= esc($product['price']) ?>" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" required><?= esc($product['description']) ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update Product</button>
    <a href="/products" class="btn btn-secondary">Back</a>
</form>
<?= $this->endSection() ?>
                