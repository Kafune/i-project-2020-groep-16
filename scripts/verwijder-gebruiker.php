<?php
session_start();
include_once('../includes/db.php');
include_once('../includes/functies.php');

if (isset($_SESSION['gebruiker'])) {

    $gebruiker = $_SESSION['gebruiker'];
    $queryArray = array(
        ':gebruikersnaam' => $gebruiker
    );
    $sql = "DELETE FROM gebruikerstelefoon WHERE gebruikersnaam = :gebruikersnaam";
    if(voerQueryUit($conn, $sql, $queryArray)) {
        $sql = "DELETE FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam";
        if (voerQueryUit($conn, $sql, $queryArray)) {

            session_destroy();

            $_SESSION['success'] = "succesAccountVerwijderd";
            header('location: ../../index.php');
        }
    }

    $conn->close();
} else {
    header("Location: /index.php");
}
?>
