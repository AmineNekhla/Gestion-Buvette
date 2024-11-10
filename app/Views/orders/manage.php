<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Gestion des commandes</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Commande</th>
                <th>Nom de l'utilisateur</th>
                <th>Produits</th>
                <th>Prix total</th>
                <th>Date de la commande</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= esc($order['id']) ?></td>
                    <td><?= esc($order['username']) ?></td>
                    <td>
                        <!-- Affichage des noms des produits -->
                        <?= !empty($order['products']) ? implode(', ', $order['products']) : 'Aucun produit' ?>
                    </td>
                    <td><?= esc($order['total_price']) ?> MAD</td>
                    <td><?= esc($order['order_date']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
