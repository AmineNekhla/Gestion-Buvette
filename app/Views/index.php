<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la Buvette</title>
</head>
<body>
    <h1>Liste des Produits</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= $produit['nom']; ?></td>
                    <td><?= $produit['prix']; ?> €</td>
                    <td>
                        <a href="<?= site_url('buvette/supprimer/' . $produit['id']); ?>">Supprimer</a>
                        <a href="<?= site_url('buvette/modifier/' . $produit['id']); ?>">Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h2>Ajouter un Produit</h2>
    <form action="<?= site_url('buvette/ajouter'); ?>" method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required>
        <label for="prix">Prix :</label>
        <input type="number" name="prix" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
