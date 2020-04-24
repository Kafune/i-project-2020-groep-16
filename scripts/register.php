<?php

require_once('../includes/root.php');
require_once(ROOT . '/includes/db.php');

session_start();


if (isset($_POST['emailCheck'])) {

    $email = $_POST['email'];


    $sql = "SELECT email FROM Gebruiker WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);


    if (empty($resultaat)) {

        //check eerst of deze gebruiker nog een verificatiecode open heeft staan
        $sql = "SELECT email FROM gebruikersverificatie WHERE email = :email";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);


        if (!empty($resultaat)) {
            //verwijder alle verificatiecodes die bij de gebruiker hoort
            $sql = "DELETE FROM gebruikersverificatie WHERE email = :email";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':email', $email);
            $stmt->execute();
        }
        $_SESSION['email'] = $email;
        $verificatiecode = bin2hex(random_bytes(6));

        $sql = "INSERT INTO gebruikersverificatie (email, verificatiecode)
        VALUES (:email, :verificatiecode)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':verificatiecode', $verificatiecode);

        $stmt->execute();
    }


    header('location: ' . $root . '/index.php');
}

if (isset($_POST['codeCheck'])) {
    $verificatiecode = $_POST['code'];

    $sql = "SELECT";
}