<?php
include_once("includes/header.php");
?>
<link rel="stylesheet" href="styles/bulma.min.css">
<link rel="stylesheet" href="styles/css/mystyles.css">
<title>Login</title>

<body>
<section class="hero is-primary is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-white">Login</h3>
                <hr class="login-hr">
                <div class="box">
                    <form action="scripts/check-login.php" method="post">
                        <div class="field">
                            <div class="control">
                                <label class="label" for="gebruikersnaam">Gebruikersnaam</label>
                                    <input class="input is-large" type="text" name="gebruikersnaam" id="gebruikersnaam" autofocus="" required>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <label class="label" for="wachtwoord">Wachtwoord</label>
                                    <input class="input is-large" type="password" name="wachtwoord" id="wachtwoord" required>
                            </div>
                        </div>
                        <button class="button is-block is-black is-large is-fullwidth">Login<i class="fa fa-sign-in"
                                                                                                aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>

<?php
include_once("includes/footer.html");
?>
