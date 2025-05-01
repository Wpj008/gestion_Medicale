<?php
    include('Configuration/config.php');

    $sql = "SELECT id_paie,patient.id_patient, nom,postnom,prenom,lib_categ,lib_Motifpaie,montant,lib_Modepaiement FROM paiement
    inner join patient on patient.id_patient = paiement.id_patient
    inner join categorie on categorie.id_categorie = patient.id_categorie
    inner join motifpaiement on motifpaiement.id_Motifpaie = paiement.id_Motifpaie
    inner join modepaiement on modepaiement.id_Modepaiement = paiement.id_Modepaiement
     ORDER BY id_paie DESC";
    $stmt = $pdo->query($sql);

    $req = $pdo->query("SELECT COUNT(*) as nombre_paiement FROM paiement");
    $stmt2 = $req->fetch(PDO::FETCH_ASSOC);

    ?>