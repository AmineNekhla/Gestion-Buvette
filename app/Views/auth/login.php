<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row g-0" style="height: 100vh;"> 
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center" 
             style="background: url('https://img.freepik.com/free-vector/ordering-food-online_23-2147507727.jpg?t=st=1731857688~exp=1731861288~hmac=2e7704495ed35e230e4dc85a9753f1b7fadc85b8d084238d38e089bf09ac2204&w=740') no-repeat center; 
                    background-size: cover; 
                    height: 80%;"> 
            <div class="text-center text-white p-5">
                <h1 class="fw-bold">BIENVENUE</h1>
                <p class="mt-3">Rejoignez notre communauté dès maintenant</p>
            </div>
        </div>

        <div class="col-md-6 d-flex align-items-center" style="height: 80%;"> 
            <div class="card shadow-lg w-100" style="height: 100%;">
                <div class="card-headers text-white" style="background-color: #ABDACA;">
                    <h2 class="text-center">Connexion</h2>
                    <p class="text-center mb-0">Merci de revenir, veuillez vous connecter</p>
                </div>
                <div class="card-body">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= site_url('loginUser') ?>" method="post">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Entrez votre email" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn" style="background-color: #ABDACA;">Se connecter</button>
                        </div>
                    </form>
                    <p class="mt-3 text-center">Pas encore un membre? <a style="color: #ABDACA;" href="/">S'inscrire</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
