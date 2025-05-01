<?php
    include('Configuration/config.php');

    $sql = "SELECT id_Modepaiement, lib_Modepaiement, numero_transaction as montant FROM modepaiement";
    $stmt = $pdo->query($sql);
    ?>