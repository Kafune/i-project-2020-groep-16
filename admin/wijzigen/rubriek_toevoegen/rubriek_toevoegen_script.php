<?php
include_once('../../../includes/db.php');
session_start();

if(isset($_POST['toevoegen'])) {
    $parent = $_POST['parent'];
    $rubrieknaam = $_POST['rubrieknaam'];

    $sql = "INSERT INTO Rubriek(rubrieknaam, rubriek) VALUES (:rubrieknaam, :parent)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':rubrieknaam', $rubrieknaam);
    $stmt->bindParam(':parent', $parent);
    $stmt->execute();

    $_SESSION['success'] = "rubriekToevoegen";
    header('Location: ../../rubrieken.php');
}