<?php
include_once("../includes/header.php");
?>
    <title>Wachtwoord veranderen</title>

    <body>
<?php
//zorg ervoor dat de gebruiker niet direct deze form kan invullen
if($_SESSION['wachtwoordVergetenStap'] == 3) :
    ?>
    <section class="hero is-primary is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-white">Wachtwoord veranderen</h3>
                </div>
                <div class="box">
                    <p>U hoeft nu alleen uw nieuwe wachtwoord 2 keer in te voeren om uw wachtwoord te wijzigen.</p>
                    <form method="post" action="/scripts/profiel/wachtwoordveranderen.php">
                        <div class="control">
                            <label class="label" for="wachtwoord">Wachtwoord</label>
                            <input type="password" class="input" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord">
                        </div>
                        <div class="control">
                            <label class="label" for="wachtwoordbevestigen">Wachtwoord Bevestigen</label>
                            <input type="password" class="input" name="wachtwoordbevestigen" id="wachtwoordbevestigen" placeholder="Wachtwoord bevestigen">
                        </div>
                        <input type="submit" name="wachtwoord-vergeten-veranderen" class="button is-black is-large">
                    </form>
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