<?php
$servername = "mssql2.iproject.icasites.nl";
$gebruiker = "iproject16";
$wachtwoord = "zv1VeSWK";
$db = "iproject16";

try {
    $conn = new PDO("mysql:host=$servername;dbname=myDB", $gebruiker, $wachtwoord, $db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Er is iets fout<br>{$e->getMessage()}";
}