<?php
include('../Configuration/config.php');

if (isset($_POST['query']) && !empty(trim($_POST['query']))) {
    $query = trim($_POST['query']);
    $searchTerms = explode(' ', $query);

    $sql = "SELECT patient.id_patient, nom, postnom, prenom, lib_categ, analyse_sang, examen_imagerie,
                   autres_examens, dateheure_resultat_analyse 
            FROM resultat_examen
            INNER JOIN demandexamen ON demandexamen.id_examen = resultat_examen.id_examen
            INNER JOIN consultation ON consultation.id_consultation = demandexamen.id_consultation
            INNER JOIN prelevement ON prelevement.id_pre = consultation.id_pre
            INNER JOIN patient ON patient.id_patient = prelevement.id_patient
            INNER JOIN categorie ON categorie.id_categorie = patient.id_categorie
            WHERE ";

    $params = [];
    $conditions = [];

    foreach ($searchTerms as $index => $term) {
        $conditions[] = "(nom LIKE :term$index OR postnom LIKE :term$index OR prenom LIKE :term$index)";
        $params["term$index"] = "%$term%";
    }

    $sql .= implode(" AND ", $conditions);
    $sql .= " LIMIT 10";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        foreach ($results as $ligne) {
            echo "<tr>
                    <td>" . htmlspecialchars($ligne['id_patient']) . "</td>
                    <td>" . htmlspecialchars($ligne['nom']) . "</td>
                    <td>" . htmlspecialchars($ligne['postnom']) . "</td>
                    <td>" . htmlspecialchars($ligne['prenom']) . "</td>
                    <td>" . htmlspecialchars($ligne['analyse_sang']) . "</td>
                    <td>" . htmlspecialchars($ligne['examen_imagerie']) . "</td>
                    <td>" . htmlspecialchars($ligne['autres_examens']) . "</td>
                    <td class='status inprogress'>" . htmlspecialchars($ligne['dateheure_resultat_analyse']) . "</td>
                    <td>Felix KIABU</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>Aucun résultat trouvé</td></tr>";
    }
}
?>
