<?php
include('../Configuration/config.php');

if (isset($_POST['query'])) {
    $search = '%' . $_POST['query'] . '%';
    
    $sql = "SELECT a.*, f.lib_fonction, s.lib_specialite 
            FROM agent a
            LEFT JOIN fonction f ON a.id_fonction = f.id_fonction
            LEFT JOIN specialite s ON a.id_specialite = s.id_specialite
            WHERE a.nom LIKE :search 
               OR a.postnom LIKE :search 
               OR a.prenom LIKE :search 
               OR a.telephone LIKE :search 
               OR a.AdresseMail LIKE :search
               OR f.lib_fonction LIKE :search
               OR s.lib_specialite LIKE :search
            ORDER BY a.nom, a.postnom, a.prenom";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':search', $search);
    $stmt->execute();
    
    while ($agent = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>
                <td>'.htmlspecialchars($agent['id_agent']).'</td>
                <td>'.htmlspecialchars($agent['nom']).'</td>
                <td>'.htmlspecialchars($agent['postnom']).'</td>
                <td>'.htmlspecialchars($agent['prenom']).'</td>
                <td>'.htmlspecialchars($agent['telephone']).'</td>
                <td>'.htmlspecialchars($agent['AdresseMail']).'</td>
                <td>'.htmlspecialchars($agent['lib_fonction']).'</td>
                <td>'.htmlspecialchars($agent['lib_specialite']).'</td>
                <td class="actions">
                    <a href="modifier_agent.php?id='.$agent['id_agent'].'" class="btn-edit" title="Modifier">
                        <i class="uil uil-edit"></i>
                    </a>
                    <a href="TRAITEMENT/supprimer_agent.php?id='.$agent['id_agent'].'" 
                       class="btn-delete" 
                       title="Supprimer"
                       onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet agent ?\');">
                        <i class="uil uil-trash-alt"></i>
                    </a>
                </td>
              </tr>';
    }
}
?>