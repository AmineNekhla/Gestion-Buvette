<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Passer une Commande</h1>

<?php if (session()->getFlashdata('success_message')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success_message') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error_message')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error_message') ?>
    </div>
<?php endif; ?>

<?php if (!empty($products) && is_array($products)): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="<?= esc($product['name']) ?>" style="width: 50px; height: 50px;">
                        <?php endif; ?>
                    </td>
                    <td><?= esc($product['name']) ?></td>
                    <td><?= esc($product['price']) ?> MAD</td>
                    <td><?= esc($product['quantity']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Total: <?= esc($totalPrice) ?> MAD</h2>

    <form action="/order" method="post">
        <div class="form-group">
            <label for="delivery_time">Choisissez l'heure de livraison :</label>
            <input type="datetime-local" name="delivery_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Valider la commande</button>
    </form>
<?php else: ?>
    <p>Aucun produit dans le panier pour passer une commande.</p>
<?php endif; ?>

<?= $this->endSection() ?>