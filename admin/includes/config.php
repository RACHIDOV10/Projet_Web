<?php
date_default_timezone_set('Asia/Gaza');
// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "onhsdb");

// Vérifie la connexion
if (mysqli_connect_errno()) {
    echo "Connection Fail: " . mysqli_connect_error();
}
?>

