<?php
session_start();
include('../Configuration/config.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error_message'] = "ID invalide";
    header("Location: ../liste_agents.php");
    exit;
}

$id_agent = (int)$_GET['id'];

try {
    // Récupérer le statut actuel
    $stmt = $pdo->prepare("SELECT status FROM agent WHERE id_agent = ?");
    $stmt->execute([$id_agent]);
    $current_status = $stmt->fetchColumn();
    
    // Inverser le statut
    $new_status = ($current_status === 'actif') ? 'inactif' : 'actif';
    
    // Mettre à jour
    $update = $pdo->prepare("UPDATE agent SET status = ? WHERE id_agent = ?");
    $update->execute([$new_status, $id_agent]);
    
    $_SESSION['success_message'] = "Statut mis à jour avec succès";
    
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erreur : " . $e->getMessage();
}

header("Location: ../liste_agents.php");
exit;
?>