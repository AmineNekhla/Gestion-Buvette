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

<form action="/products/store" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= old('name') ?>" required>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" name="price" id="price" class="form-control" value="<?= old('price') ?>" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"><?= old('description') ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
    <a href="/products" class="btn btn-secondary">Back</a>
</form>
<?= $this->endSection() ?>
