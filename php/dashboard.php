<?php
require_once 'check_session.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <link rel="stylesheet" href="../assets/ajout plat.php">
    <link rel="stylesheet" href="../assets/register.php">
    <link rel="stylesheet" href="../assets/login.php">
    <link rel="stylesheet" href="../assets/login.html">

</head>
<body>
    <!-- Contenu du dashboard -->
    <h1>Bienvenue <?php echo $_SESSION['user_name']; ?></h1>
    <a href="logout.php">Déconnexion</a>
    <!-- Ajoutez ici le contenu de votre dashboard -->


</body>
</html>