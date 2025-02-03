<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <main>
        <p>Bienvenue, <?php echo $_SESSION['username']; ?>!</p>
    </main>
    <footer>
        <p>&copy; 2023 Gere Ton Menu</p>
    </footer>
</body>
</html>