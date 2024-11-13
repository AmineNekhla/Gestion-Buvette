<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Validation de la commande</h2>

    <form action="" method="post">
        <div class="form-group">
            <label>Nom de l'utilisateur</label>
            <input type="text" class="form-control" value="<?= esc($user['username']) ?>" readonly>
        </div>

        <div class="form-group">
            <label>Email de l'utilisateur</label>
            <input type="text" class="form-control" value="<?= esc($user['email']) ?>" readonly>
        </div>

        <div class="form-group">
        <label>Produits</label>
        <textarea class="form-control" readonly><?= !empty($products) ? implode(', ', $products) : 'Aucun produit' ?></textarea>
        </textarea>
     </div>

        <div class="form-group">
            <label>Prix total</label>
            <input type="text" class="form-control" value="<?= esc($order['total_price']) ?> MAD" readonly>
        </div>

        <div class="form-group">
            <label>Description (à remplir par l'admin)</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Valider la commande</button>
    </form>
</div>

<?= $this->endSection() ?>
