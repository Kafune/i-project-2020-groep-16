<?php
include_once("../includes/header.php");
include_once('../includes/meldingen.php');
?>
<title>Wachtwoord vergeten</title>

<body>
<?php
laatMeldingZien();
?>
<section class="hero is-primary is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-white">Wachtwoord vergeten?</h3>
            </div>
            <div class="box">
                <p>Bent u uw wachtwoord vergeten?</p>
                <form method="post" action="/scripts/profiel/wachtwoordvergeten.php">
                    <div class="control">
                        <label class="label" for="email">E-mailadres</label>
                        <input type="email" class="input" name="email" id="email" placeholder="Geldig emailadres">
                    </div>
                    <input type="submit" name="wachtwoord-vergeten-email" class="button is-black is-large">
                </form>
            </div>
        </div>
    </div>
</section>
</body>
<?php
include_once("../includes/footer.php");
?>