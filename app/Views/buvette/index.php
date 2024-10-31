<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="mb-4">Welcome ! </h1>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->get('isLoggedIn')): ?>
    <?php if (session()->get('email') == 'AdminBuvette@gmail.com'): ?>
        <a href="/products/create" class="btn btn-dark mb-3">Add New Product</a>
    <?php endif; ?>
<?php endif; ?>

<?php if (!empty($products) && is_array($products)): ?>
<div class="container mt-5">
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4"> 
                <div class="card h-100">
                    <?php if (!empty($product['image'])): ?>
                        <img src="<?= base_url('uploads/' . $product['image']) ?>" class="card-img-top" alt="<?= esc($product['name']) ?>" style="height: 200px; object-fit: cover;">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= esc($product['name']) ?></h5>
                        <p class="card-text">Price: <?= esc($product['price']) ?> MAD</p>
                    </div>
                    
                    <div class="card-footer text-center">
                        <?php if (session()->get('email') == 'AdminBuvette@gmail.com'): ?>
                            <a href="<?= site_url('products/edit/' . $product['id']) ?>" class="btn btn-light btn-sm shadow">Edit</a>
                            <a href="<?= site_url('products/delete/' . $product['id']) ?>" class="btn btn-dark btn-sm shadow" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?');">Delete</a>
                        <?php endif; ?>
                        <a href="<?= site_url('cart/add/' . $product['id']) ?>" class="btn btn-light btn-sm shadow">Add to cart</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php else: ?>
    <p>No products found.</p>
<?php endif; ?>

<?= $this->endSection() ?>
