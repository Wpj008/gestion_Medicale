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
        <h2>Laborantin</h2>
        <div class="icon_top">
          <input type="checkbox" id="switch-mode" hidden>
          <label for="switch-mode" class="switch-mode"></label>
          <i class="uil uil-user-circle"></i>
        </div>
      </div>

                <div class="conteneur">
                  <h3 class="main-title">Resultat d'Analyse</h3>
                    <div class="form-container">
                            <div class="search-box2">
                                <i class="uil uil-search"></i>
                                <input type="text" id="searchInput" onkeyup="rechercherPatient()" placeholder="Rechercher un patient">
                                <div class="searchResults" id="searchResults"></div>
                                <button type="button" onclick="rechercherPatient()">Rechercher</button>
                            </div>
                            <form action="TRAITEMENT/ResultatAnalyse.php" method="POST" onsubmit="return confirmerEnregistrement();" class="formulaire">
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
                            
                                <h2 class="form-title">Résultat des examens</h2>
                            
                                <div class="colonne">
                                    <div class="input-box">
                                    <textarea name="resultat_analyse_sang" rows="5" placeholder="Résultats d'analyses de sang"></textarea>
                                    </div>
                                </div>
                            
                                <div class="colonne">
                                    <div class="input-box">
                                        <textarea rows="5" name="resultat_examen_imagerie" placeholder="Résultats d'examens d'imagerie"></textarea>
                                    </div>
                                </div>
                            
                                <div class="colonne">
                                    <div class="input-box">
                                        <textarea rows="5" name="resultat_autre_examens" placeholder="Résultats d'autres examens"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn-submit">Envoyer</button>
                                <input type="hidden" id="id_examen" name="id_examen">
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
            xhr.open('GET', 'recherche_resultatAnalyse.php?query=' + encodeURIComponent(query), true);
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
                    const id_examen = clickedItem.getAttribute('data-id');
                    const nom = clickedItem.getAttribute('data-nom');
                    const postnom = clickedItem.getAttribute('data-postnom');
                    const prenom = clickedItem.getAttribute('data-prenom');
                    const categorie = clickedItem.getAttribute('data-categorie');

                    document.getElementById('nom').value = nom;
                    document.getElementById('postnom').value = postnom;
                    document.getElementById('prenom').value = prenom;
                    document.getElementById('categorie').value = categorie;
                    document.getElementById('id_examen').value = id_examen;

                    searchResultsContainer.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
