<?php
include("connect_db.php");

if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = htmlspecialchars($_POST['email']);
    $date_de_naissance = $_POST['date_de_naissance'];
    $genre = $_POST['genre'];
    $nationalite = htmlspecialchars($_POST['nationalite']);
    $telephone = htmlspecialchars($_POST['telephone']);

    $Sql = "INSERT INTO t_utilisateurs (nom_user, mot_de_passe, email, date_de_naissance, genre, nationalite, telephone) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $req = $connexion->prepare($Sql);
    $req->execute([$username, $password, $email, $date_de_naissance, $genre, $nationalite, $telephone]);

    header("location:login.php");
}
?>