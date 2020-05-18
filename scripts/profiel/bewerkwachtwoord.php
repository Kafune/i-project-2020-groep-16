<?php
session_start();
require_once('../../includes/root.php');
include_once('../../includes/db.php');
include_once('../../includes/functies.php');

if (isset($_SESSION['gebruiker'])) {
    $gebruikersnaam = $_SESSION['gebruiker'];
    $sql = "SELECT gebruikersnaam, wachtwoord FROM Gebruiker WHERE gebruikersnaam = :gebruikersnaam";
    $queryArray = array(
        ':gebruikersnaam' => $gebruikersnaam
    );
    $resultaat = haalGegevensArray($conn, $sql, $queryArray);
    if (!empty($resultaat)) {

        if (checkGegevens($gebruikersnaam, $resultaat['gebruikersnaam'])) {

            //check of gebruiker op de knop bewerkwachtwoord heeft geklikt
            if (isset($_POST['bewerkwachtwoord'])) {
                $oudwachtwoord = geefWachtwoordHash($_POST['oudwachtwoord']);
                $nieuwwachtwoord = geefWachtwoordHash($_POST['nieuwwachtwoord']);

                //check of oud wachtwoord klopt
                if (checkGegevens($oudwachtwoord, $resultaat['wachtwoord'])) {
                    //check eerst of wachtwoord aan basiseisen voldoet
                    if (checkWachtwoord($_POST['nieuwwachtwoord'])) {

                        //verander oud wchtwoord naar nieuw wachtwoord
                        $sql = "UPDATE Gebruiker 
                        SET wachtwoord = :nieuwwachtwoord";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':nieuwwachtwoord', $nieuwwachtwoord);
                        $stmt->execute();

                        header('location: /profiel/gebruikersprofiel.php');
                    } else {
                        header('location: /profiel/profielwachtwoord.php');
                    }
                } else {
                    $_SESSION['error'] = "errorOudwachtwoordOngeldig";
                    header('location: /profiel/profielwachtwoord.php');
                }
            }
        }
    }

}



