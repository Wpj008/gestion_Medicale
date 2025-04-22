<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resultat_analyse_sang = $_POST["resultat_analyse_sang"];
    $resultat_examen_imagerie = $_POST["resultat_examen_imagerie"];
    $resultat_autre_examens = $_POST["resultat_autre_examens"];
    $id_examen = $_POST["id_examen"];

    try {
        include('../Configuration/config.php');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO resultat_examen (id_examen, analyse_sang, examen_imagerie, autres_examens, id_agent)
                VALUES (:id_examen, :resultat_analyse_sang, :resultat_examen_imagerie, :resultat_autre_examens, 1)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_examen', $id_examen);
        $stmt->bindParam(':resultat_analyse_sang', $resultat_analyse_sang);
        $stmt->bindParam(':resultat_examen_imagerie', $resultat_examen_imagerie);
        $stmt->bindParam(':resultat_autre_examens', $resultat_autre_examens);

        $stmt->execute();

        // Redirection après succès
        header("Location: ../ResultatExamen.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $pdo = null;
}
?>
