<!DOCTYPE html>
<html lang="fr">
<?php 
      include 'Header/head.php'
?>
<body>
<?php 
      include 'Header/header.php'
?>
<section class="dashboard">
    <div class="top">
        <h2>Paramètre</h2>
        <div class="icon_top">
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <i class="uil uil-user-circle"></i>
        </div>
    </div>

    <div class="conteneur">
        <div class="form-container">
            <form action="TRAITEMENT/utilisateur.php" method="POST" onsubmit="return confirmerEnregistrement();" class="formulaire">
                <h2 class="form-title">Créer un login</h2>
                <div class="colonne">
                    <div class="input-box">
                        <label for="">Nom utilisateur</label>
                        <input type="text" name="utilisateur" placeholder="Entrez le nom d'utilisateur" required>
                    </div>
                </div>
                <div class="colonne">
                    <div class="input-box">
                        <label for="">Mot de passe</label>
                        <input type="password" name="motdepasse" placeholder="Entrez le mot de passe" required>
                    </div>
                </div>
                <div class="colonne">
                    <div class="input-box">
                        <label for="">Confirmer le mot de passe </label>
                        <input type="password" name="mdtconf" placeholder="Entrez le mot de passe à nouveau" required>
                    </div>
                </div>

                <div class="colonne">
                    <div class="input-box">
                        <label for="">Agent destiner</label>
                        <select name="id_agent" required>
                            <option value="">Agent</option>   
                            <?php
                                include('TRAITEMENT/agent.php');
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?= htmlspecialchars($ligne['id_agent']) ?>">
                                    <?= htmlspecialchars($ligne['prenom']) ?>  <?= htmlspecialchars($ligne['nom']) ?>  <?= htmlspecialchars($ligne['postnom']) ?>
                                </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Envoyer</button>
            </form>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.js"></script>
<script src="JS/script.js"></script>
<script>
    function confirmerEnregistrement() {
        return confirm("Voulez-vous réellement enregistrer ces informations ?");
    }

    function rechercherPatient() {
        var query = document.getElementById('searchInput').value;

        if (query.length === 0) {
            document.getElementById('searchResults').style.display = 'none';
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'recherche.php?query=' + encodeURIComponent(query), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var resultsDiv = document.getElementById('searchResults');
                resultsDiv.innerHTML = xhr.responseText;
                resultsDiv.style.display = xhr.responseText.trim() ? 'block' : 'none';
            }
        };
        xhr.send();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchResultsContainer = document.querySelector('.searchResults');

        searchResultsContainer.addEventListener('click', function(event) {
            const clickedItem = event.target.closest('.result-item');

            if (clickedItem) {
                const patientId = clickedItem.getAttribute('data-id');
                const nom = clickedItem.getAttribute('data-nom');
                const postnom = clickedItem.getAttribute('data-postnom');
                const prenom = clickedItem.getAttribute('data-prenom');

                document.getElementById('nom').value = nom;
                document.getElementById('postnom').value = postnom;
                document.getElementById('prenom').value = prenom;
                document.getElementById('patient-id').value = patientId;

                searchResultsContainer.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
