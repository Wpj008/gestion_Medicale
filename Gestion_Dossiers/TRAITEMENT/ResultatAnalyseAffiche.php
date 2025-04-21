<?php
    include('Configuration/config.php');

    $sql = "SELECT patient.id_patient, nom,postnom,prenom,lib_categ,analyse_sang,examen_imagerie,
    autres_examens FROM resultat_examen
    inner join demandexamen on demandexamen.id_examen = resultat_examen.id_examen
    inner join consultation on consultation.id_consultation = demandexamen.id_consultation
    inner join prelevement on prelevement.id_pre = consultation.id_pre
    inner join patient on patient.id_patient = prelevement.id_patient
    inner join categorie on categorie.id_categorie = patient.id_categorie
     ORDER BY id_resultat DESC";
    $stmt = $pdo->query($sql);

    $req = $pdo->query("SELECT COUNT(*) as nombre_resultat_examen FROM resultat_examen");
    $stmt2 = $req->fetch(PDO::FETCH_ASSOC);

    ?>