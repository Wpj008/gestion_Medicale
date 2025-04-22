<?php 
include 'Configuration/config.php';


$errormessage = "";


if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {

    
    $email = $_POST['username'];
    
    $password = htmlspecialchars($_POST['password']);
    
    
    //recupère tous les infos users

    $query = $pdo->prepare("SELECT * FROM agent WHERE  AdresseMail = :AdresseMail" );
       
    $query->bindParam(':AdresseMail', $email);
    $query->execute();
     
    
    $results = $query->fetch(); 

 
    //verifie si le mdp saisi === mdp  dans la bdd

    if($results){

        session_start();
        $_SESSION['id_agent'] = $results['id_agent'];
        $_SESSION['nom'] = $results['nom'];
        $_SESSION['postnom'] = $results['postnom'];
        $_SESSION['prenom'] = $results['prenom'];
        $_SESSION['AdresseMail'] = $results['AdresseMail'];
        $_SESSION['id_specialite'] = $results['id_specialite'];
        $_SESSION['id_fonction'] = $results['id_fonction'];
        
        //pour verifier dans les autres pages qu'on est connecté
        $_SESSION['is_logged_in'] = true;

        header('Location: accueil.php');

        exit();

    
   
}

    else{
        $errormessage = "Impossible de vous connecter";
    }


}


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EhealthRecord</title>
    <link rel="stylesheet" href="CSS/index.css">
</head>
<body>
    <div class="login-container">
        <h1>EhealthRecord</h1>
        <h2>Connexion</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="username">Email:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <p id="errormessage" style="color: red;"><?= $errormessage; ?></p>
            
            <button type="submit" name="submit">Connexion</button>
           
        </form>
    </div>
</body>
</html>
