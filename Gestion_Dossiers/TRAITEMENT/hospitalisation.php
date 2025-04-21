<?php
    include('Configuration/config.php');

    $sql = "SELECT id_hospitalisation,patient.id_patient, patient.nom as nom_patient,patient.postnom as postnom_patient,patient.prenom as prenom_patient,
    lib_categ,etat_patient,date_admission,date_sortie_prevue,agent.nom as nom_agent,agent.prenom as prenom_agent 
    FROM hospitalisation
    inner join patient on patient.id_patient = hospitalisation.id_patient
    inner join categorie on categorie.id_categorie = patient.id_categorie
    inner join agent on agent.id_agent = patient.id_agent
     ORDER BY id_hospitalisation DESC";
    $stmt = $pdo->query($sql);

    $req = $pdo->query("SELECT COUNT(*) as nombre_hospitaliser FROM hospitalisation");
    $stmt2 = $req->fetch(PDO::FETCH_ASSOC);

    ?>