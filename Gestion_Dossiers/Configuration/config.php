<?php 
   $host = 'localhost';
   $dbname = 'gestion_dossiers';
   $user = 'hosto';
   $password = 'wynnrckr';
   
   try {
       $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
   } catch (PDOException $e) {
       echo "Erreur de connexion : " . $e->getMessage();
   }
   
?>