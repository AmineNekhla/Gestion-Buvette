<!DOCTYPE html>
<html>
<head>
    <title>Mes Réponses</title>
</head>
<body>
    <h1>Mes Réponses</h1>
    <?php if (!empty($responses)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Commande</th>
                    <th>Réponse</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responses as $response): ?>
                    <tr>
                        <td><?= esc($response['validation_id']) ?></td>
                        <td><?= esc($response['response']) ?></td>
                        <td><?= esc($response['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Vous n'avez aucune réponse enregistrée.</p>
    <?php endif; ?>
</body>
</html>
