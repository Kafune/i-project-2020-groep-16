<?php
// check of de user alle twee velden heeft ingevuld en dan pas de code hieronder uitvoeren
session_start();
if(!empty($_POST["gebruikersnaam"]) && !empty($_POST["wachtwoord"])) {

    include('../includes/DB/database.php');
// gebruikersnaam checken of het bestaat

    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];
    $statement = "SELECT * FROM gebruiker WHERE gebruikersnaam =?";
    $stmt = $db->prepare($statement);
    $stmt->bind_param("s", $gebruikersnaam);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $server_password = $row["wachtwoord"];
    $password = sha1($wachtwoord);

    //$hash = sha1($wachtwoord);
    //$_SESSION['wachtwoord'] = $hash;

//wachtwoord checken of het correct is
    if ($server_password == $password) {
        echo "Succesvol login";

        $_SESSION["gebruikersnaam"] = $_POST["gebruikersnaam"];
        $db->close();
        header("Location:../index.php");
    } else {
        echo "login gefaald";
        echo "<br>";
        $db->close();
        header("Location:login.php");
    }
}
// als velden niet ingevuld zijn dan pagina refresh
else
{
header("Location:login.php");
}
?>