<?php
    include('Configuration/config.php');

    $sql = "SELECT id_categorie, lib_categ FROM categorie";
    $stmt = $pdo->query($sql);

    ?>