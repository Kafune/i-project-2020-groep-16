<?php
include_once("../includes/header.php");
?>

<?php

if (isset($_SESSION['emailBestaat'])) :
    unset($_SESSION['emailBestaat']);

    ?>
    <section>
        <h2>Email Bestaat!</h2>
    </section>
<?php
endif;

    ?>
    <section>
        <form action="scripts/register.php" method="post">
            <label for="email">E-mail</label>
            <input type="email" name="email">
            <button type="submit" name="emailCheck">Check e-mail</button>
        </form>
    </section>

<?php
if (isset($_SESSION['registratieStatus'])) :
    if($_SESSION['registratieStatus'] == 1) :

    ?>
    <section>
        Stuur verificatie code in die naar email is gestuurd.
        <?= $_SESSION['email'] ?>
        <form action="scripts/register.php" method="post">
            <label for="code">Verificatiecode</label>
            <input type="text" name="code">
            <button type="submit" name="codeCheck">Volgende</button>
        </form>
    </section>

<?php
    if($_SESSION['verificatieCheck'] == 1) :

        ?>
        <section>
            <h1 class="is-size-1">Verificatie klopt niet!</h1>
        </section>
    <?php
        
    endif;

    elseif($_SESSION['registratieStatus'] == 2) :

        ?>
        <section>
            <form action="scripts/register.php" method="post">
                <label for="gebruikersnaam">Gebruikersnaam</label>
                <input type="text" name="gebruikersnaam">
                <label for="wachtwoord">Wachtwoord</label>
                <input type="password" name="wachtwoord">
                <button type="submit" name="accountCheck">Volgende</button>
            </form>
        </section>
    <?php

    elseif($_SESSION['registratieStatus'] == 3) :

?>

<section>
    <form action="scripts/register.php" method="post">
        <label for="voornaam">Voornaam</label>
        <input type="text" name="voornaam" required>
        <label for="achternaam">Achternaam</label>
        <input type="text" name="achternaam" required>
        <label for="adresregel1">Straat</label>
        <input type="text" name="adresregel1" required>
        <label for="adresregel2">Huisnummer</label>
        <input type="text" name="adresregel2" required>
        <label for="postcode">PostCode</label>
        <input type="text" name="postcode" required>
        <label for="plaatsnaam">Plaatsnaam</label>
        <input type="text" name="plaatsnaam" required>
        <label for="land">Land</label>
        <input type="text" name="land" required>
        <label for="geboortedag">Geboortedag</label>
        <input type="date" name="geboortedag" required>
        <label for="geheimevraag">Geheime vraag</label>
        <select name="vraag" id="geheimevraag" required>
            <option value="">Kies een geheime vraag..</option>
            <option value="1">In welke straat ben je geboren?</option>
            <option value="2">Wat is de meisjesnaam van je moeder?</option>
            <option value="3">Wat is je lievelingsgerecht?</option>
            <option value="4">Hoe heet je oudste zusje?</option>
            <option value="5">Hoe heet je huisdier?</option>
        </select>

        <label for="antwoord">Antwoord</label>
        <input type="text" name="antwoord" required>
        <button type="submit" name="registreren">Registreren</button>
    </form>
</section>

<?php
        endif;
endif;
?>


<?php
include_once("../includes/footer.php");
?>
