<?php
include_once("../includes/header.php");
include_once ('../includes/errors.php');
?>
    <title>Wachtwoord vergeten - Email verificatie</title>

    <body>
    <?php
        //zorg ervoor dat de gebruiker niet direct
        if($_SESSION['wachtwoordVergetenStap'] == 1) :
    ?>

    <section class="hero is-primary is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-white">Verificatie</h3>
                </div>
                <div class="box">
                    <p>Voer de verificatiecode in die naar de ingevoerde mailadres is gestuurd om verder te gaan</p>
                    <form action="/scripts/profiel/emailverificatie.php" method="post">
                        <div class="control">
                            <label class="label" for="code">VerificatieCode</label>
                            <input type="text" name="code" class="input">
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
?>