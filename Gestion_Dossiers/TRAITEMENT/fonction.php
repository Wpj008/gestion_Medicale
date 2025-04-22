<?php
    include('Configuration/config.php');

    $sql_fonction = "SELECT id_fonction, lib_fonction FROM fonction";
    $stmt_fonction = $pdo->query($sql_fonction);

    ?>