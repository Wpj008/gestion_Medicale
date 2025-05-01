<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Diagnose_medicale = $_POST["Diagnose_medicale"];
    $Traitement_medical = $_POST["Traitement_medical"];
    $medicament_pris = $_POST["medicament_pris"];
    $motif_consultation = $_POST["motif_consultation"];
    $symptome_actuel = $_POST["symptome_actuel"];
    $atecedant_medicaux = $_POST["atecedant_medicaux"];
    $atecedant_chirurgicaux = $_POST["atecedant_chirurgicaux"];
    $atecedant_familiaux = $_POST["atecedant_familiaux"];
    $prelevement_id = $_POST["prelevement_id"];

    try {
        include('../Configuration/config.php');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO consultation(id_pre,id_agent,Diagnose_medicale, Traitement_medical, medicament_pris,
         motif_consultation,symptome_actuel,atecedant_medicaux,atecedant_chirurgicaux,atecedant_familiaux)
                VALUES (:prelevement_id,1, :Diagnose_medicale, :Traitement_medical, :medicament_pris, 
                :motif_consultation,:symptome_actuel,:atecedant_medicaux,:atecedant_chirurgicaux,:atecedant_familiaux)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':prelevement_id', $prelevement_id);
        $stmt->bindParam(':Diagnose_medicale', $Diagnose_medicale);
        $stmt->bindParam(':Traitement_medical', $Traitement_medical);
        $stmt->bindParam(':medicament_pris', $medicament_pris);
        $stmt->bindParam(':motif_consultation', $motif_consultation);
        $stmt->bindParam(':symptome_actuel', $symptome_actuel);
        $stmt->bindParam(':atecedant_medicaux', $atecedant_medicaux);
        $stmt->bindParam(':atecedant_chirurgicaux', $atecedant_chirurgicaux);
        $stmt->bindParam(':atecedant_familiaux', $atecedant_familiaux);

        $stmt->execute();

        // Redirection après succès
        header("Location: ../medecin.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $pdo = null;
}
?>
