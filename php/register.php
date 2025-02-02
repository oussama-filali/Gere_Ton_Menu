<?php
session_start();
require_once 'check_session.php';

// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gere_ton_menu";

try {
    // Établir une connexion à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Gérer les erreurs de connexion
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        // Préparer et exécuter la requête SQL
        $stmt = $conn->prepare("INSERT INTO users (nom, email, password) VALUES (:nom, :email, :password)");
        $stmt->execute([
            ':nom' => $name,
            ':email' => $email,
            ':password' => $password
        ]);

        // Rediriger en cas de succès de l'inscription
        header("Location: ../ajout_plat.html?inscription=success");
        exit();
    } catch(PDOException $e) {
        // Rediriger en cas d'erreur, par exemple si l'email existe déjà
        header("Location: ../accueil.html?error=email_exists");
        exit();
    }
}
?>
