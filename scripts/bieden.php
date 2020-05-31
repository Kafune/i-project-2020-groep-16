<?php
include_once("../includes/db.php");
session_start();

if (isset($_SESSION['gebruiker'])) {
    $gebruikersnaam = $_SESSION['gebruiker'];
}

if (isset($_POST['bied'])) {
    $tijdstip = date('Y-m-d H:i:s');
    $bod = $_POST['bodbedrag'];
    $voorwerpnummer = $_POST['voorwerpnummer'];

    /*Haal het hoogst geboden bedrag op uit de database*/
    $sql = "SELECT TOP 1 gebruiker, bodbedrag FROM Bod WHERE Voorwerp = :voorwerpnummer ORDER BY bodbedrag DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':voorwerpnummer', $voorwerpnummer);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    $hoogstebod = $results['bodbedrag'];
    $laatstebieder = $results['gebruiker'];

    /*Haal de startprijs op uit de de database*/
    $sql_startprijs = "SELECT veilingGesloten, startprijs FROM Voorwerp WHERE voorwerpnummer = :voorwerpnummer";
    $stmt = $conn->prepare($sql_startprijs);
    $stmt->bindParam(':voorwerpnummer', $voorwerpnummer);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $startprijs = $results['startprijs'];
    $veilingGesloten = $results['veilingGesloten'];

    if ($veilingGesloten == 0) {
        if ($bod >= $startprijs) {
            if ($bod > $hoogstebod) {
                if ($gebruikersnaam != $laatstebieder) {
                    $sql_insertbod = "INSERT INTO Bod(Voorwerp, bodbedrag, gebruiker, bodtijdstip) VALUES (:voorwerp, :bod, :gebruiker, :bodtijdstip)";
                    $stmt = $conn->prepare($sql_insertbod);
                    $stmt->bindParam(':voorwerp', $voorwerpnummer);
                    $stmt->bindParam(':bod', $bod);
                    $stmt->bindParam(':gebruiker', $gebruikersnaam);
                    $stmt->bindParam(':bodtijdstip', $tijdstip);

                    $stmt->execute();
                    header('Location: ../voorwerp.php?voorwerpnummer=' . $voorwerpnummer . '');
                } else {
                    $_SESSION['error'] = 'zelfdeGebruiker';
                    header('Location: ../voorwerp.php?voorwerpnummer=' . $voorwerpnummer . '');
                }

            } else {
                $_SESSION['error'] = 'bodTeLaag';
                header('Location: ../voorwerp.php?voorwerpnummer=' . $voorwerpnummer . '');
            }
        } else {
            $_SESSION['error'] = 'bodLagerDanStartprijs';
            header('Location: ../voorwerp.php?voorwerpnummer=' . $voorwerpnummer . '');
        }
    } else {
        $_SESSION['error'] = 'veilingGesloten';
        header('Location: ../voorwerp.php?voorwerpnummer=' . $voorwerpnummer . '');
    }
}


