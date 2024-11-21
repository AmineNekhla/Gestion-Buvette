<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg, #d3f8e2, #e6f4e7);
        background-color: white;
        margin: 0;
        padding: 0;
    }

    nav {
        z-index: 10; /* Assure que le nav reste au-dessus */
        position: relative;
    }

    .hero-section {
        background-color: white;
        padding: 50px 20px;
        text-align: center;
        position: relative;
        border-bottom-left-radius: 60% 25%;
        border-bottom-right-radius: 60% 25%;
        height: 500px; /* Ajustez la hauteur de l'arc */
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #2b4c28;
        margin-bottom: 50px;
        margin-top: 50px;
       
    }

    .hero-btn {
        background-color: #6db872;
        color: white;
        border: none;
        padding: 10px 20px;
        margin-top: 20px;
        border-radius: 5px;
        font-size: 1rem;
    }

    .hero-btn:hover {
        background-color: #5a9a60;
    }

    .hero-img {
        max-width: 600px;
        width: 100%;
        margin: 0 auto;
        display: block;
        position: relative; /* Supprime le positionnement absolu */
        top: -180px; /* Décalage léger vers le haut */
        z-index: 1;
    }

    .info-section {
        background: linear-gradient(135deg, #d3f8e2, #e6f4e7);
        padding: 50px;
        text-align: center;
    }

    .info-title {
        font-size: 1.8rem;
        color: #2b4c28;
        margin-bottom: 20px;
    }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Buvette Ibn Zohr</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <?php if (session()->get('isLoggedIn')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/products">Products</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="/cart">Cart <span class="badge badge-pill badge-secondary"><?= $itemCount ?? 0 ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/comments">Comments</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="">valide order</a>
                </li>

                <?php if (session()->get('role') == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/products/create">Add Product</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/manage-orders">Manage Order</a>
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


<div class="hero-section">
    <img src="https://img.freepik.com/free-vector/people-sitting-cafe-flat-design_23-2148234523.jpg?t=st=1730642920~exp=1730646520~hmac=6023b83aa4ab1cc1272cc7dba217e5c6396c299536c2eecc024e92799b0b15bb&w=740" alt="Teamwork Illustration" class="hero-img">
    <h1  style="color: #2C3E50;" class="hero-title">Simplifiez vos commandes en un clic</h1>
    <a href="/products" style="background-color: #2C3E50;" class="hero-btn">Order</a>
</div>

<div class="info-section">
    <h2  style="color: #2C3E50;" class="info-title">Connecte-toi, choisis, savoure : la pause parfaite !</h2>
    <p>
<b> 🌟 Connecte-toi :</b> Accède facilement à la plateforme depuis ton téléphone ou ton ordinateur.<br>
<b> 🍴 Choisis :</b> Parcours une sélection variée de produits adaptés à tous les goûts.<br>
<b>😋 Savoure :</b> Récupère ta commande sans stress et profite pleinement de ta pause.<br>

<b>Rejoins-nous et découvre la nouvelle manière de savourer tes pauses scolaires !</b></p>
</div>

</body>
</html>
