<!DOCTYPE html>
<html lang="fr">
<?php 
      include 'Header/head.php'
    ?>
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
        font-size: 15px;
        font-weight: 600;
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
<?php 
      include 'Header/header.php'
    ?>

    <section class="dashboard">
      <div class="top">
        <h2>infirmier</h2>
        <div class="icon_top">
          <input type="checkbox" id="switch-mode" hidden>
          <label for="switch-mode" class="switch-mode"></label>
          <i class="uil uil-user-circle"></i>
        </div>
      </div>

                <div class="conteneur">
                  <h2 class="main-title">Hospitaliser un patient</h2>
                  <div class="form-container">
                    <div class="search-box2">
                        <i class="uil uil-search"></i>
                        <input type="text" id="searchInput" onkeyup="rechercherPatient()" placeholder="Rechercher un patient">
                        <div class="searchResults" id="searchResults"></div>
                        <button type="button" onclick="rechercherPatient()">Rechercher</button>
                    </div>

                    <form action="TRAITEMENT/hospitaliser.php" method="POST" onsubmit="return confirmerEnregistrement();" class="formulaire">
                        <h2 class="form-title">Détails sur le patient</h2>
                        <div class="colonne">
                            <div class="input-box">
                                <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required>
                            </div>
                            <div class="input-box">
                                <input type="text" id="postnom" name="postnom" placeholder="Entrez votre postnom" required>
                            </div>
                        </div>

                        <div class="colonne">
                            <div class="input-box">
                                <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
                            </div>
                            <div class="input-box">
                                <input type="text" id="categorie" name="categorie" placeholder="Entrez la catégorie" required>
                            </div>
                        </div><br>

                            <h2 class="form-title">Information sur  l'hospitalisation</h2>
                    
                            <div class="colonne">
                                <div class="input-box">
                                    <label for="">Etat du patient</label>
                                  <input type="text" name="etat_patient" placeholder="Entrer l'état du patient">
                                </div>
                                <div class="input-box">
                                   <label for="">Date d'admission du patient</label>
                                  <input type="date" name="date_admission">
                                </div>
                            </div>
                            <div class="input-box">
                                <label for="date_sortie"> Date sortie du patient</label>
                                  <input type="date" name="date_sortie">
                            </div>
                    
                            <button type="submit" class="btn-submit">Envoyer</button>
                            <input type="hidden" id="patient-id" name="patient_id">
                        </form>
                    </div>
                    
                </div>
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
    </script>
</body>
</html>
