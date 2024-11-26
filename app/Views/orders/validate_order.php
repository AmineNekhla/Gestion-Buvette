<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center text-white py-3" style="background-color: #ABDACA;">
            <h2 class="mb-0">Validation de la commande</h2>
        </div>
        <div class="card-body">
        <form action="<?= base_url('/order/saveValidation') ?>" method="post">
    <input type="hidden" name="order_id" value="<?= esc($order['id']) ?>"> <!-- Add this -->
    <input type="hidden" name="user_id" value="<?= esc($user['id']) ?>">
    <input type="hidden" name="username" value="<?= esc($user['username']) ?>">
    <input type="hidden" name="email" value="<?= esc($user['email']) ?>">
    <input type="hidden" name="products" value="<?= !empty($products) ? implode(', ', $products) : 'Aucun produit' ?>">
    <input type="hidden" name="total_price" value="<?= esc($order['total_price']) ?>">

    <div class="mb-4">
        <label class="form-label fw-bold">Description (à remplir par l'admin)</label>
        <textarea name="description" class="form-control" rows="4" placeholder="Ajoutez une description ici"></textarea>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success px-5">
            <i class="bi bi-check-circle"></i> Valider la commande
        </button>
    </div>
</form>


        </div>
    </div>
</div>

<?= $this->endSection() ?>
