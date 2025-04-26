<?php
    include('Configuration/config.php');

    $sql = "SELECT demandexamen.id_examen,patient.id_patient, patient.nom as nom_patient,patient.postnom as postnom_patient,patient.prenom as prenom_patient,
    lib_MotifExamen, lib_TypExamen,partieCorpsConcernee,AntecedentMedicauxDemande,TraitementEncours
    FROM demandexamen
    inner join consultation on consultation.id_consultation = demandexamen.id_consultation
    inner join prelevement on prelevement.id_pre = consultation.id_pre
    inner join patient on patient.id_patient = prelevement.id_patient
    inner join categorie on categorie.id_categorie = patient.id_categorie
    inner join motifexamen on motifexamen.id_MotifExamen = demandexamen.id_MotifExamen
    inner join typeexamen on typeexamen.id_TypExamen = demandexamen.id_TypExamen
     ORDER BY demandexamen.id_examen DESC";
    $stmt = $pdo->query($sql);

    $req = $pdo->query("SELECT COUNT(*) as nombre_exmane_demander FROM demandexamen");
    $stmt2 = $req->fetch(PDO::FETCH_ASSOC);

    ?>