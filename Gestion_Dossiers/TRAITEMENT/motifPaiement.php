<?php
    include('Configuration/config.php');

    $sql = "SELECT id_Motifpaie, lib_Motifpaie, prix as montant FROM motifpaiement";
    $stmt = $pdo->query($sql);
    ?>