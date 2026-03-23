<?php
session_start();
include("connect_db.php");
if(!isset($_SESSION["user_id"]) && !isset($_SESSION['user_nom'])) {
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_nom']); ?> !</h1>
    <p>Ceci est votre page d'accueil.</p>
    <a href="deconnexion.php">Se déconnecter</a>
</body>
</html>