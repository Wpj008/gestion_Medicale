<?php
include('../Configuration/config.php');

if (isset($_POST['query']) && !empty(trim($_POST['query']))) {
    $query = trim($_POST['query']);
    $searchTerms = explode(' ', $query);

    $sql = "SELECT id_patient, nom, postnom, prenom, sexe FROM patient
    where ";

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
                    <td>" . htmlspecialchars($ligne['sexe']) . "</td>
                    <td><a href='#'><i class='uil uil-trash'></i></a></td>
                    <td><a href='#'><i class='uil uil-edit'></i></a></td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>Aucun résultat trouvé</td></tr>";
    }
}
?>
