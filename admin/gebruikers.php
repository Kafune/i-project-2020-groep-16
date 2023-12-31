<?php
include_once('../includes/header.php');
include_once('menu.php');
include_once('../includes/db.php');

if (isset($_GET['gebruikersnaam'])) {
    $zoek = "SELECT TOP 200 * FROM Gebruiker
         WHERE gebruikersnaam like '%".$_GET['gebruikersnaam']."%'
         and voornaam like '%".$_GET['voornaam']."%'
         and achternaam like '%".$_GET['achternaam']."%'";

    if(isset($_GET['isVerkoper'])){
        $zoek .= "and isVerkoper = 1";
    }
    if(isset($_GET['isAdmin'])){
        $zoek .= "and isAdmin = 1";
    }
    if(isset($_GET['geblokkeerd'])){
        $zoek .= "and geblokkeerd = 1";
    }

    $stmt = $conn->prepare($zoek);
} else {
    $zoek = "SELECT * FROM Gebruiker ORDER BY gebruikersnaam";
    $stmt = $conn->prepare($zoek);
}

$stmt->execute();
?>

<div class="column is-10" style="padding-top: 3rem">
    <div class="columns">
        <div class="column is-9">
            <section class="hero is-primary is-small">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">Gebruikers</h1>
                    </div>
                </div>
            </section>
            <div class="card events-card">
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped">
                            <tbody>
                            <?php

                            while ($row = $stmt->fetch()) {
                                $gebruikersnaam = $row['gebruikersnaam'];
                                $naam = $row['voornaam'] . " " . $row['achternaam'];

                                echo "
                                <tr>
                                <td width=\"5%\"><i class=\"fa fa-user\"></i></td>
                                <td>" . $gebruikersnaam . "</td>
                                <td>" . $naam . "</td>
                                <td class=\"level-right\"><a class=\"button is-small is-primary\" 
                                href='wijzigen/gebruiker_wijzigen.php?gebruikersnaam=" . $gebruikersnaam . "'>Wijzigen</a></td>
                                </tr>";
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="columuns is-4">
            <div class="column">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Zoeken</p>
                    </header>
                    <form method="get" class="card-content">
                        <div class="content">
                            <label class="label" for="gebruikersnaam">Gebruikersnaam</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input is-medium" type="text" id="gebruikersnaam" name="gebruikersnaam">
                                <span class="icon is-medium is-left">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <div class="content">
                            <div class="content">
                                <label class="label" for="voornaam">Voornaam</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-medium" type="text" id="voornaam" name="voornaam">
                                    <span class="icon is-medium is-left">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <label class="label" for="achternaam">Achternaam</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input is-medium" type="text" id="achternaam" name="achternaam">
                                <span class="icon is-medium is-left">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <div class="content">
                            <div class="control">
                                <label class="label" for="isAdmin">Admin</label>
                                <input class="checkbox" type="checkbox" id="isAdmin" value="1" name="isAdmin">
                            </div>
                            <div class="control">
                                <label class="label" for="isVerkoper">Verkoper</label>
                                <input class="checkbox" type="checkbox" id="isVerkoper" value="1" name="isVerkoper">
                            </div>
                            <div class="control">
                                <label class="label" for="geblokkeerd">Geblokkeerd</label>
                                <input class="checkbox" type="checkbox" id="geblokkeerd" value="1" name="geblokkeerd">
                            </div>
                        </div>
                        <div class="control">
                            <button class="button is-primary">Zoeken</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



