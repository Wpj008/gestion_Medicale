<?php
session_start();
if(isset($_SESSION['is_logged_in'])&&$_SESSION['is_logged_in']==true){
    header("Location: /accueil.php");
    exit();
}else{
    header("Location: /login.php");
    exit();
}

?>