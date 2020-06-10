<?php

$gebruiker = "";
$wachtwoord = "";

//phpinfo();
try {
    $conn = new PDO("sqlsrv:server=(local);database=EenmaalAndermaal", $gebruiker, $wachtwoord);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Er is iets fout<br>{$e->getMessage()}";
}