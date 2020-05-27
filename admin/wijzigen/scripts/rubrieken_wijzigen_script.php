<?php
include_once('../../../includes/db.php');

if (isset($_POST['wijzigen'])) {
    $rubrieknaam = $_POST['rubrieknaam'];
    $rubrieknummer = $_POST['rubrieknummer'];
    $rubrieknummeroud = $_POST['rubrieknummeroud'];
    $parent = $_POST['parent'];

    /*Check of het rubrieknummer niet in gebruik is*/
    $sql_check_rubrieknummer = "SELECT * FROM Rubriek WHERE rubrieknummer = :parent";
    $stmt = $conn->prepare($sql_check_rubrieknummer);
    $stmt->bindParam(':parent', $parent);
    $stmt->execute();

    $resultaat = $stmt->fetch();

    if (isset($resultaat)) {
        $sql = "UPDATE Rubriek SET rubrieknaam = :rubrieknaam, rubriek = :parent
                WHERE rubrieknummer = :rubrieknummeroud";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':rubrieknaam', $rubrieknaam);
        $stmt->bindParam(':parent', $parent);
        $stmt->bindParam(':rubrieknummeroud', $rubrieknummeroud);

        $stmt->execute();

        $sql_check = "SELECT * FROM Rubriek WHERE Rubriek = :rubrieknummeroud";
        $stmt = $conn->prepare($sql_check);
        $stmt->bindParam(':rubrieknummeroud', $rubrieknummeroud);
        $stmt->execute();

        $resultaat = $stmt->fetch();

        $_SESSION['success'] = 'rubriekGewijzigd';
        header('Location: ../rubrieken_wijzigen.php?rubrieknummer='.$rubrieknummer.'');
    } else {
        $_SESSION['error'] = 'parentNietBestaand';
        header('Location: ../rubrieken_wijzigen.php?rubrieknummer='.$rubrieknummer.'');
    }
}