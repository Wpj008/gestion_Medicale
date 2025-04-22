<?php
session_start();
include('../Configuration/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id_agent'])) {
    $id_agent = $_SESSION['id_agent'];
    
    // Récupération des données du formulaire
    $data = [
        'prenom' => $_POST['prenom'] ?? '',
        'nom' => $_POST['nom'] ?? '',
        'postnom' => $_POST['postnom'] ?? null,
        'sexe' => $_POST['sexe'] ?? null,
        'telephone' => $_POST['telephone'] ?? null,
        'AdresseMail' => $_POST['AdresseMail'] ?? null,
        'adresse' => $_POST['adresse'] ?? null
    ];
    
    try {
        // Construction de la requête SQL
        $sql = "UPDATE agent SET 
                prenom = :prenom, 
                nom = :nom, 
                postnom = :postnom, 
                sexe = :sexe, 
                telephone = :telephone, 
                AdresseMail = :AdresseMail, 
                adresse = :adresse 
                WHERE id_agent = :id_agent";
        
        $stmt = $pdo->prepare($sql);
        $data['id_agent'] = $id_agent;
        $stmt->execute($data);
        
        $_SESSION['success_message'] = "Profil mis à jour avec succès";
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erreur lors de la mise à jour: " . $e->getMessage();
    }
}

header("Location: /profil.php");
exit;
?>