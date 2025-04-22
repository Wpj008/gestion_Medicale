<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_heure_soin = $_POST["date_heure_soin"];
    $type_soin = $_POST["type_soin"];
    $description_soin = $_POST["description_soin"];
    $duree_soin = $_POST["duree_soin"];
    $observations = $_POST["observations"];
    $patient_id = $_POST["patient_id"];

    try {
        include('../Configuration/config.php');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO administrationsoin (dateheure_soin, type_soin, description_detailler, dure_soin,observation,id_patient,id_agent)
                VALUES (:date_heure_soin, :type_soin, :description_soin, :duree_soin, :observations,:patient_id, 1)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':date_heure_soin', $date_heure_soin);
        $stmt->bindParam(':type_soin', $type_soin);
        $stmt->bindParam(':description_soin', $description_soin);
        $stmt->bindParam(':duree_soin', $duree_soin);
        $stmt->bindParam(':observations', $observations);
        $stmt->bindParam(':patient_id', $patient_id);

        $stmt->execute();

        // Redirection après succès
        header("Location: ../soin.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $pdo = null;
}
?>
