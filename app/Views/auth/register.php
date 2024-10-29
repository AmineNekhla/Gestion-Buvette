<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h2 class="text-center">Inscription</h2>
                </div>
                <div class="card-body">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <p><?= $error ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('registerUser') ?>" method="post">
                        <div class="form-group mb-3">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" class="form-control" name="username" placeholder="Entrez votre nom d'utilisateur" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Entrez votre email" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">S'inscrire</button>
                        </div>
                    </form>
                    <p class="mt-3 text-center">Déjà un membre? <a href="<?= site_url('login') ?>">Se connecter</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
