<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/home">Buvette Ibn Zohr</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <?php if (session()->get('isLoggedIn')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cart/order">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cart">Cart <span class="badge badge-pill badge-secondary"><?= $itemCount ?? 0 ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/comments">Comments</a>
                </li>
                <?php if (session()->get('role') == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/products/create">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manage Order</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white text-center">
                        <h2>Connexion</h2>
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
                                <button type="submit" class="btn btn-dark btn-block">Se connecter</button>
                            </div>
                        </form>
                        <p class="mt-3 text-center">Pas encore un membre? <a href="/">S'inscrire</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
