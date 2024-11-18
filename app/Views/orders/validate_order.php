<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center text-white py-3" style="background-color: #ABDACA;">
            <h2 class="mb-0">Validation de la commande</h2>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-4">
                    <label class="form-label fw-bold">Nom de l'utilisateur</label>
                    <input type="text" class="form-control bg-light" value="<?= esc($user['username']) ?>" readonly>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Email de l'utilisateur</label>
                    <input type="text" class="form-control bg-light" value="<?= esc($user['email']) ?>" readonly>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Produits</label>
                    <textarea class="form-control bg-light" rows="3" readonly><?= !empty($products) ? implode(', ', $products) : 'Aucun produit' ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Prix total</label>
                    <input type="text" class="form-control bg-light fw-bold text-success" value="<?= esc($order['total_price']) ?> MAD" readonly>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Description (à remplir par l'admin)</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Ajoutez une description ici"></textarea>
                </div>

                <div class="text-center">
                    <button style="background-color: #2C3E50;" type="submit" class="btn btn-success px-5">
                        <i class="bi bi-check-circle"></i> Valider la commande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
