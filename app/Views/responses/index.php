<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réponses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            border-bottom: 1px solid #ddd;
            color: #333;
        }

        .empty-message {
            text-align: center;
            color: #666;
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Mes Réponses</h1>
    <?php if (!empty($responses)): ?>
        <table>
    <thead>
        <tr>
            <th>ID Commande</th>
            <th>Nom du Produit</th>
            <th>Réponse</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($responses as $response): ?>
            <tr>
                <td><?= esc($response['validation_id']) ?></td>
                <td><?= esc($response['product_names'] ?? 'Unknown Product') ?></td>

                <td><?= esc($response['response']) ?></td>
                <td><?= esc($response['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <?php else: ?>
        <p class="empty-message">Vous n'avez aucune réponse enregistrée.</p>
    <?php endif; ?>
</body>
</html>
