<?php
session_start();
include_once('../includes/db.php');

if(isset($_SESSION['gebruiker'])){
    $gebruiker = $_SESSION['gebruiker'];
    $sql = "DELETE FROM gebruiker WHERE gebruikersnaam = ?";
    $q = $conn->prepare($sql);
    $res = $q->execute(array($gebruiker));

    $_SESSION['succes'] = "succesAccountVerwijderd";
    header('location: ../../index.php');

    $conn->close();
}
else{
    header("Location: /index.php");
}
?>
