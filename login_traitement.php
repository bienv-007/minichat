<?php 
session_start();
include("connect_db.php");
if(isset($_POST["nom"]) && isset($_POST["mdp"])) {
    $nom = htmlspecialchars($_POST['nom']);
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    $Sql = "SELECT * FROM utilisateurs ORDER BY id DESC LIMIT 1";
    $req = $connexion->prepare($Sql);
    $req->execute();

    while($admin = $req->fetch(PDO::FETCH_ASSOC)) {
       $nom_utilisateur = $admin['nom_user'];
        $mdpasse = $admin['mot_de_passe'];
    }
    if($nom_utilisateur==$nom && $mdpasse==$mdp) {
        // Authentification réussie
        $_SESSION["user"] = $nom_utilisateur;
        $_SESSION["mot_de_passe"] = $mdpasse;
        header("location:dashboard.php");
    } else {
    // Authentification échouée
    header("location:index.php");
}}