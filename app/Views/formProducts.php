<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stocks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4" style="color: palevioletred;">Gestion des Produits</h1>

       
        <div class="card mb-5">
            <div class="card-header  text-white" style="background-color: pink;">
                <h4 class="mb-0">Ajouter un Produit</h4>
            </div>
            <div class="card-body">
                <form action="/productsForm/add" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du produit :</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantité :</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Prix unitaire :</label>
                        <input type="number" step="0.01" name="price" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100" style="background-color: darkgray;">Ajouter</button>
                </form>
            </div>
        </div>

        <!-- table dyl products -->
        <h2 class="mb-4" style="color: palevioletred;">Liste des Produits</h2>
        <div class="table-responsive" style="background-color: pink;">
            <table class="table table-bordered table-striped" style="background-color: pink;">
                <thead class="table" style="background-color: pink;">
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Disponibilité</th>
                        <th>Valeur Totale</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['quantity'] ?></td>
                            <td><?= $product['price'] ?> MAD</td>
                            <td>
                                <?php
                                if ($product['quantity'] == 0) {
                                    echo "<span class='badge bg-danger'>Rupture de stock</span>";
                                } elseif ($product['quantity'] <= 10) {
                                    echo "<span class='badge bg-warning'>Faible stock</span>";
                                } else {
                                    echo "<span class='badge bg-success'>En stock</span>";
                                }
                                ?>
                            </td>
                            <td><?= $product['quantity'] * $product['price'] ?> MAD</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="alert alert-info mt-4" style="background-color: palevioletred;">
            <h5 class="mb-3">État de Stocks</h5>
            <p><strong>Quantité Totale :</strong> <?= $totalQuantity ?></p>
            <p><strong>État Général :</strong> <?= $generalState ?></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
