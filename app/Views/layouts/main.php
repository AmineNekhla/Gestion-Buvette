<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My App' ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Buvette Ibn Zohr</a>
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
        <a class="nav-link" href="/comments">Comments</a> <!-- Add this line -->
    </li>
               <?php if (session()->get('role') == 1): ?>
    <li class="nav-item">
        <a class="nav-link" href="/products/create">Add Product</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="#">Manage Order</a>
    </li>
<?php endif; ?>

            <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
