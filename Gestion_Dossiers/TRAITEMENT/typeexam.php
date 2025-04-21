<?php
    include('Configuration/config.php');

    $sql = "SELECT id_TypExamen, lib_TypExamen FROM typeexamen";
    $stmt = $pdo->query($sql);
    ?>