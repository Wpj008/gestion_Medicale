<?php
session_start();
include 'Configuration/config.php';

// Récupération de l'Id utilisateur
$idagent = $_SESSION['id_agent'];


$erreurMessage = '';
$successMessage = '';

// Vérifie que l'ID utilisateur est valide avant de procéder
if (isset($idagent) && !empty($idagent)) {
    // Récupération des infos liées à l'Id utilisateur
    $query = $pdo->prepare("SELECT * FROM agent WHERE id_agent = :id");
    $query->bindParam(':id', $idagent);
    $query->execute();
    $results = $query->fetch();

    // Vérifie si les résultats existent avant de les utiliser
    if ($results) {
        // Si les résultats sont valides, on récupère le mot de passe
        $password = $results['mot_de_passe'];

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            // Récupération du mot de passe soumis par l'utilisateur
            $password_1 = htmlspecialchars($_POST['password_1']); // Ancien mot de passe
            $password_2 = htmlspecialchars($_POST['password_2']); // Nouveau mot de passe
            $password_3 = htmlspecialchars($_POST['password_3']); // Confirmation du nouveau mot de passe

            // Comparaison du mot de passe dans la BDD et celui saisi par l'utilisateur
            if (password_verify($password_1, $password)) {
                // Vérification de la correspondance entre le nouveau mot de passe et sa confirmation
                if ($password_3 == $password_2) {
                    // Hachage du nouveau mot de passe
                    $passwordHash = password_hash($password_3, PASSWORD_DEFAULT);

                    // Mise à jour du mot de passe dans la base de données
                    $query = $pdo->prepare("UPDATE agent SET mot_de_passe = :password WHERE id_agent = :id_user");
                    $query->bindParam(':password', $passwordHash); // Hachage du mot de passe
                    $query->bindParam(':id_user', $idagent);
                    $query->execute();

                    // Message de succès
                    $successMessage = "Votre mot de passe a été mis à jour avec succès.";
                } else {
                    $erreurMessage = "Les mots de passe ne correspondent pas.";
                }
            } else {
                $erreurMessage = "L'ancien mot de passe est incorrect.";
            }
        }
    } else {
        // Si aucun utilisateur n'est trouvé dans la base de données
        $erreurMessage = "Aucun utilisateur trouvé avec cet ID.";
    }
} else {
    $erreurMessage = "ID utilisateur invalide.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Changement de Mot de Passe</title>
<link rel="stylesheet" href="css/update_password.css">
<script src="js/password.js"></script>
</head>
<body>


<br><br><br><br><br><br><br><br>


<div class="formulaire">


<h2>CHANGEMENT DE MOT DE PASSE </h2>
<form action="" method="POST" onsubmit="return verifierMotsDePasse()">

<label for="password_1"> Ancien Mot de passe</label>
<input type="password" id="password_1" name="password_1" required><br><br>

<label for="password_2"> Nouveau Mot de passe</label>
<input type="password" id="password_2" name="password_2" required><br><br>

<p>Confirmez le mot de passe</p>
<input type="password" id="password_3" name="password_3" required><br><br>

<p id="erreurMotDePasse" style="color: red;"></p>

<p id="successMessage" style="color: green;"><?= $successMessage; ?></p>
<p id="erreurMessage" style="color: red;"><?= $erreurMessage; ?></p>

<button type="submit" name="submit">Enregistrer</button><br><br>
<div class="lien">
<a href="login.php"> Se connecter </a>
</div>
</form>
</div>

</body>
</html>
