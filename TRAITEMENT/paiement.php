<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lib_motifPaie = $_POST["lib_motifPaie"];
    $montant = $_POST["montant"];
    $modepaie = $_POST["modepaie"];
    $patient_id = $_POST["patient_id"];

    try {
        include('../Configuration/config.php');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO paiement (montant, date_paie, id_Motifpaie, id_patient, id_Modepaiement, id_agent)
                VALUES (:montant, NOW(), :lib_motifPaie, :patient_id, :modepaie, 1)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':montant', $montant);
        $stmt->bindParam(':lib_motifPaie', $lib_motifPaie);
        $stmt->bindParam(':patient_id', $patient_id);
        $stmt->bindParam(':modepaie', $modepaie);

        $stmt->execute();

        // Redirection après succès
        header("Location: ../paiementEnregistrer.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $pdo = null;
}
?>
