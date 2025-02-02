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
    $prix = floatval($_POST['prix']);

    // Gestion de l'image
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Vérifier si le fichier est une image réelle
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check === false) {
        die("Le fichier n'est pas une image.");
    }

    // Déplacer le fichier téléchargé vers le répertoire cible
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        die("Désolé, une erreur s'est produite lors du téléchargement de votre fichier.");
    }

    try {
        $stmt = $conn->prepare("INSERT INTO plats (nom, description, prix, image) VALUES (:nom, :description, :prix, :image)");
        $stmt->execute([
            ':nom' => $nomPlat,
            ':description' => $description,
            ':prix' => $prix,
            ':image' => $targetFile
        ]);

        header("Location: ../accueil.html?ajout=success");
        exit();
    } catch(PDOException $e) {
        header("Location: ../accueil.html?error=ajout_failed");
        exit();
    }
}
?>
