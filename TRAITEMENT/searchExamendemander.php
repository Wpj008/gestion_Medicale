<?php
include('../Configuration/config.php');

if (isset($_POST['query']) && !empty(trim($_POST['query']))) {
    $query = trim($_POST['query']);
    $searchTerms = explode(' ', $query);

    $sql = "SELECT demandexamen.id_examen,patient.id_patient, patient.nom as nom_patient,patient.postnom as postnom_patient,patient.prenom as prenom_patient,
            lib_MotifExamen, lib_TypExamen,partieCorpsConcernee,AntecedentMedicauxDemande,TraitementEncours
            FROM demandexamen
            inner join consultation on consultation.id_consultation = demandexamen.id_consultation
            inner join prelevement on prelevement.id_pre = consultation.id_pre
            inner join patient on patient.id_patient = prelevement.id_patient
            inner join categorie on categorie.id_categorie = patient.id_categorie
            inner join motifexamen on motifexamen.id_MotifExamen = demandexamen.id_MotifExamen
            inner join typeexamen on typeexamen.id_TypExamen = demandexamen.id_TypExamen
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
                    <td>" . htmlspecialchars($ligne['nom_patient']) . "</td>
                    <td>" . htmlspecialchars($ligne['postnom_patient']) . "</td>
                    <td>" . htmlspecialchars($ligne['prenom_patient']) . "</td>
                    <td class='status delivered'>" . htmlspecialchars($ligne['lib_TypExamen']) . "</td>
                    <td>" . htmlspecialchars($ligne['lib_MotifExamen']) . "</td>
                    <td>" . htmlspecialchars($ligne['partieCorpsConcernee']) . "</td>
                    <td>" . htmlspecialchars($ligne['AntecedentMedicauxDemande']) . "</td>
                    <td>" . htmlspecialchars($ligne['TraitementEncours']) . "</td>
                    <td><a href='#'> <i class='uil uil-edit'></i></a></td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>Aucun résultat trouvé</td></tr>";
    }
}
?>
