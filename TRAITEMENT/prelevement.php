<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $temperature = $_POST["temperature"];
    $tension_arterielle = $_POST["tension_arterielle"];
    $frequence_cardiaque = $_POST["frequence_cardiaque"];
    $frequence_respiratoire = $_POST["frequence_respiratoire"];
    $examen_systeme = $_POST["examen_systeme"];
    $patient_id = $_POST["patient_id"];

    try {
        include('../Configuration/config.php');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO prelevement (dateetheure, temperature, tension_arterielle, Frequence_cardiaque, Frequence_respiratoire, Examens_systeme, id_patient,id_agent)
                VALUES (NOW(), :temperature, :tension_arterielle, :frequence_cardiaque, :frequence_respiratoire,:examen_systeme, :patient_id, 1)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':temperature', $temperature);
        $stmt->bindParam(':tension_arterielle', $tension_arterielle);
        $stmt->bindParam(':frequence_cardiaque', $frequence_cardiaque);
        $stmt->bindParam(':frequence_respiratoire', $frequence_respiratoire);
        $stmt->bindParam(':examen_systeme', $examen_systeme);
        $stmt->bindParam(':patient_id', $patient_id);

        $stmt->execute();

        // Redirection après succès
        header("Location: ../prelevement.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $pdo = null;
}
?>
