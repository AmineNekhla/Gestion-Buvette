<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="text-center mb-4" style="color: #2C3E50; font-family: 'Arial', sans-serif;">Mon Panier</h1>

<?php if (!empty($products) && is_array($products)): ?>
    <div class="container">
        <table class="table table-striped table-bordered" style="border-color: #F39C12;">
            <thead class="" style="background-color: #ABDACA; color: white;">
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td>
                            <?php if (!empty($product['image'])): ?>
                                <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="<?= esc($product['name']) ?>" class="img-fluid rounded" style="max-width: 60px; max-height: 60px;">
                            <?php endif; ?>
                        </td>
                        <td><?= esc($product['name']) ?></td>
                        <td><?= esc($product['price']) ?> MAD</td>
                        <td><?= esc($product['quantity']) ?></td>
                        <td>
                            <a href="<?= base_url('cart/remove/' . $product['id']) ?>" class="btn btn-dark btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce produit du panier ?');" style="background-color: #2C3E5; border: none;">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="mt-4 text-right" style="color: #2C3E50;">Total: <?= esc($totalPrice) ?> MAD</h2>

        <div class="text-center">
            <a href="<?= base_url('cart/validate') ?>" class="btn btn-success btn-lg mt-3" style="background-color: #ABDACA; color: white; border-radius: 20px;">Valider commande</a><br>
            <a href="<?= base_url('/products') ?>" class="btn btn-secondary btn-lg mt-2" style="background-color: #BDC3C7; border-radius: 20px;">Retour aux produits</a>
        </div>
    </div>
<?php else: ?>
    <p class="text-center" style="color: #7F8C8D;">Votre panier est vide.</p>
<?php endif; ?>

<?= $this->endSection() ?>
