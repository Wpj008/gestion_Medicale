<?php
    include('Configuration/config.php');

    $sql = "SELECT id_MotifExamen, lib_MotifExamen FROM motifexamen";
    $stmt = $pdo->query($sql);
    ?>