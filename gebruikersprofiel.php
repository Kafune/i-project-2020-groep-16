<?php
include_once("includes/header.php");
include_once("includes/db.php");

if(isset($_SESSION['gebruiker'])){
    $gebruikersnaam = $_SESSION['gebruiker'];

    $sql = "SELECT voornaam, achternaam,
            adresregel1, adresregel2, postcode, plaatsnaam,
            land, geboortedag, email FROM Gebruiker where gebruikersnaam = :gebruikersnaam";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $voornaam = $row['voornaam'];
    $achternaam = $row['achternaam'];
    $adresregel1 = $row['adresregel1'];
    $adresregel2 = $row['adresregel2'];
    $postcode = $row['postcode'];
    $plaatsnaam = $row['plaatsnaam'];
    $land = $row['land'];
    $geboortedag = $row['geboortedag'];
    $email = $row['email'];

} else {
    header("Location: /index.php");
}


?>
<link rel="stylesheet" href="styles/css/mystyles.css">
<link rel="stylesheet" href="styles/custom_styles.css">

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
                            <p>Telefoon</p>
                            <p>Mobiel</p>
                        </div>
                        <div class="column">
                            <p><?=$voornaam?> <?=$achternaam?></p>
                            <p><?=$gebruikersnaam?></p>
                            <p><?=$geboortedag?></p>
                            <br>
                            <p><?=$adresregel1?></p>
                            <p><?=$postcode?></p>
                            <p><?=$plaatsnaam?></p>
                            <p><?=$land?></p>
                            <br>
                            <p><?=$email?></p>
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
                            <p><?=$Bank?></p>
                            <p><?=$Controle?></p>
                            <p><?=$Creditcard?></p>
                            <p><?=$Bankrekening?></p>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <!-- deze knop moet linken naar 'Mijn veilingen-pagina' -->
            <a href="" class="button is-primary">Naar mijn veilingen</a>
            <br><br>
            <!-- dit moet linken naar pagina 'Wijzig accountgegevens'-->
            <a href="">Wijzig accountgegevens</a>
            <br>
            <!-- dit moet linken naar pagina 'AVG-verwijderformulier'-->
            <a href="">Verwijder gebruikersprofiel</a>
            <br><br>
        </div>
    </div>
</div>
<?php
include_once("includes/footer.php");
?>