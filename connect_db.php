<?php
try{
    $connexion = new PDO("mysql:host=localhost;dbname=minichat", "root", "");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

