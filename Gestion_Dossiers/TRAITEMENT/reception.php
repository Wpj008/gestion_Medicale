<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $postnom = $_POST["postnom"];
    $prenom = $_POST["prenom"];
    $numero = $_POST["numero"];
    $sexe = $_POST["sexe"];
    $adresse = $_POST["adresse"];
    $date_naissance = $_POST["date_naissance"];
    $email = $_POST["email"];
    $categorie = $_POST["categorie"];

    try {
        include('../Configuration/config.php');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO patient(nom, postnom, prenom, telephone, Datenaiss, AdresseMail, sexe, adresse, id_categorie, id_agent)
                VALUES (:nom, :postnom, :prenom, :telephone, :Datenaiss, :AdresseMail, :sexe, :adresse, :categorie, 1)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':postnom', $postnom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':telephone', $numero);
        $stmt->bindParam(':Datenaiss', $date_naissance);
        $stmt->bindParam(':AdresseMail', $email);
        $stmt->bindParam(':sexe', $sexe);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':categorie', $categorie);

        $stmt->execute();

        echo "Enregistrement réussi";
        header("Location: ../consultation.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
    $pdo = null;
}
?>
