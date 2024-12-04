<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réponses</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<style>
    /* General styling for the page */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

h1 {
    text-align: center;
    margin: 20px 0;
    font-size: 2rem;
    color: #2c3e50;
}

/* Styling for the table */
table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

table thead tr {
    background-color: #007bff;
    color: #fff;
    text-align: left;
}

table th,
table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
}

table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tbody tr:hover {
    background-color: #f1f1f1;
}

.btn {
    display: inline-block;
    padding: 8px 12px;
    font-size: 0.9rem;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
}

.btn:hover {
    background-color: #0056b3;
}

/* Disabled button styling */
.btn-disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    table {
        width: 100%;
    }

    h1 {
        font-size: 1.5rem;
    }
}

</style>
<body>
    <h1>Mes Réponses</h1>
    <table>
        <thead>
            <tr>
                <th>ID COMMANDE</th>
                <th>NOM DU PRODUIT</th>
                <th>RÉPONSE</th>
                <th>DATE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
    <?php if (!empty($responses)): ?>
        <?php foreach ($responses as $response): ?>
            <tr>
                <td><?= $response['validation_id'] ?></td>
                <td><?= $response['product_names'] ?></td>
                <td><?= $response['response'] ?></td>
                <td><?= $response['created_at'] ?></td>
                <td>
                    <!-- Check for "Commande Validée" status directly -->
                    <?php if (stripos($response['response'], 'Commande Validée') !== false): ?>
                        <!-- Display the "Télécharger Reçu" button if validated -->
                        <a href="<?= base_url('order/downloadReceipt/' . $response['validation_id']) ?>" class="btn btn-primary">
                            Télécharger Reçu
                        </a>
                    <?php else: ?>
                        <!-- Display a disabled button if not validated -->
                        <span class="btn btn-disabled">
                            Non validée
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Aucune réponse trouvée</td>
        </tr>
    <?php endif; ?>
</tbody>
    </table>
</body>
</html>

<?= $this->endsection() ?>
