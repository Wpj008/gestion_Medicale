<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $etat_patient = $_POST["etat_patient"];
    $date_admission = $_POST["date_admission"];
    $date_sortie = $_POST["date_sortie"];
    $patient_id = $_POST["patient_id"];

    try {
        include('../Configuration/config.php');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO hospitalisation (etat_patient, id_patient, date_admission, date_sortie_prevue,id_agent)
                VALUES (:etat_patient, :patient_id, :date_admission, :date_sortie, 1)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':etat_patient', $etat_patient);
        $stmt->bindParam(':patient_id', $patient_id);
        $stmt->bindParam(':date_admission', $date_admission);
        $stmt->bindParam(':date_sortie', $date_sortie);

        $stmt->execute();

        // Redirection après succès
        header("Location: ../hospitaliser.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $pdo = null;
}
?>
