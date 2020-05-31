<?php
//$gebruiker = "iproject16";
//$wachtwoord = "zv1VeSWK";
//
//
//try {
//    $conn = new PDO('sqlsrv:server=mssql2.iproject.icasites.nl;database=iproject16', $gebruiker, $wachtwoord);
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch (PDOException $e) {
//    echo "Er is iets fout<br>{$e->getMessage()}";
//}

//$gebruiker = "root";
//$wachtwoord = "";
//
//
//try {
//    $conn = new PDO('mysql:host=localhost;dbname=EenmaalAndermaal', $gebruiker, $wachtwoord);
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch (PDOException $e) {
//    echo "Er is iets fout<br>{$e->getMessage()}";
//}

$gebruiker = "";
$wachtwoord = "";

//phpinfo();
try {
    $conn = new PDO("sqlsrv:server=(local);database=EenmaalAndermaal", $gebruiker, $wachtwoord);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Er is iets fout<br>{$e->getMessage()}";
}