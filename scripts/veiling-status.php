<?php
include_once('../includes/db.php');
global $conn;

$voorwerpdetails = $conn->prepare("SELECT * FROM Voorwerp WHERE veilingGesloten = 1 AND veilingeinde >= DATEADD(DAY, -5, GETDATE()) AND mailVerzonden = 0");
$voorwerpdetails->execute();

while ($row_voorwerp = $voorwerpdetails->fetch(PDO::FETCH_ASSOC)) {
    $voorwerp_row = $conn->prepare("select * from Voorwerp where voorwerpnummer = '" . $row_voorwerp["voorwerpnummer"] . "'");
    $voorwerp_row->execute();
    $result_voorwerp = $voorwerp_row->fetch(PDO::FETCH_ASSOC);

    $row_koper = $conn->prepare("select * from Gebruiker where gebruikersnaam = '" . $row_voorwerp["koper"] . "'");
    $row_koper->execute();
    $result_koper = $row_koper->fetch(PDO::FETCH_ASSOC);

    $row_verkoper = $conn->prepare("select * from Gebruiker where gebruikersnaam = '" . $row_voorwerp["verkoper"] . "'");
    $row_verkoper->execute();
    $result_verkoper = $row_verkoper->fetch(PDO::FETCH_ASSOC);

    $bericht_verkoper = "
Beste verkoper van EenmaalAndermaal,

We willen u graag informeren dat de volgende veiling: {$result_voorwerp["titel"]} verkocht is.
De koper van de veiling is: {$result_koper["gebruikersnaam"]}. 
U kunt de koper met het volgende e-mailadres bereiken: {$result_koper['email']}

We hopen u met dit mailtje voldoende geinformeerd te hebben.

Met vriendelijke groet,
Team EenmaalAndermaal.
        ";

    $bericht_koper = "
Beste gebruiker van EenmaalAndermaal,

We willen u graag informeren dat u de volgende veiling gewonnen hebt: {$result_voorwerp["titel"]}.
De verkoper zal zo snel mogelijk contact met u opnemen per mail om de verkoop te voltooien, u hoeft nu verder niets te doen.

We hopen u met dit mailtje voldoende geinformeerd te hebben.

Met vriendelijke groet,
Team EenmaalAndermaal.
        ";

    mail($result_koper["email"], 'EenmaalAndermaal - Belangrijke informatie over een veiling', $bericht_koper);
    mail($result_verkoper["email"], 'EenmaalAndermaal - Belangrijke informatie over een veiling', $bericht_verkoper);

    $update_row = $conn->prepare("UPDATE Voorwerp SET mailVerzonden = 1 WHERE voorwerpnummer = '" . $result_voorwerp['voorwerpnummer'] . "'");
    $update_row->execute();
}