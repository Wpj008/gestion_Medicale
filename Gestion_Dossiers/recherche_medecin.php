<?php
include('Configuration/config.php');

if (isset($_GET['query'])) {

    $query = trim($_GET['query']);

    $searchTerms = explode(' ', $query);
    
    $sql = "SELECT nom,postnom,prenom,lib_categ as categorie,id_pre,temperature,tension_arterielle,Frequence_cardiaque,Frequence_respiratoire,Examens_systeme FROM prelevement
    INNER JOIN patient on patient.id_patient = prelevement.id_patient
    inner join categorie on categorie.id_categorie = patient.id_categorie
     WHERE ";
    $params = [];
    foreach ($searchTerms as $index => $term) {

        if ($index == 0) {
            $sql .= "nom LIKE :term" . $index . " ";
        } elseif ($index == 1) {
            $sql .= "AND postnom LIKE :term" . $index . " ";
        } elseif ($index == 2) {
            $sql .= "AND prenom LIKE :term" . $index . " ";
        }

        $params['term' . $index] = "%" . $term . "%";
    }

    $sql .= "LIMIT 5";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nomComplet = htmlspecialchars($row['nom'] . ' ' . $row['postnom'] . ' ' . $row['prenom']);
            echo '<div class="result-item" data-id="' . htmlspecialchars($row['id_pre']) . '" 
                data-nom="' . htmlspecialchars($row['nom']) . '" 
                data-postnom="' . htmlspecialchars($row['postnom']) . '" 
                data-prenom="' . htmlspecialchars($row['prenom']) . '" 
                data-categorie="' . htmlspecialchars($row['categorie']) . '" 
                data-temperature="' . htmlspecialchars($row['temperature']) . '" 
                data-tension_arterielle="' . htmlspecialchars($row['tension_arterielle']) . '" 
                data-Frequence_cardiaque="' . htmlspecialchars($row['Frequence_cardiaque']) . '" 
                data-Frequence_respiratoire="' . htmlspecialchars($row['Frequence_respiratoire']) . '" 
                data-Examens_systeme="' . htmlspecialchars($row['Examens_systeme']) . '" 
                onclick="selectionnerPatient(\'' . $nomComplet . '\')">';
            echo $nomComplet;
            echo '</div>';
        }
    } else {
        echo '<div>Aucun patient trouvé.</div>';
    }
}
?>
