<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification que les mots de passe correspondent
    if ($_POST['password'] !== $_POST['password_confirm']) {
        $_SESSION['error_message'] = "Les mots de passe ne correspondent pas";
        header("Location: ../ajouter_agent.php");
        exit;
    }

    // Récupération des données
    $nom = $_POST['nom'] ?? null;
    $postnom = $_POST['postnom'] ?? null;
    $prenom = $_POST['prenom'] ?? null;
    $telephone = $_POST['telephone'] ?? null;
    $AdresseMail = $_POST['AdresseMail'] ?? null;
    $sexe = $_POST['sexe'] ?? null;
    $adresse = $_POST['adresse'] ?? null;
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id_specialite = $_POST['id_specialite'] ?? null;
    $id_fonction = $_POST['id_fonction'] ?? null;

    try {
        include('../Configuration/config.php');
        
        $sql = "INSERT INTO agent (nom, postnom, prenom, telephone, AdresseMail, sexe, adresse, password, id_specialite, id_fonction) 
                VALUES (:nom, :postnom, :prenom, :telephone, :AdresseMail, :sexe, :adresse, :password, :id_specialite, :id_fonction)";
                
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':postnom', $postnom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':AdresseMail', $AdresseMail);
        $stmt->bindParam(':sexe', $sexe);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id_specialite', $id_specialite);
        $stmt->bindParam(':id_fonction', $id_fonction);
        
        $stmt->execute();
        
        $_SESSION['success_message'] = "Agent ajouté avec succès";
        header("Location: ../liste_agents.php");
        exit;
        
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erreur lors de l'ajout de l'agent: " . $e->getMessage();
        header("Location: ../ajouter_agent.php");
        exit;
    }
}
?>