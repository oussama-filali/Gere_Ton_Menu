<?php
require 'config.php';
$sql = "SELECT p.*, c.nom AS categorie FROM plats p JOIN categories c ON p.categorie_id = c.id";
$stmt = $pdo->query($sql);
$plats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Plats</title>
    <link rel="stylesheet" href="/css/style1.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo-container">
            <img src="logo appli.webp" alt="Logo" class="logo">
        </div>
        <div class="nav-links">
            <a href="accueil.html">Accueil</a>
            <a href="plats.php">Nos Plats</a>
            <a href="contact.html">Contact</a>
            <a href="php/logout.php">Déconnexion</a>
        </div>
    </nav>

    <main>
        <h1>Nos Plats</h1>
        <ul>
            <?php foreach ($plats as $plat): ?>
                <li>
                    <h2><?= htmlspecialchars($plat['nom']) ?></h2>
                    <p><?= htmlspecialchars($plat['description']) ?></p>
                    <p>Prix : <?= $plat['prix'] ?> €</p>
                    <p>Catégorie : <?= htmlspecialchars($plat['categorie']) ?></p>
                    <img src="../uploads/<?= htmlspecialchars($plat['image']) ?>" width="100">
                </li>
            <?php endforeach; ?>
        </ul>
    </main>

</body>
</html>
