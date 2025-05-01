<?php
    include('Configuration/config.php');

    $sql = "SELECT id_agent, nom,prenom,postnom FROM agent";
    $stmt = $pdo->query($sql);

    ?>