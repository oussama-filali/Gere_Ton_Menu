<?php
session_start();

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
            header("Location: plat.php");
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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Connexion</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="username">Nom d'utilisateur:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Mot de passe:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Se connecter">
</form>
</body>
</html>