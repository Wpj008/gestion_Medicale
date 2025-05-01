<!DOCTYPE html>
<html lang="en">
<?php 
      include 'Header/head.php'
    ?>
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
            <div class="preview">
                <div class="search-box">
                    <h3 class="main-title">Liste des patients hospitalisés</h3>
                </div>
                <div class="search-box2">
                    <i class="uil uil-search"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher le patient . . .">
                    <button type="submit">Rechercher</button>
                </div>
            </div>
                    <div class="orders">
                        <table>
                            <thead>
                                <tr>
                                    <th>Code patient</th>
                                    <th>Nom</th>
                                    <th>Postnom</th>
                                    <th>Prénom</th>
                                    <th>Categorie</th>
                                    <th>Etat</th>
                                    <th>Date d'admission</th>
                                    <th>Date de sortie previe</th>
                                    <th>Prescripteur d'hospitalisation</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                include('TRAITEMENT/hospitalisation.php');
                                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($ligne['id_patient']) ?></td>
                                        <td><?= htmlspecialchars($ligne['nom_patient']) ?></td>
                                        <td><?= htmlspecialchars($ligne['postnom_patient']) ?></td>
                                        <td><?= htmlspecialchars($ligne['prenom_patient']) ?></td>
                                        <td class="status delivered"><?= htmlspecialchars($ligne['lib_categ']) ?></td>
                                        <td><?= htmlspecialchars($ligne['etat_patient']) ?></td>
                                        <td><?= htmlspecialchars($ligne['date_admission']) ?></td>
                                        <td><?= htmlspecialchars($ligne['date_sortie_prevue']) ?></td>
                                        <td><?= htmlspecialchars($ligne['prenom_agent']) ?> <?= htmlspecialchars($ligne['nom_agent']) ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                            <tfoot>
                                <?php
                                include('TRAITEMENT/hospitalisation.php');
                                ?>
                                <tr>
                                    <td colspan="10">Total général : <?= $stmt2['nombre_hospitaliser'] ?> de patient hospitaliser</td>
                                </tr>
                                 <?php
                                    
                                ?>
                                
                            </tfoot>
                        </table>
                    </div>
            </div>
        </div>
        </div>
    </section>
    <script src="JS/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("searchInput").addEventListener("keyup", function () {
        let query = this.value;
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "TRAITEMENT/search_hospitalisation.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
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