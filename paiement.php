<!DOCTYPE html>
<html lang="fr">

<?php include 'Header/head.php'; ?>

<style>
    .searchResults {
        top: 130px;
        position: absolute;
        background-color: white;
        border: 1px solid #ddd;
        width: 540px;
        max-height: 100%;
        overflow-y: auto;
        display: none;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        font-size: 13px;
        font-weight: 700;
        text-align: left;
    }

    .searchResults div {
        padding: 8px;
        cursor: pointer;
    }

    .searchResults div:hover {
        background-color: #f0f0f0;
    }
</style>

<body>
    <?php include 'Header/header.php'; ?>

    <section class="dashboard">
        <div class="top">
            <h2>Caisse</h2>
            <div class="icon_top">
                <input type="checkbox" id="switch-mode" hidden>
                <label for="switch-mode" class="switch-mode"></label>
                <i class="uil uil-user-circle"></i>
            </div>
        </div>

        <div class="conteneur">
            <h3 class="main-title">Enregistrement de paiement</h3>
            <div class="form-container">
                <div class="search-box2">
                    <i class="uil uil-search"></i>
                    <input type="text" id="searchInput" onkeyup="rechercherPatient()" placeholder="Rechercher un patient">
                    <div class="searchResults" id="searchResults"></div>
                    <button type="button" onclick="rechercherPatient()">Rechercher</button>
                </div>

                <form action="TRAITEMENT/paiement.php" method="POST" onsubmit="return confirmerEnregistrement();" class="formulaire">
                    <h2 class="form-title">Détails sur le patient</h2>
                    <div class="colonne">
                        <div class="input-box">
                            <input type="text" id="nom" name="nom" placeholder="Resultat du  nom patient" required>
                        </div>
                        <div class="input-box">
                            <input type="text" id="postnom" name="postnom" placeholder="Resultat du  postnom patient" required>
                        </div>
                    </div>

                    <div class="colonne">
                        <div class="input-box">
                            <input type="text" id="prenom" name="prenom" placeholder="Resultat du  prénom patient" required>
                        </div>
                        <div class="input-box">
                            <input type="text" id="categorie" name="categorie" placeholder="Resultat de la catégorie patient" required>
                        </div>
                    </div><br>

                    <h2 class="form-title">Détails sur le paiement</h2>
                    <div class="colonne">
                        <div class="input-box">
                            <select name="lib_motifPaie" id="lib_motifPaie">
                                <option value="">Motif de paiement</option>
                                <?php
                                include('TRAITEMENT/motifPaiement.php');
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= htmlspecialchars($ligne['id_Motifpaie']) ?>" data-montant="<?= htmlspecialchars($ligne['montant']) ?>">
                                        <?= htmlspecialchars($ligne['lib_Motifpaie']) ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-box">
                            <input type="number" name="montant" id="montant" placeholder="Montant à payer">
                        </div>
                    </div>

                    <div class="colonne">
                        <div class="input-box">
                            <select name="modepaie" id="modepaie">
                                <option value="">Modalité de paiement</option>
                                <?php
                                include('TRAITEMENT/modalitePaiement.php');
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= htmlspecialchars($ligne['id_Modepaiement']) ?>">
                                        <?= htmlspecialchars($ligne['lib_Modepaiement']) ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-box">
                            <input type="text" name="transaction" placeholder="Numéro de transaction">
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Effectuer le paiement</button>
                    <input type="hidden" id="patient-id" name="patient_id">
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
                    const categorie = clickedItem.getAttribute('data-categorie');

                    document.getElementById('nom').value = nom;
                    document.getElementById('postnom').value = postnom;
                    document.getElementById('prenom').value = prenom;
                    document.getElementById('categorie').value = categorie;
                    document.getElementById('patient-id').value = patientId;

                    searchResultsContainer.style.display = 'none';
                }
            });
        });

        document.getElementById('lib_motifPaie').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const montant = selectedOption.getAttribute('data-montant');

            if (montant) {
                document.getElementById('montant').value = montant;
            } else {
                document.getElementById('montant').value = '';
            }
        });
    </script>
</body>

</html>
