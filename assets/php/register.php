<?php
session_start();
require_once 'check_session.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gere_ton_menu";
header("Location: ../ajout_plat.html?inscription=success");
exit();


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (nom, email, password) VALUES (:nom, :email, :password)");
        $stmt->execute([
            ':nom' => $name,
            ':email' => $email,
            ':password' => $password
        ]);
        
        header("Location: ../accueil.html?inscription=success");
        exit();
    } catch(PDOException $e) {
        header("Location: ../accueil.html?error=email_exists");
        exit();
    }
}
?>