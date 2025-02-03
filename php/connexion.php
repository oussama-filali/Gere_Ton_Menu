<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../connexion.php");
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
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $sql = "SELECT * FROM restaurateurs WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['username'] = $username;
            header("Location: ../ajout_plat.php");
            exit();
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect";
        }
    }
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
?>