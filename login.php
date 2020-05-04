<?php
include_once("includes/header.php");
?>
<link rel="stylesheet" href="styles/bulma.min.css">
<link rel="stylesheet" href="styles/css/mystyles.css">
<title>Login</title>

<body>
<section class="hero is-black is-fullheight">
    <div class="container">
        <div class="columns is-centered">
            <form action="" class="box">
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left">
                        <input class="input is-success" type="text" placeholder="Text input">
                        <span class="icon is-primary is-left">
                          <i class="fas fa-home"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="" class="label">Wachtwoord</label>
                    <input type="password" placeholder="*********" class="input" required>
                </div>
                <input type="submit" class="button is-primary">
            </form>
        </div>
    </div>
    </div>
</section>
</body>

<?php
include_once("includes/footer.php");
?>
