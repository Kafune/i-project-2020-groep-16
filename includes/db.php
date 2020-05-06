<?php
$gebruiker = "root";
$wachtwoord = "";

try {
    $conn = new PDO('mysql:host=localhost;dbname=eenmaalandermaal', $gebruiker, $wachtwoord);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Er is iets fout<br>{$e->getMessage()}";
}