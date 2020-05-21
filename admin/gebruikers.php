<?php
include_once('../includes/header.php');
include_once('menu.php');
include_once('../includes/db.php');

if (isset($_GET['gebruikersnaam'])) {
    $zoek = $_GET['gebruikersnaam'];
    $stmt = $conn->prepare("SELECT * FROM Gebruiker WHERE gebruikersnaam LIKE '%" . $zoek . "%'");
} else if (isset($_GET['voornaam'])) {
    $zoek = $_GET['voornaam'];
    $stmt = $conn->prepare("SELECT * FROM Gebruiker WHERE voornaam LIKE '%" . $zoek . "%'");
} else if (isset($_GET['achternaam'])) {
    $zoek = $_GET['achternaam'];
    $stmt = $conn->prepare("SELECT * FROM Gebruiker WHERE achternaam LIKE '%" . $zoek . "%'");
} else if (empty($_GET['gebruikersnaam'])) {
    $stmt = $conn->prepare("SELECT * FROM Gebruiker ORDER BY gebruikersnaam");
}
$stmt->execute();
?>

<div class="column is-9">
    <div class="columns" style="padding-top: 3rem">
        <div class="column is-8">
            <div class="card events-card">
                <header class="card-header">
                    <p class="card-header-title">
                        Gebruikers
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                    </a>
                </header>
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
                                href='wijzigen/gebruiker_wijzigen.php?gebruikersnaam=".$gebruikersnaam."'>Wijzigen</a></td>
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
                        <p class="card-header-title">Zoeken op gebruikersnaam</p>
                    </header>
                    <form method="get" class="card-content">
                        <div class="content">
                            <div class="control has-icons-left has-icons-right">
                                <label class="label" for="gebruikersnaam"></label>
                                <input class="input is-medium" type="text" id="gebruikersnaam" name="gebruikersnaam">
                                <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Zoeken op voornaam</p>
                    </header>
                    <form method="get" class="card-content">
                        <div class="content">
                            <div class="control has-icons-left has-icons-right">
                                <label class="label" for="voornaam"></label>
                                <input class="input is-medium" type="text" id="voornaam" name="voornaam">
                                <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Zoeken op achternaam</p>
                    </header>
                    <form method="get" class="card-content">
                        <div class="content">
                            <div class="control has-icons-left has-icons-right">
                                <label class="label" for="achternaam"></label>
                                <input class="input is-medium" type="text" id="achternaam" name="achternaam">
                                <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



