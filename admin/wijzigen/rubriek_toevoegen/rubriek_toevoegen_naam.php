<?php
include_once('../../../includes/header.php');
include_once('../../menu.php');
include_once('../../../includes/db.php');
?>

<div class="column is-9" style="padding-top: 3rem">
    <section class="hero is-primary welcome is-small">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">Rubriek toevoegen</h1>
            </div>
        </div>
    </section>
    <div class="column">
        <form action="rubriek_toevoegen_script.php" method="post">
            <div class="columns">
                <div class="column is-half has-text-weight-bold">
                    <div class="field">
                        <label for="rubrieknaam">Rubrieknaam</label>
                        <input type="text" name="rubrieknaam" id="rubrieknaam" class="input" required><br>
                        <input type="hidden" name="parent" id="parent" value="<?= $_GET['id'] ?>">
                    </div>
                    <div class="field">
                        <button type="submit" name="toevoegen" id="toevoegen" class="button is-primary">Rubriek
                            toevoegen
                        </button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
