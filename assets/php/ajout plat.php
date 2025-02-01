<?php
session_start();
require_once 'check_session.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gere_ton_menu";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomPlat = htmlspecialchars($_POST['nom-plat']);
    $description = htmlspecialchars($_POST['description']);

    try {
        $stmt = $conn->prepare("INSERT INTO plats (nom, description) VALUES (:nom, :description)");
        $stmt->execute([
            ':nom' => $nomPlat,
            ':description' => $description
        ]);
        
        header("Location: ../ajout_plat.html?ajout=success");
        exit();
    } catch(PDOException $e) {
        header("Location: ../ajout_plat.html?error=failed");
        exit();
    }
}
?>
