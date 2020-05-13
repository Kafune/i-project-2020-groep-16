<?php
include_once("../includes/header.php");

require_once('../includes/db.php');

$resultaat = haalGebruikerInfo($conn, $_SESSION['email']);

?>
    <title>Wachtwoord vergeten - Geheime vraag</title>

    <body>
    <?php
    //zorg ervoor dat de gebruiker niet direct
    if($_SESSION['wachtwoordVergetenStap'] == 2) :
        ?>
        <section class="hero is-primary is-fullheight">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="column is-4 is-offset-4">
                        <h3 class="title has-text-white">Geheime vraag</h3>
                    </div>
                    <div class="box">
                        <p>Vul de antwoord in die u heeft gegeven bij het beantwoorden van deze geheime vraag.</p>
                        <form action="/scripts/profiel/emailverificatie.php" method="post">
                            <div class="control">
                                <label class="geheimevraag" for="geheimevraag">Geheime vraag</label>
                                <input type="text" name="geheimevraag" class="input" value="<?=$resultaat['tekstvraag']?>" disabled>
                            </div>
                            <div class="control">
                                <label class="geheimeantwoord" for="geheimeantwoord">Geheime antwoord</label>
                                <input type="text" name="geheimeantwoord" class="input">
                            </div>
                            <input type="submit" name="wachtwoord-vergeten-codeverificatie" class="button is-black is-large">
                        </form>
                        <?=$_SESSION['verificatieCode']?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    endif;
    ?>
    </body>
<?php
include_once("../includes/footer.php");

function haalGebruikerInfo($dbconnectie, $email)
{
    //Check eerst of de e-mail al bestaat in de gebruikersdatabase
    $sql = "SELECT vraag, antwoordtekst, tekstvraag
            FROM Gebruiker 
            INNER JOIN Vraag ON Gebruiker.vraag = Vraag.vraagnummer
            WHERE email = :email";
    $stmt = $dbconnectie->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultaat;
}
?>