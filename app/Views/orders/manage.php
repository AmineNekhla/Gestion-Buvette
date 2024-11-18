<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center text-white py-3" style="background-color: #ABDACA;">
            <h2 class="mb-0">Gestion des commandes</h2>
        </div>
        <div class="card-body p-4">
            <table class="table table-hover table-striped align-middle">
                <thead style="background-color: #2C3E50;" class="table-dark text-center">
                    <tr>
                        <th>ID Commande</th>
                        <th>Nom de l'utilisateur</th>
                        <th>Produits</th>
                        <th>Prix total</th>
                        <th>Date de la commande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="6" class="text-muted">Aucune commande trouvée</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><span class="badge bg-secondary"><?= esc($order['id']) ?></span></td>
                                <td><?= esc($order['username']) ?></td>
                                <td>
                                    <?= !empty($order['products']) 
                                        ? implode('<br>', $order['products']) 
                                        : '<span class="text-muted">Aucun produit</span>' ?>
                                </td>
                                <td class="fw-bold text-success"><?= esc($order['total_price']) ?> MAD</td>
                                <td><?= esc($order['order_date']) ?></td>
                                <td>
                                    <a style="background-color: #2C3E50;" href="<?= base_url('order/validateO/' . $order['id']) ?>" class="btn btn-sm btn-success">
                                        <i class="bi bi-check-circle"></i> Valider
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
