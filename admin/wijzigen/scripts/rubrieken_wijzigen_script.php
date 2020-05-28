<?php
include_once('../../../includes/db.php');
session_start();

if (isset($_POST['wijzigen'])) {
    $rubrieknaam = $_POST['rubrieknaam'];
    $rubrieknummer = $_POST['rubrieknummer'];

    /*Update rubrieknaam*/
    $sql = "UPDATE Rubriek SET rubrieknaam = :rubrieknaam
                WHERE rubrieknummer = :rubrieknummer";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':rubrieknaam', $rubrieknaam);
    $stmt->bindParam(':rubrieknummer', $rubrieknummer);

    $stmt->execute();

    $_SESSION['success'] = 'rubriekGewijzigd';
    header('Location: ../rubrieken_wijzigen.php?rubrieknummer=' . $rubrieknummer . '');
} else if (isset($_GET['rubrieknummer']) && isset($_GET['id'])) {
    $rubrieknummer = $_GET['rubrieknummer'];
    $parent = $_GET['id'];

    $sql_verander_parent = "UPDATE Rubriek SET rubriek = :parent
                            WHERE rubrieknummer = :rubrieknummer";
    $stmt = $conn->prepare($sql_verander_parent);
    $stmt->bindParam(':parent', $parent);
    $stmt->bindParam(':rubrieknummer', $rubrieknummer);
    $stmt->execute();

    header('Location: ../rubrieken_wijzigen.php?rubrieknummer=' . $rubrieknummer . '');
}