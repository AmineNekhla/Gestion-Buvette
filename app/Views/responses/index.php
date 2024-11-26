<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réponses</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
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
                    <a href="<?= base_url('order/downloadReceipt/' . $response['validation_id']) ?>" class="btn btn-primary">
                        Télécharger Reçu
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No responses found</td>
        </tr>
    <?php endif; ?>
</tbody>

    </table>
</body>
</html>
