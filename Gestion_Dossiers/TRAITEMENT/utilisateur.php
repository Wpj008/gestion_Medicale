<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $utilisateur = $_POST["utilisateur"];
    $motdepasse = $_POST["motdepasse"];
    $id_agent = $_POST["id_agent"];

    try {
        include('../Configuration/config.php');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO utilisateur(nom, motdepasse, id_agent)
                VALUES (:utilisateur, :motdepasse, :id_agent)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':utilisateur', $utilisateur);
        $stmt->bindParam(':motdepasse', $motdepasse);
        $stmt->bindParam(':id_agent', $id_agent);
        $stmt->execute();

        echo "Enregistrement réussi";
        header("Location: ../utilisateur.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
    $pdo = null;
}
?>
