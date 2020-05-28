<?php
include_once("../includes/header.php");
include_once("../includes/functies.php");



if (empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}


?>


    <div class="has-background-black has-text-white">
        <div class="container veilingoverzicht-container">
            <div class="columns">
                <div class="column is-hidden-touch">
                    <a href="/profiel/gebruikersprofiel.php" class="button is-primary"><- Terug</a>
                </div>
                <div class="column">
                    <h1 class="title is-2 has-text-white has-text-centered">Mijn Veilingen</h1>
                </div>
                <div class="column">
                    <form method="GET" action="">
                        <div class="field has-addons has-addons-centered">
                            <p class="control">
                                <input type="text" class="input" name="searching" id="" placeholder="Veiling zoeken"
                                       required>
                            </p>
                            <p class="control">
                                <button type="submit" class="button is-primary">Zoek</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <table>
                <tr>

                </tr>
            </table>

        </div>
    </div>

<?php
include_once("../includes/footer.php");