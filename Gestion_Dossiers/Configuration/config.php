<?php 
   $host = 'localhost';
   $dbname = 'gestion_dossiers';
   $user = 'root';
   $password = '';
   
   try {
       $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
   } catch (PDOException $e) {
       echo "Erreur de connexion : " . $e->getMessage();
   }
   
?>