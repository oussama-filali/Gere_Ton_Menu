<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilisateurs (nom, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nom, $email, $password])) {
        header("Location: ../accueil.html");
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>
