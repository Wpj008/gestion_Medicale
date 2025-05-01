<?php
session_start();
include 'Configuration/config.php';

// 1. Vérification de la session
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) {
    header("Location: accueil.php");
    exit();
}

// 2. Vérification de l'existence d'au moins un admin
function hasAdminAccount($pdo) {
    $query = $pdo->prepare("SELECT COUNT(*) FROM agent WHERE id_fonction = 6"); // 6 = ID de la fonction ADMIN
    $query->execute();
    return $query->fetchColumn() > 0;
}

// 3. Redirection intelligente
if (hasAdminAccount($pdo)) {
    // S'il existe un admin, rediriger vers la connexion
    header("Location: login.php");
} else {
    // Sinon, rediriger vers la création de compte admin
    header("Location: register_admin.php");
}
exit();
?>