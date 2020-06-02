<?php
include_once ('../../../includes/db.php');
session_start();
$voorwerpnummer = $_GET['voorwerpnummer'];
if($_GET['status'] == 'blokkeer'){
    $status = 1;
    $_SESSION['success'] = "successVeilingBlokkeren";
} else {
    $status = 0;
    $_SESSION['success'] = "successVeilingDeBlokkeren";
}

$sql = "UPDATE Voorwerp SET geblokkeerd = :status WHERE voorwerpnummer = :voorwerpnummer";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':voorwerpnummer', $voorwerpnummer);
$stmt->bindParam(':status', $status);
$stmt->execute();


header('Location: ../voorwerp_blokkeren.php');