<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../accueil.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gere_ton_menu";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = htmlspecialchars($_POST['nom']);
        $description = htmlspecialchars($_POST['description']);
        $prix = htmlspecialchars($_POST['prix']);
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "INSERT INTO plats (nom, description, prix, image) VALUES (:nom, :description, :prix, :image)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':image', $target);

            if ($stmt->execute()) {
                echo "Nouveau plat ajouté avec succès";
            } else {
                echo "Erreur lors de l'ajout du plat";
            }
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    }
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Plat</title>
    <link rel="stylesheet" href="css/style1.css">
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
        <h1>Ajouter un Plat</h1>
        <form action="ajout_plat.php" method="POST" enctype="multipart/form-data">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea>

            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix" step="0.01" required>

            <label for="categorie_id">Catégorie :</label>
            <select id="categorie_id" name="categorie_id" required>
                <option value="1">Entrée</option>
                <option value="2">Plat Principal</option>
                <option value="3">Dessert</option>
            </select>

            <label for="image">Image :</label>
            <input type="file" id="image" name="image" required>

            <button type="submit">Ajouter</button>
        </form>
    </main>
</body>
</html>