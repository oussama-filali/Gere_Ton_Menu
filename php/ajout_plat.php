<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Accès refusé !");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $categorie_id = $_POST['categorie_id'];
    $utilisateur_id = $_SESSION['user_id'];

    // Gestion de l'image
    $image = $_FILES['image']['name'];
    $target = "../uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Insertion en BDD
    $sql = "INSERT INTO plats (nom, description, prix, image, categorie_id, utilisateur_id) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $description, $prix, $image, $categorie_id, $utilisateur_id]);

    echo "Plat ajouté avec succès !";
}
?>
