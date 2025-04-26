<?php 
include 'Configuration/config.php';

$errormessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = $_POST['username'];
         $password = $_POST['password'];
    
             $query = $pdo->prepare("SELECT * FROM agent WHERE AdresseMail = :AdresseMail");
            $query->bindParam(':AdresseMail', $email);
         $query->execute();
    
        $results = $query->fetch(); 

         //Vérification du mot de passe
        if (password_verify($password, $results['mot_de_passe'])) {

            if($password == '12345678'){

                session_start();

                $query = $pdo->prepare("SELECT * FROM agent WHERE AdresseMail = :AdresseMail");
                    $query->bindParam(':AdresseMail', $email);
                         $query->execute();
                             $results = $query->fetch();

                    $_SESSION['id_agent'] = $results['id_agent'];

                header('Location: update_password.php');
                     exit();
                     }
            else{
            session_start();
            $_SESSION['id_agent'] = $results['id_agent'];
                 $_SESSION['nom'] = $results['nom'];
                    $_SESSION['postnom'] = $results['postnom'];
                         $_SESSION['prenom'] = $results['prenom'];
                      $_SESSION['AdresseMail'] = $results['AdresseMail'];
                   $_SESSION['id_specialite'] = $results['id_specialite'];
                 $_SESSION['id_fonction'] = $results['id_fonction'];
            $_SESSION['is_logged_in'] = true;

            header('Location: accueil.php');
            exit();
          } 
    }   else {
            $errormessage = "Mot de passe incorrect";
        }
    } else {
        $errormessage = "Aucun compte trouvé avec cet email";
   // }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/login.css" rel="stylesheet">
    <title>Connexion - EhealthRecord</title>
</head>
<body>
    <div class="login-container">
        <h1>EhealthRecord</h1>
        <h2>Connexion</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="username">Email:</label>
                <input type="email" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <p id="errormessage"><?= $errormessage; ?></p>
            
            <button type="submit" name="submit">Connexion</button>
        </form>
    </div>
</body>
</html>