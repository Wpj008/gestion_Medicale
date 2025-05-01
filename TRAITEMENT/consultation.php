<?php
    include('Configuration/config.php');

    $sql = "SELECT * FROM patient ORDER BY id_patient DESC";
    $stmt = $pdo->query($sql);

    $req = $pdo->query("SELECT COUNT(*) as nombre_patient FROM patient");
    $stmt2 = $req->fetch(PDO::FETCH_ASSOC);

    ?>