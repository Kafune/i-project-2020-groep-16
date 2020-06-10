<?php
$gebruiker = "iproject16";
$wachtwoord = "zv1VeSWK";
$server = "mssql2.iproject.icasites.nl";
$database = "iproject16";

try {
    $conn = new PDO('sqlsrv:server='.$server.';database='.$database.'', $gebruiker, $wachtwoord);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Er is iets fout<br>{$e->getMessage()}";
}