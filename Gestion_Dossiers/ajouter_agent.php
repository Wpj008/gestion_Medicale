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
        <h2>Paramètres</h2>
        <div class="icon_top">
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <i class="uil uil-user-circle"></i>
        </div>
    </div>

    <div class="conteneur">
        <div class="form-container">
            <form action="TRAITEMENT/ajout_agent.php" method="POST" onsubmit="return confirmerEnregistrement();" class="formulaire">
                <h2 class="form-title">Ajouter un nouvel agent</h2>
                
                <div class="colonne">
                    <div class="input-box">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" placeholder="Entrez le nom" required maxlength="50">
                    </div>
                    
                    <div class="input-box">
                        <label for="postnom">Postnom</label>
                        <input type="text" name="postnom" placeholder="Entrez le postnom" maxlength="50">
                    </div>
                </div>
                
                <div class="colonne">
                    <div class="input-box">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" placeholder="Entrez le prénom" required maxlength="50">
                    </div>
                    
                    <div class="input-box">
                        <label for="sexe">Sexe</label>
                        <select name="sexe" required>
                            <option value="">Sélectionnez le sexe</option>
                            <option value="Masculin">Masculin</option>
                            <option value="Féminin">Féminin</option>
                        </select>
                    </div>
                </div>
                
                <div class="colonne">
                    <div class="input-box">
                        <label for="telephone">Téléphone</label>
                        <input type="tel" name="telephone" placeholder="Entrez le numéro de téléphone" maxlength="20">
                    </div>
                    
                    <div class="input-box">
                        <label for="AdresseMail">Email</label>
                        <input type="email" name="AdresseMail" placeholder="Entrez l'adresse email" maxlength="100">
                    </div>
                </div>
                
                <div class="colonne">
                    <div class="input-box">
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse" placeholder="Entrez l'adresse complète" maxlength="255">
                    </div>
                </div>
                
                    
                    
                </div>
                
                <div class="colonne">
                    <div class="input-box">
                        <label for="id_fonction">Fonction</label>
                        <select name="id_fonction" required>
                            <option value="">Sélectionnez la fonction</option>
                            <?php
                                include('TRAITEMENT/fonction.php');
                                while ($fonction = $stmt_fonction->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?= htmlspecialchars($fonction['id_fonction']) ?>">
                                    <?= htmlspecialchars($fonction['lib_fonction']) ?>
                                </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="input-box">
                        <label for="id_specialite">Spécialité</label>
                        <select name="id_specialite" required>
                            <option value="">Sélectionnez la spécialité</option>
                            <?php
                                include('TRAITEMENT/specialite.php');
                                while ($specialite = $stmt_specialite->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?= htmlspecialchars($specialite['id_specialite']) ?>">
                                    <?= htmlspecialchars($specialite['lib_specialite']) ?>
                                </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Enregistrer</button>
            </form>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.js"></script>
<script src="JS/script.js"></script>
<script>
    function confirmerEnregistrement() {
        // Vérification que les mots de passe correspondent
        var password = document.querySelector('input[name="password"]').value;
        var passwordConfirm = document.querySelector('input[name="password_confirm"]').value;
        
        if (password !== passwordConfirm) {
            alert("Les mots de passe ne correspondent pas!");
            return false;
        }
        
        return confirm("Voulez-vous vraiment enregistrer ce nouvel agent ?");
    }
</script>

</body>
</html>