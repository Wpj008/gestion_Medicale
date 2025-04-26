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
                <h2>Médecin</h2>
                <div class="icon_top">
                    <input type="checkbox" id="switch-mode" hidden>
                    <label for="switch-mode" class="switch-mode"></label>
                    <i class="uil uil-user-circle"></i>
                </div>
                </div>

                <div class="conteneur">
                  <h3 class="main-title">La consultation</h3>
                    <div class="form-container">
                    <div class="search-box2">
                        <i class="uil uil-search"></i>
                        <input type="text" id="searchInput" onkeyup="rechercherPatient()" placeholder="Rechercher un patient">
                        <div class="searchResults" id="searchResults"></div>
                        <button type="button" onclick="rechercherPatient()">Rechercher</button>
                    </div>
                        <form action="TRAITEMENT/medecin.php" method="POST" onsubmit="return confirmerEnregistrement();" class="formulaire">
                            <h2 class="form-title">Details sur le patient</h2>
                            
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
                            </div>
                    
                            <div class="colonne">
                                <div class="input-box">
                                <label for="nom">Temperature (°C)</label>
                                    <input type="text" id="temperature" name="temperature" placeholder="Température">
                                </div>
                                <div class="input-box">
                                <label for="nom">Tension artérielle (mmHg)</label>
                                    <input type="text" id="tension_arterielle" name="tension_arterielle" placeholder="Tension artérielle">
                                </div>
                            </div>
                            <div class="colonne">
                              <div class="input-box">
                                    <label for="nom">Frequence cardiaque (bpm)</label>
                                  <input type="text" id="Frequence_cardiaque" name="Frequence_cardiaque" placeholder="Fréquence cardiaque">
                              </div>
                              <div class="input-box">
                              <label for="nom">Frequence respiratioire (/min)</label>
                                  <input type="text" id="Frequence_respiratoire" name="Frequence_respiratoire" placeholder="Fréquence respiratoire">
                              </div>
                          </div>
                          <div class="input-box">
                                <label for="">Examens système du patient</label>
                                <input type="text" id="Examens_systeme" name="Examens_systeme" placeholder="Examens systèmes">
                            </div>
                          <br>
                          <h2 class="form-title">Consultation du patient</h2>
                          <div class="colonne">
                            <div class="input-box">
                                <textarea name="Diagnose_medicale" placeholder="Diagnose médicale"></textarea>
                            </div>
                            <div class="input-box">
                                <textarea name="Traitement_medical" placeholder="Traitement médical"></textarea>
                            </div>
                        </div>
                        
                        <div class="colonne">
                            <div class="input-box">
                                <textarea name="medicament_pris" placeholder="Médicament pris"></textarea>
                            </div>
                            <div class="input-box">
                                <textarea name="motif_consultation"placeholder="Motif de la consultation"></textarea>
                            </div>
                        </div>
                        
                        <div class="colonne">
                            <div class="input-box">
                                <textarea name="symptome_actuel" placeholder="Symptôme actuel"></textarea>
                            </div>
                            <div class="input-box">
                                <textarea name="atecedant_medicaux" placeholder="Antécédents médicaux"></textarea>
                            </div>
                        </div>
                        
                        <div class="colonne">
                            <div class="input-box">
                                <textarea name="atecedant_chirurgicaux" placeholder="Antécédents chirurgicaux"></textarea>
                            </div>
                            <div class="input-box">
                                <textarea name="atecedant_familiaux" placeholder="Antécédents familiaux"></textarea>
                            </div>
                        </div>
                            <button type="submit" class="btn-submit">Envoyer</button>
                            <input type="hidden" id="prelevement-id" name="prelevement_id">
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
            xhr.open('GET', 'recherche_medecin.php?query=' + encodeURIComponent(query), true);
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
                    const pre_Id = clickedItem.getAttribute('data-id');
                    const nom = clickedItem.getAttribute('data-nom');
                    const postnom = clickedItem.getAttribute('data-postnom');
                    const prenom = clickedItem.getAttribute('data-prenom');
                    const categorie = clickedItem.getAttribute('data-categorie');
                    const temperature = clickedItem.getAttribute('data-temperature');
                    const tension_arterielle = clickedItem.getAttribute('data-tension_arterielle');
                    const Frequence_cardiaque = clickedItem.getAttribute('data-Frequence_cardiaque');
                    const Frequence_respiratoire = clickedItem.getAttribute('data-Frequence_respiratoire');
                    const Examens_systeme = clickedItem.getAttribute('data-Examens_systeme');

                    document.getElementById('nom').value = nom;
                    document.getElementById('postnom').value = postnom;
                    document.getElementById('prenom').value = prenom;
                    document.getElementById('categorie').value = categorie;
                    document.getElementById('prelevement-id').value = pre_Id;
                    document.getElementById('temperature').value = temperature;
                    document.getElementById('tension_arterielle').value = tension_arterielle;
                    document.getElementById('Frequence_cardiaque').value = Frequence_cardiaque;
                    document.getElementById('Frequence_respiratoire').value = Frequence_respiratoire;
                    document.getElementById('Examens_systeme').value = Examens_systeme;

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
