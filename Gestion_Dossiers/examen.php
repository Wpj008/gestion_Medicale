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
        <h2>Médecin</h2>
        <div class="icon_top">
          <input type="checkbox" id="switch-mode" hidden>
          <label for="switch-mode" class="switch-mode"></label>
          <i class="uil uil-user-circle"></i>
        </div>
      </div>

                <div class="conteneur">
                  <h3 class="main-title">La demande d'éxamens</h3>
                    <div class="form-container">
                    <div class="search-box2">
                        <i class="uil uil-search"></i>
                        <input type="text" id="searchInput" onkeyup="rechercherPatient()" placeholder="Rechercher un patient">
                        <div class="searchResults" id="searchResults"></div>
                        <button type="button" onclick="rechercherPatient()">Rechercher</button>
                    </div>
                        <form action="TRAITEMENT/demande_exam.php" method="POST" onsubmit="return confirmerEnregistrement();" class="formulaire">
                            <h2 class="form-title">Details sur la consultation</h2>
                            
                            <div class="colonne">
                                
                                <div class="input-box">
                                <label for="nom">Nom patient</label>
                                    <input type="text" id="nom" name="nom" placeholder="Resultat du  nom patient" required>
                                </div>
                                <div class="input-box">
                                <label for="nom">Postnom patient</label>
                                    <input type="text" id="postnom" name="postnom" placeholder="Resultat du  postnom patient" required>
                                </div>
                            </div>

                            <div class="colonne">
                                <div class="input-box">
                                <label for="nom">Prenom patient</label>
                                    <input type="text" id="prenom" name="prenom" placeholder="Resultat du  prénom patient" required>
                                </div>
                                <div class="input-box">
                                <label for="nom">categorie patient</label>
                                    <input type="text" id="categorie" name="categorie" placeholder="Resultat de la catégorie patient" required>
                                </div>
                            </div><br>
              
                          <h2 class="form-title">Examens du patient</h2>
                          <div class="colonne">
                            <div class="input-box">
                              <select name="typeexam">
                                <option value="">Type de l'examen</option>
                            <?php
                                include('TRAITEMENT/typeexam.php');
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?= htmlspecialchars($ligne['id_TypExamen']) ?>">
                                    <?= htmlspecialchars($ligne['lib_TypExamen']) ?>
                                </option>
                            <?php
                                }
                            ?>
                            </select>
                            </div>
                            <div class="input-box">
                           
                              <select name="motifExamen" id="">
                                <option value="">Motif de l'examen</option>
                              <?php
                                include('TRAITEMENT/motifexam.php');
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?= htmlspecialchars($ligne['id_MotifExamen']) ?>">
                                    <?= htmlspecialchars($ligne['lib_MotifExamen']) ?>
                                </option>
                            <?php
                                }
                            ?>
                              </select>
                          </div>
                        </div>
                        <div class="input-box">
                          
                            <select name="urgenceExamen" id="">
                              <option value="">Urgence de l’examen</option>
                              <option value="Urgent">Urgent</option>
                              <option value="Normal">Normal</option>
                              <option value="Surveillance">Surveillance</option>
                            </select>
                        </div>
                        <div class="colonne">
                          <div class="input-box">
                              <input type="text" name="parti_concerner" placeholder="Parties du corps concernées">
                          </div>
                      </div>
                      <div class="colonne">
                        <div class="input-box">
                            <input type="text" name="antecedant_medicaux" placeholder="Antécédents médicaux liés à la demande">
                        </div>
                      </div>
                      <div class="colonne">
                        <div class="input-box">
                            <input type="text" name="traitement_encours" placeholder="Traitements en cours">
                        </div>
                    </div>
                        
                            <button type="submit" class="btn-submit">Envoyer</button>
                            <input type="hidden" id="id_consultation" name="id_consultation">
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
            xhr.open('GET', 'recherche_med_consultation.php?query=' + encodeURIComponent(query), true);
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
                    const consultation_id = clickedItem.getAttribute('data-id');
                    const nom = clickedItem.getAttribute('data-nom');
                    const postnom = clickedItem.getAttribute('data-postnom');
                    const prenom = clickedItem.getAttribute('data-prenom');
                    const categorie = clickedItem.getAttribute('data-categorie');
                    document.getElementById('nom').value = nom;
                    document.getElementById('postnom').value = postnom;
                    document.getElementById('prenom').value = prenom;
                    document.getElementById('categorie').value = categorie;
                    document.getElementById('id_consultation').value = consultation_id;
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
