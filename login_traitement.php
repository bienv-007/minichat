<?php 
session_start();
include("connect_db.php");

if(isset($_POST["username"]) && isset($_POST["password"])) {
    // 1. Nettoyage des entrées
    $nom = htmlspecialchars($_POST['username']);
    $mdp_saisi = $_POST['password'];

    // 2. Préparation de la requête pour trouver l'utilisateur par son nom
    // On cherche l'utilisateur qui correspond exactement au nom saisi
    $sql = "SELECT * FROM t_utilisateurs WHERE nom_user = :nom LIMIT 1";
    $req = $connexion->prepare($sql);
    $req->execute([':nom' => $nom]);
    
    $user = $req->fetch(PDO::FETCH_ASSOC);

    // 3. Vérification : l'utilisateur existe-t-il et le mot de passe est-il correct ?
    if ($user && password_verify($mdp_saisi, $user['mot_de_passe'])) {
        // Authentification réussie
        // On régénère l'ID de session pour plus de sécurité (anti-fixation)
        session_regenerate_id();
        
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["user_nom"] = $user['nom_user'];
        
        // Redirection vers l'accueil
        header("Location: index.php");
        exit(); 
    } else {
        // Authentification échouée : on redirige avec un message d'erreur
        header("Location: login.php?error=1");
        exit();
    }
}
?>