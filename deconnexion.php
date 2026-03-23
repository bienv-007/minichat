<?php
session_start();
session_destroy();
// echo "deconnecte avec succes";

header('location:login.php')
?>