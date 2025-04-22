<?php
    include('Configuration/config.php');

    $sql_specialite = "SELECT id_specialite, lib_specialite FROM specialite";
    $stmt_specialite = $pdo->query($sql_specialite);

    ?>