<?php
include('../Configuration/config.php');

if (isset($_POST['query']) && !empty(trim($_POST['query']))) {
    $query = trim($_POST['query']);
    $searchTerms = explode(' ', $query);

    $sql = "SELECT id_paie,patient.id_patient, nom,postnom,prenom,lib_categ,
    lib_Motifpaie,montant,lib_Modepaiement FROM paiement
    inner join patient on patient.id_patient = paiement.id_patient
    inner join categorie on categorie.id_categorie = patient.id_categorie
    inner join motifpaiement on motifpaiement.id_Motifpaie = paiement.id_Motifpaie
    inner join modepaiement on modepaiement.id_Modepaiement = paiement.id_Modepaiement
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
                    <td>" . htmlspecialchars($ligne['lib_categ']) . "</td>
                    <td>" . htmlspecialchars($ligne['lib_Motifpaie']) . "$</td>
                    <td>" . htmlspecialchars($ligne['montant']) . "</td>
                    <td class='status delivered'>" .htmlspecialchars($ligne['lib_Modepaiement']) . "</td>
                    <td><a href='#'> <i class='uil uil-edit'></i></a></td>
                    <td><a href='#' onclick='imprimerRecu(" . $ligne['id_paie'] . ")'> 
                        <i class='uil uil-print'></i>
                    </a>
                </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>Aucun résultat trouvé</td></tr>";
    }
}
?>
