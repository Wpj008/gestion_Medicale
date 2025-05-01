<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $typeexam = $_POST["typeexam"];
    $motifExamen = $_POST["motifExamen"];
    $urgenceExamen = $_POST["urgenceExamen"];
    $parti_concerner = $_POST["parti_concerner"];
    $antecedant_medicaux = $_POST["antecedant_medicaux"];
    $traitement_encours = $_POST["traitement_encours"];
    $id_consultation = $_POST["id_consultation"];

    try {
        include('../Configuration/config.php');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO demandexamen(id_consultation,id_TypExamen,id_MotifExamen, partieCorpsConcernee, AntecedentMedicauxDemande,
         TraitementEncours)
                VALUES (:id_consultation,:typeexam, :motifExamen, :parti_concerner, :antecedant_medicaux, 
                :traitement_encours)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_consultation', $id_consultation);
        $stmt->bindParam(':typeexam', $typeexam);
        $stmt->bindParam(':motifExamen', $motifExamen);
        $stmt->bindParam(':parti_concerner', $parti_concerner);
        $stmt->bindParam(':antecedant_medicaux', $antecedant_medicaux);
        $stmt->bindParam(':traitement_encours', $traitement_encours);

        $stmt->execute();

        // Redirection après succès
        header("Location: ../liste_des_examens_demander.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $pdo = null;
}
?>
