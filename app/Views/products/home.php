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
        margin-bottom: 20px;
        margin-top: 20px;
       
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
    <a class="navbar-brand" href="/home">Buvette Ibn Zohr</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <?php if (session()->get('isLoggedIn')): ?>
                <li class="nav-item"><a class="nav-link" href="/products">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Order</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="/cart">Cart <span class="badge badge-pill badge-secondary"><?= $itemCount ?? 0 ?></span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/comments">Comments</a></li>
                <?php if (session()->get('role') == 1): ?>
                    <li class="nav-item"><a class="nav-link" href="/products/create">Add Product</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Manage Order</a></li>
                <?php endif; ?>
            <?php endif; ?>
            <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="hero-section">
    <img src="https://img.freepik.com/free-vector/people-sitting-cafe-flat-design_23-2148234523.jpg?t=st=1730642920~exp=1730646520~hmac=6023b83aa4ab1cc1272cc7dba217e5c6396c299536c2eecc024e92799b0b15bb&w=740" alt="Teamwork Illustration" class="hero-img">
    <h1  style="color: #2C3E50;" class="hero-title">Take Your Career to the Next Level with Buvette</h1>
    <a href="/products" style="background-color: #2C3E50;" class="hero-btn">Order</a>
</div>

<div class="info-section">
    <h2  style="color: #2C3E50;" class="info-title">Why Buvette for Professionals & Job Seekers</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, alias unde voluptatem corporis odit esse porro praesentium provident atque, quos ex perferendis, non omnis ducimus impedit. Vitae, repellendus. Cupiditate, harum.</p>
</div>

</body>
</html>
