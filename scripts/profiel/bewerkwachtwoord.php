<?php
session_start();
require_once('../../includes/root.php');
include_once('../../includes/db.php');
include_once('../../includes/functies.php');

$sql = "SELECT gebruikersnaam, wachtwoord FROM Gebruiker WHERE gebruikersnaam = :gebruikersnaam";


if (isset($_SESSION['gebruiker'])) {
    $gebruikersnaam = $_SESSION['gebruiker'];
    $resultaat = haalIngelogdeGebruiker($conn, $gebruikersnaam);
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

                        header('location: /gebruikersprofiel.php');
                    } else {
                        header('location: /profielwachtwoord.php');
                    }
                } else {
                    $_SESSION['wachtwoordCheck'] = "oudwachtwoordOngeldig";
                    header('location: /profielwachtwoord.php');
                }

            }
        }
    }

}

//deze check is er voor het geval dat een gebruiker via client zijn gebruikersnaam probeert te manipuleren
function checkGegevens($clientResultaat, $databaseResultaat)
{
    if ($clientResultaat == $databaseResultaat) {
        return true;
    }
    return false;
}



