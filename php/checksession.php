<?php
session_start();
$allowed_pages = ['connexion.php', 'register.php', 'ajout_plat.php', 'ajout_plat.html', 'dashboard.php'];
$current_page = basename($_SERVER['PHP_SELF']);

if (!in_array($current_page, $allowed_pages) && !isset($_SESSION['username'])) {
    header("Location: ../connexion.php");
    exit();
}
?>