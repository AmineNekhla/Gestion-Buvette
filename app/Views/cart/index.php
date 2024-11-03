<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Mon Panier</h1>

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

    <!-- Ajouter ce bloc après le total -->
<?php if (!empty($products) && is_array($products)): ?>
    <a href="cart/order" class="btn btn-primary">Commander</a>
<?php endif; ?>



<?php else: ?>
    <p>Votre panier est vide.</p>
<?php endif; ?>

<?= $this->endSection() ?>
