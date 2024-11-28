<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row g-0">
        <!-- Section de l'image -->
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center" style="background: url('https://img.freepik.com/free-vector/ordering-food-online_23-2147507727.jpg?t=st=1731857688~exp=1731861288~hmac=2e7704495ed35e230e4dc85a9753f1b7fadc85b8d084238d38e089bf09ac2204&w=740') no-repeat center; background-size: cover;">
            <div class="text-center text-white p-5">
                <h1 class="fw-bold  shadow-lg">ADD PRODUCT</h1>
                <p class="mt-3 shadow-lg">Ajoutez facilement vos produits ici</p>
            </div>
        </div>
        
        <!-- Section du formulaire -->
        <div class="col-md-6 d-flex align-items-center">
            <div class="card shadow-lg w-100" style="min-height: 400px;">
                <div class="card-header text-white text-center" style="background-color: #ABDACA;">
                    <h2 class="text-center mb-0">Ajouter un produit</h2>
                </div>
                <div class="card-body">
                    <?php if (session()->has('errors')): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="/products/store" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label for="name">Nom du produit</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom du produit" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">Prix</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Entrez le prix" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="image">Télécharger une image</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn text-white" style="background-color: #2C3E50;">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
