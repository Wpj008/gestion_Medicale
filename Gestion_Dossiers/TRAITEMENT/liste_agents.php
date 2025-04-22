<?php
include('Configuration/config.php');

$sql = "SELECT a.*, f.lib_fonction, s.lib_specialite 
        FROM agent a
        LEFT JOIN fonction f ON a.id_fonction = f.id_fonction
        LEFT JOIN specialite s ON a.id_specialite = s.id_specialite
        ORDER BY a.nom, a.postnom, a.prenom";

$stmt = $pdo->prepare($sql);
$stmt->execute();
?>