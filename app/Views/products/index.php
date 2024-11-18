<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card-header text-center text-white py-3" style="background-color: #2C3E50;">
            <h2 class="mb-0">Welcome!</h2>
        </div>
        <br>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->get('isLoggedIn')): ?>
    <?php if (session()->get('role') == 1): ?>
        <a href="/products/create" class="btn btn-dark mb-4 d-block mx-auto" style="background-color: #ABDACA;">Add New Product</a>
    <?php endif; ?>
<?php endif; ?>

<?php if (!empty($products) && is_array($products)): ?>
    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card shadow-lg border-light rounded">
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?= base_url('uploads/' . $product['image']) ?>" class="card-img-top" alt="<?= esc($product['name']) ?>" style="height: 200px; object-fit: cover; border-bottom: 2px solid #f1f1f1;">
                        <?php endif; ?>

                        <div class="card-body text-center">
                            <h5 class="card-title"><?= esc($product['name']) ?></h5>
                            <p class="card-text text-muted">Price: <strong><?= esc($product['price']) ?> MAD</strong></p>
                        </div>

                        <div class="card-footer text-center">
                            <?php if (session()->get('role') == 1): ?>
                                <a style="background-color:  #ABDACA;" href="/products/edit/<?= $product['id'] ?>" class="btn  btn-sm mx-2">Edit</a>
                                <a style="background-color:  #BDC3C7;" href="/products/delete/<?= $product['id'] ?>" class="btn  btn-sm mx-2">Delete</a>
                            <?php endif; ?>
                            <a href="/cart/add/<?= $product['id'] ?>" class="btn btn-dark btn-sm mx-2">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <p class="text-center">No products found.</p>
<?php endif; ?>

<?= $this->endSection() ?>
