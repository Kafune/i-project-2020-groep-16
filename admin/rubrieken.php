<?php
include_once('../includes/header.php');
include_once('menu.php');
include_once('../includes/db.php');

/*SQL Zoek statements & sub-rubriek statement*/
if (isset($_GET['rubrieknaam'])) {
    $zoek = $_GET['rubrieknaam'];
    $sql = "SELECT r1.rubrieknummer, r1.rubrieknaam as rubrieknaam1, r1.rubriek, r2.rubrieknaam as rubrieknaam2
            FROM Rubriek as r1
            LEFT JOIN Rubriek as r2 ON r1.rubriek = r2.rubrieknummer 
            WHERE r1.rubrieknaam LIKE '%" . $zoek . "%'";
    $stmt = $conn->prepare($sql);
} else if (isset($_GET['rubrieknummer'])) {
    $zoek = $_GET['rubrieknummer'];
    $sql = "SELECT r1.rubrieknummer, r1.rubrieknaam as rubrieknaam1, r1.rubriek, r2.rubrieknaam as rubrieknaam2
            FROM Rubriek as r1
            LEFT JOIN Rubriek as r2 ON r1.rubriek = r2.rubrieknummer 
            WHERE r1.rubrieknummer LIKE '%" . $zoek . "%'";
    $stmt = $conn->prepare($sql);
}else if (isset($_GET['parent'])) {
    $zoek = $_GET['parent'];
    $sql = "SELECT r1.rubrieknummer, r1.rubrieknaam as rubrieknaam1, r1.rubriek, r2.rubrieknaam as rubrieknaam2
            FROM Rubriek as r1
            LEFT JOIN Rubriek as r2 ON r1.rubriek = r2.rubrieknummer 
            WHERE r1.rubriek LIKE '%" . $zoek . "%'";
    $stmt = $conn->prepare($sql);
} else if (isset($_GET['id'])){
    $sql = "SELECT r1.rubrieknummer, r1.rubrieknaam as rubrieknaam1, r1.rubriek, r2.rubrieknaam as rubrieknaam2
            FROM Rubriek as r1
            LEFT JOIN Rubriek as r2 ON r1.rubriek = r2.rubrieknummer
            WHERE r1.Rubriek = :rubrieknummer ORDER BY r1.rubrieknaam ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':rubrieknummer', $_GET['id']);
} else if (empty($_GET['rubrieknaam'])) {
    $sql = "SELECT r1.rubrieknummer, r1.rubrieknaam as rubrieknaam1, r1.rubriek, r2.rubrieknaam as rubrieknaam2
            FROM Rubriek as r1
            LEFT JOIN Rubriek as r2 ON r1.rubriek = r2.rubrieknummer 
            WHERE r1.Rubriek = -1 ORDER BY r1.rubrieknaam";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
?>

<div class="column is-10" style="padding-top: 3rem">
    <div class="columns">
        <div class="column is-9">
            <section class="hero is-primary is-small">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">Rubrieken wijzigen</h1>
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
                                $rubrieknaam = $row['rubrieknaam1'];
                                $parentnaam = $row['rubrieknaam2'];
                                $parent = $row['rubriek'];
                                $id = $row['rubrieknummer'];

                                echo "
                                <tr>
                                <td width=\"5%\"><i class=\"fa fa-bookmark\"></i></td>
                                <td>" . $parentnaam . "</td>
                                <td>" . $rubrieknaam . "</td>
                                <td><a class=\"button is-small is-primary\" href=\"/admin/rubrieken.php?id=".$id."\">Sub-rubrieken</a></td>
                                <td class=\"level-right\"><a class=\"button is-small is-primary\" href=\"wijzigen/rubrieken_wijzigen.php?rubrieknummer=".$id."\">Wijzigen</a></td>
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
                        <p class="card-header-title">Zoeken op rubriek</p>
                    </header>
                    <form method="get" class="card-content">
                        <div class="content">
                            <div class="control has-icons-left has-icons-right">
                                <label class="label" for="rubrieknaam"></label>
                                <input class="input is-medium" type="text" id="rubrieknaam" name="rubrieknaam">
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
                        <p class="card-header-title">Zoeken op rubrieknummer</p>
                    </header>
                    <form method="get" class="card-content">
                        <div class="content">
                            <div class="control has-icons-left has-icons-right">
                                <label class="label" for="rubrieknummer"></label>
                                <input class="input is-medium" type="text" id="rubrieknummer" name="rubrieknummer">
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
                        <p class="card-header-title">Zoeken op parentnummer</p>
                    </header>
                    <form method="get" class="card-content">
                        <div class="content">
                            <div class="control has-icons-left has-icons-right">
                                <label class="label" for="parent"></label>
                                <input class="input is-medium" type="text" id="parent" name="parent">
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
