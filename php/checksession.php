<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $allowed_pages = ['login.php', 'register.php', 'accueil.html'];
    $current_page = basename($_SERVER['PHP_SELF']);
    
    if (!in_array($current_page, $allowed_pages)) {
        header("Location: ../assets/php/login.php");
        exit();
    }
}
?>