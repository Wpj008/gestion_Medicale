<!DOCTYPE html>
<html lang="fr">
<?php 
    include 'Header/head.php';
?>
<body>
<?php 
    include 'Header/header.php';
?>
<style>
    .btn-add {
    position: relative;
    background-color: #2196F3;
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-add:hover {
    background-color: #0b7dda;
}
  .status-cell {
  text-align: center;
}

.status-cell a {
  text-decoration: none;
  display: inline-block;
  padding: 5px;
}

.status-cell i {
  transition: transform 0.2s;
}

.status-cell a:hover i {
  transform: scale(1.2);
}
</style>
<section class="dashboard">
    <div class="top">
        <h2>Gestion des Agents</h2>
        <div class="icon_top">
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <i class="uil uil-user-circle"></i>
        </div>
    </div>
    
    <div class="conteneur">
        <div class="preview">
            <div class="search-box">
                <h3 class="main-title">Liste des agents enregistrés</h3>
                <a href="ajouter_agent.php" class="btn-add">
                    <!-- <i class="uil uil-plus-circle"></i>  -->
                    Ajouter un agent
                </a>
            </div>
            <div class="search-box2">
                <i class="uil uil-search"></i>
                <input type="text" id="searchAgentInput" placeholder="Rechercher un agent...">
                <button type="submit">Rechercher</button>
            </div>
        </div>
        
        <div class="orders">
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Postnom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Fonction</th>
                        <th>Spécialité</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include('TRAITEMENT/liste_agents.php');
                while ($agent = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($agent['id_agent']) ?></td>
                        <td><?= htmlspecialchars($agent['nom']) ?></td>
                        <td><?= htmlspecialchars($agent['postnom']) ?></td>
                        <td><?= htmlspecialchars($agent['prenom']) ?></td>
                        <td><?= htmlspecialchars($agent['telephone']) ?></td>
                        <td><?= htmlspecialchars($agent['AdresseMail']) ?></td>
                        <td><?= htmlspecialchars($agent['lib_fonction']) ?></td>
                        <td><?= htmlspecialchars($agent['lib_specialite']) ?></td>
                        <td><?= htmlspecialchars($agent['status']) ?></td>
                        <td class="status-cell">
                            <a href="TRAITEMENT/toggle_status.php?id=<?= $agent['id_agent'] ?>"
                                onclick="return confirmStatusChange('<?= $agent['status'] ?>', '<?= $agent['prenom'] ?> <?= $agent['nom'] ?>')"
                                title="<?= $agent['status'] === 'actif' ? 'Désactiver' : 'Activer' ?>">
                                <?php if ($agent['status'] === 'actif'): ?>
                                <i class="uil uil-check-circle" style="color: green; font-size: 22px;"></i>
                                <?php else: ?>
                                <i class="uil uil-times-circle" style="color: red; font-size: 22px;"></i>
                                <?php endif; ?>
                            </a>
                            </td>

                            <script>
                            function confirmStatusChange(currentStatus, agentName) {
                                const action = currentStatus === 'actif' ? 'désactiver' : 'activer';
                                return confirm(`Voulez-vous vraiment ${action} l'agent ${agentName} ?`);
                            }
                            </script>
                    </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">
                            <?php
                            $totalAgents = $pdo->query("SELECT COUNT(*) as total FROM agent")->fetch();
                            ?>
                            Total général : <?= $totalAgents['total'] ?> agent(s) enregistré(s)
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>
<!-- <?php
if (isset($_SESSION['error_message'])) {
    echo $_SESSION['error_message'];
}
?> -->
<script src="JS/script.js"></script>
<script>
    // Script de recherche dynamique
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("searchAgentInput").addEventListener("keyup", function() {
            let query = this.value;
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "TRAITEMENT/searchAgents.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.querySelector(".orders tbody").innerHTML = xhr.responseText;
                }
            };

            xhr.send("query=" + encodeURIComponent(query));
        });
    });
</script>

</body>
</html>