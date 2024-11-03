<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background: linear-gradient(135deg, #d3f8e2, #e6f4e7);
            background-color: white;

        }
        .hero-section {
            /* background-color: #f9f9f9; */
            background-color: white;
            padding: 100px 50px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            border-bottom-left-radius: 50% 20%;
            border-bottom-right-radius: 50% 20%;
        }
        .hero-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2b4c28;
            margin-bottom: 20px;
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
            margin-bottom: 30px;
            background-color: #f9f9f9;

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
        <a class="navbar-brand" href="#">Buvette Ibn Zohr</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
            <?php if (session()->get('isLoggedIn')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Order</a>
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

    <div class="hero-section">
        <!-- <img src="https://img.freepik.com/free-vector/blank-menu_1308-31063.jpg?t=st=1730642719~exp=1730646319~hmac=c4380ff09ef057b89311f88ec95cfd3c8992b4266ddeb85c5ce4a95cc844fe62&w=740" alt="Teamwork Illustration" class="hero-img"> -->
        <img src="https://img.freepik.com/free-vector/people-sitting-cafe-flat-design_23-2148234523.jpg?t=st=1730642920~exp=1730646520~hmac=6023b83aa4ab1cc1272cc7dba217e5c6396c299536c2eecc024e92799b0b15bb&w=740" alt="Teamwork Illustration" class="hero-img">

        <h1 class="hero-title">Take Your Career to the Next Level with Buvette</h1>
        <button class="hero-btn">order</button>
    </div>
    <div class="info-section">
        <h2 class="info-title">Why Buvette for Professionals & Job Seekers</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, alias unde voluptatem corporis odit esse porro praesentium provident atque, quos ex perferendis, non omnis ducimus impedit. Vitae, repellendus. Cupiditate, harum. </p>
    </div>
</body>
</html>
