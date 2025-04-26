<?php // Vérifier si l'utilisateur est connecté
 session_start();
 
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header('Location: login.php');  // Rediriger vers la page de connexion
    exit;  // Arrêter l'exécution des scripts suivants
    
}
    
    ?>



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
          <h2>Dashboard</h2>
     
          <div class="icon_top">
            <input type="checkbox" id="switch-mode" hidden>
			      <label for="switch-mode" class="switch-mode"></label>
            <i class="uil uil-bell"></i>
            <span class="num">8</span>
           <a href="/gestion_dossiers/profil.php">
           <i class="uil uil-user-circle"></i>
           </a>
          </div>
        </div>
        <div class="conteneur">
            <div class="main-content">
                <div class="sales-container">
                    <div class="sales-box" onclick="window.location.href='liste_des_examens_demander.php'" style="cursor: pointer;">
                        <div class="icon"><i class="uil uil-user-md"></i></div>
                        <h3>Examen demander</h3>
                        <p class="time">Dernières 24 heures</p>
                    </div>

                    
                      <div class="sales-box" onclick="window.location.href='consultation.php'" style="cursor: pointer;">
                        <div class="icon"><i class="uil uil-medkit"></i></div>
                        <h3>Patients enregistrer</h3>
                        <p class="time">Dernières 24 heures</p>
          
                      </div>
                    
                      <div class="sales-box" onclick="window.location.href='paiementEnregistrer.php'" style="cursor: pointer;">
                        <div class="icon"><i class="uil uil-bill"></i></div>
                        <h3>Liste paiement</h3>
                        <p class="time">Dernières 24 heures</p>
      
                      </div>
                    
                      <div class="sales-box" onclick="window.location.href='hospitalisation.php'" style="cursor: pointer;">
                        <div class="icon"><i class="uil uil-bed"></i></div>
                        <h3>Hospitalisation</h3>
                        <p class="time">Dernières 24 heures</p>
                      </div>
                </div>
            
              </div>
                <div class="dashboard-section">
                    <div class="orders">
                        <h3>Les paiements récents</h3>
                        <table>
                            <thead>
                                <tr>
                                  <th>Code patient</th>
                                    <th>Nom patient</th>
                                    <th>Postnom patient</th>
                                    <th>Prenom patient</th>
                                    <th>Montant</th>
                                    <th>Mode paiement</th>
                                    <th>Motif</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                include('TRAITEMENT/viewhistorique.php');
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($ligne['id_patient']) ?></td>
                                        <td><?= htmlspecialchars($ligne['nom']) ?></td>
                                        <td><?= htmlspecialchars($ligne['postnom']) ?></td>
                                        <td><?= htmlspecialchars($ligne['prenom']) ?></td>
                                        <td><?= htmlspecialchars($ligne['montant']) ?>$</td>
                                        <td class="status delivered"><?= htmlspecialchars($ligne['lib_Modepaiement']) ?></td>  
                                        <td><?= htmlspecialchars($ligne['lib_Motifpaie']) ?></td>
                                    </tr>
                                <?php
                                }
                                ?>                              
                            </tbody>
                        </table>
                        <button class="view-all" onclick="window.location.href='paiementEnregistrer.php'" style="cursor: pointer;"><i class="uil uil-eye"></i></button>
                    </div>
                </div>
              
        </div>
     </section>   
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.js"></script>
    <script src="JS/script.js"></script>
    <script>
        // Fonction pour ouvrir le modal
        function openModal() {
            document.getElementById("paiementModal").style.display = "flex";
        }

        // Fonction pour fermer le modal
        function closeModal() {
            document.getElementById("paiementModal").style.display = "none";
        }

        // Fermer le modal si on clique à l'extérieur
        window.onclick = function(event) {
            let modal = document.getElementById("paiementModal");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
