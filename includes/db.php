<?php
$gebruiker = "iproject16";
$wachtwoord = "zv1VeSWK";


try {
    $conn = new PDO('sqlsrv:server=mssql2.iproject.icasites.nl;database=iproject16', $gebruiker, $wachtwoord);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Er is iets fout<br>{$e->getMessage()}";
}
