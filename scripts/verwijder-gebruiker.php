<?php
session_start();
include_once('../includes/db.php');
include_once('../includes/functies.php');

/* Checkt of de gebruiker is ingelogd. */
if (isset($_SESSION['gebruiker'])) {

    $gebruiker = $_SESSION['gebruiker'];
    $queryArray = array(
        ':gebruikersnaam' => $gebruiker
    );

    /* Verwijdert de gebruiker uit de database. */
    $sql = "DELETE FROM gebruikerstelefoon WHERE gebruikersnaam = :gebruikersnaam";
    if(voerQueryUit($conn, $sql, $queryArray)) {
        $sql = "DELETE FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam";
        if (voerQueryUit($conn, $sql, $queryArray)) {

            /* Stopt de sessie en stuurt de gebruiker terug met een melding. */
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
