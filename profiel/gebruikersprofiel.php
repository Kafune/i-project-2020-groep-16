<?php
include_once("../includes/header.php");
include_once("../includes/db.php");

if (isset($_SESSION['gebruiker'])) {
    $gebruikersnaam = $_SESSION['gebruiker'];

    $sqlKoper = "SELECT voornaam, achternaam,
            adresregel1, adresregel2, postcode, plaatsnaam,
            land, geboortedag, email, isVerkoper FROM Gebruiker where gebruikersnaam = :gebruikersnaam";

    $stmt1 = $conn->prepare($sqlKoper);
    $stmt1->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt1->execute();

    $row = $stmt1->fetch(PDO::FETCH_ASSOC);

    $voornaam = $row['voornaam'];
    $achternaam = $row['achternaam'];
    $adresregel1 = $row['adresregel1'];
    $adresregel2 = $row['adresregel2'];
    $postcode = $row['postcode'];

    $plaatsnaam = $row['plaatsnaam'];
    $land = $row['land'];
    $geboortedag = $row['geboortedag'];
    $email = $row['email'];
    $isVerkoper = $row['isVerkoper'];

    if ($isVerkoper == 1) {

        $sqlVerkoper = "SELECT banknaam, rekeningnummer, controleoptienaam, creditcardnummer 
                    FROM Verkoper WHERE gebruikersnaam = :gebruikersnaam";

        $stmt2 = $conn->prepare($sqlVerkoper);
        $stmt2->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmt2->execute();

        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

        $bank = $row2['banknaam'];
        $controle = $row2['controleoptienaam'];
        $creditcardnummer = $row2['creditcardnummer'];
        $rekeningnummer = $row2['rekeningnummer'];
    }

} else {
    header("Location: /index.php");
}


?>

<div class="has-background-black has-text-white">
    <div class="container">
        <div class="block">
            <br><br>
            <h1 class="title is-2 has-text-white has-text-centered">Mijn profiel</h1>
            <br>
            <hr>
            <div class="columns">
                <!-- dit moet alleen te zien zijn als de gebruiker ingelogd is -->
                <div class="column">
                    <h2 class="title is-3 has-text-white">Standaard account</h2>
                    <div class="columns">
                        <div class="column has-text-weight-bold">
                            <p>Naam</p>
                            <p>Gebruikersnaam</p>
                            <p>Geboortedatum</p>
                            <br>
                            <p>Adres</p>
                            <p>Postcode</p>
                            <p>Plaats</p>
                            <p>Land</p>
                            <br>
                            <p>Email</p>
                        </div>
                        <div class="column persoonlijke-data">
                            <p class="bewerkbaar"><?= $voornaam ?> <?= $achternaam ?></p>
                            <p><?= $gebruikersnaam ?></p>
                            <p><?= date("d-m-Y", strtotime($geboortedag)) ?></p>
                            <br>
                            <p class="bewerkbaar"><?= $adresregel1 ?></p>
                            <p class="bewerkbaar"><?= $postcode ?></p>
                            <p class="bewerkbaar"><?= $plaatsnaam ?></p>
                            <p><?= $land ?></p>
                            <br>
                            <p class="bewerkbaar"><?= $email ?></p>
                        </div>
                    </div>
                </div>
                <!-- dit moet alleen te zien zijn als de gebruiker ingelogd is en een verkoopaccount heeft -->
                <div class="column">
                    <h2 class="title is-3 has-text-white">Verkopers account</h2>
                    <div class="columns">
                        <div class="column has-text-weight-bold">
                            <p>Bank</p>
                            <p>Controle via</p>
                            <p>Creditcardnummer</p>
                            <p>Rekeningnummer</p>
                        </div>
                        <div class="column">
                            <p><?= $bank ?></p>
                            <p><?= $controle ?></p>
                            <p><?= $creditcardnummer ?></p>
                            <p><?= $rekeningnummer ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <!-- deze knop moet linken naar 'Mijn veilingen-pagina' -->
            <a href="" class="button is-primary">Naar mijn veilingen</a>
            <br><br>
            <!-- dit moet linken naar pagina 'Wijzig accountgegevens'-->
            <a href="profielbewerken.php" class="accountwijzigen">Wijzig accountgegevens</a>
            <br>

            <a href="profielwachtwoord.php">Verander wachtwoord</a>
            <br>

            <!-- dit moet linken naar pagina 'AVG-verwijderformulier'-->
            <a href="/scripts/verwijder-gebruiker.php"
               onclick="return confirm('Weet je zeker deze account te verwijderen ?')">Account verwijderen</a>
            <br>
            <a href="registrerenVerkoper.php">Registreren als verkoper</a>
            <br><br>


        </div>
    </div>
</div>
<?php
include_once("/includes/footer.php");
?>
