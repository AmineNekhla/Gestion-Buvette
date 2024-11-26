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
                        <th>Status</th>
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
                                <td><?= esc($order['id']) ?></td>
                                <td><?= esc($order['username']) ?></td>
                                <td><?= implode('<br>', $order['products']) ?></td>
                                <td><?= esc($order['total_price']) ?> MAD</td>
                                <td><?= ucfirst($order['status']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-success validate-order" data-order-id="<?= esc($order['id']) ?>">Valider</button>
                                    <button class="btn btn-sm btn-danger decline-order" data-order-id="<?= esc($order['id']) ?>">Décliner</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.validate-order').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.getAttribute('data-order-id');

            fetch(`<?= base_url('order/updateStatus') ?>`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ id: orderId, status: 'validated' }),
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert('Commande validée!');
                    location.reload();
                } else {
                    alert('Erreur: ' + data.error);
                }
            }).catch(error => {
                console.error(error);
                alert('Erreur: Une erreur inattendue s\'est produite.');
            });
        });
    });

    document.querySelectorAll('.decline-order').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.getAttribute('data-order-id');

            fetch(`<?= base_url('order/updateStatus') ?>`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ id: orderId, status: 'declined' }),
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert('Commande annulée!');
                    location.reload();
                } else {
                    alert('Erreur: ' + data.error);
                }
            }).catch(error => {
                console.error(error);
                alert('Erreur: Une erreur inattendue s\'est produite.');
            });
        });
    });
</script>

<?= $this->endSection() ?>
