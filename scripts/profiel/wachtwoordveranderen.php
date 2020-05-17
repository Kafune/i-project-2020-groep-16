<?php
session_start();
require_once('../../includes/root.php');
require_once('../../includes/db.php');
include_once('../../includes/functies.php');

$queryArray = array(
    ':email' => $_SESSION['email'],
    ':vraag' => $_SESSION['geheimevraagnr'],
    ':antwoord' => $_SESSION['geheimeantwoord']
);

$_SESSION['wachtwoord'] = $_POST['wachtwoord'];
$_SESSION['wachtwoordbevestigen'] = $_POST['wachtwoordbevestigen'];


if (isset($_POST['wachtwoord-vergeten-veranderen'])) {
    if (checkGegevens($_SESSION['wachtwoord'], $_SESSION['wachtwoordbevestigen'])) {
        if (checkWachtwoord($_SESSION['wachtwoord'])) {
            $queryArray = array(
                ':wachtwoord' => $_SESSION['wachtwoord'],
                ':email' => $_SESSION['email']
            );

            $hashedWachtwoord = geefWachtwoordHash($_SESSION['wachtwoord']);
            $sql = "UPDATE Gebruiker SET wachtwoord = :wachtwoord WHERE email = :email";
            voerQueryUit($conn, $sql, $queryArray);
            session_destroy();
            header('location: /login.php');

        } else {
            header('location: /profiel/wachtwoordveranderen.php');

        }

    } else {

        header('location: /profiel/wachtwoordveranderen.php');
    }
}


