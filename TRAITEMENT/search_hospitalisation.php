<?php
include('../Configuration/config.php');

if (isset($_POST['query']) && !empty(trim($_POST['query']))) {
    $query = trim($_POST['query']);
    $searchTerms = explode(' ', $query);

    $sql = "SELECT id_hospitalisation,patient.id_patient, 
    patient.nom,patient.postnom,patient.prenom,
    lib_categ,etat_patient,date_admission,date_sortie_prevue,agent.nom as nom_agent,agent.prenom as prenom_agent 
    FROM hospitalisation
    inner join patient on patient.id_patient = hospitalisation.id_patient
    inner join categorie on categorie.id_categorie = patient.id_categorie
    inner join agent on agent.id_agent = patient.id_agent
    where ";

    $params = [];
    $conditions = [];

    foreach ($searchTerms as $index => $term) {
        $conditions[] = "(patient.nom LIKE :term$index OR patient.postnom LIKE :term$index OR patient.prenom LIKE :term$index)";
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
                    <td>" . htmlspecialchars($ligne['lib_categ']) . "</td>
                    <td>" . htmlspecialchars($ligne['etat_patient']) . "</td>
                    <td>" . htmlspecialchars($ligne['date_admission']) . "</td>
                    <td>" . htmlspecialchars($ligne['date_sortie_prevue']) . "$</td>
                    <td>" . htmlspecialchars($ligne['prenom_agent'])." ".htmlspecialchars($ligne['nom_agent']). "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>Aucun résultat trouvé</td></tr>";
    }
}
?>
