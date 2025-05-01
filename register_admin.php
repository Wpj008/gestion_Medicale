<?php
session_start();
include 'Configuration/config.php';

if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) {
    header("Location: accueil.php");
    exit();
}

function hasAdminAccount($pdo) {
    $query = $pdo->prepare("SELECT COUNT(*) FROM agent WHERE id_fonction = 6");
    $query->execute();
    return $query->fetchColumn() > 0;
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $fonction = 6;

    $check = $pdo->prepare("SELECT AdresseMail FROM agent WHERE AdresseMail = ?");
    $check->execute([$email]);
    
    if ($check->rowCount() > 0) {
        $error = "Cet email est déjà utilisé !";
    } else {
        $insert = $pdo->prepare("
            INSERT INTO agent (nom, postnom, prenom, AdresseMail, telephone, sexe, password, id_fonction, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'actif')
        ");
        if ($insert->execute([$nom, $postnom, $prenom, $email, $telephone, $sexe, $password, $fonction])) {
            $success = "Compte admin créé avec succès !";
            header("Refresh: 2; url=login.php");
        } else {
            $error = "Erreur lors de la création du compte";
        }
    }
}

if (hasAdminAccount($pdo)) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EhealthRecord - Premier Admin</title>
    <style>
       
    </style>
        <link href="CSS/register_admin.css" rel="stylesheet">
</head>
<body>
    <div class="splash-container">
        <div class="logo">
            <svg viewBox="0 0 24 24" fill="white">
                <path d="M12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3zm0 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm1.65-2.65L11.5 12.2V9h1v2.79l1.85 1.85-.7.71z"/>
            </svg>
        </div>
        <h1 class="app-name">EhealthRecord</h1>
        <p style="color: rgba(255,255,255,0.8);">Initialisation du système...</p>
        <div class="loading-bar">
            <div class="progress"></div>
        </div>
    </div>

    <div class="register-container">
        <h2 class="form-title">Création du compte Admin</h2>
        
        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="input-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            
            <div class="input-group">
                <label for="postnom">Postnom</label>
                <input type="text" id="postnom" name="postnom" required>
            </div>
            
            <div class="input-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="input-group">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" required>
            </div>
            
            <div class="input-group">
                <label for="sexe">Sexe</label>
                <select id="sexe" name="sexe" required>
                    <option value="">Sélectionnez</option>
                    <option value="Masculin">Masculin</option>
                    <option value="Féminin">Féminin</option>
                </select>
            </div>
            
            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required minlength="8">
            </div>
            
            <button type="submit" name="register">Créer le compte Admin</button>
        </form>
    </div>

    <script>
        setTimeout(() => {
            document.querySelector('.splash-container').style.display = 'none';
            document.querySelector('.register-container').style.display = 'block';
        }, 3000);
    </script>
</body>
</html>