<?php
include_once('../../includes/header.php');
include_once('../menu.php');
include_once('../../includes/db.php');

$zoekVerkoper = $_GET['verkoper'];
$zoekPlaatsnaam = $_GET['plaatsnaam'];
/*SQL Zoek statements & sub-rubriek statement*/
if (isset($_GET['titel']) || isset($_GET['titel'])) {
//    $zoek = "SELECT TOP 200 * FROM Voorwerp
//         WHERE voorwerpnummer like '".$_GET['voorwerpnummer']."'
//         and titel like '%".$_GET['titel']."%'
//         and land like '%".$_GET['land']."%'
//         and verkoper like '%".$_GET['verkoper']."%'";

    $zoek = "SELECT TOP 200 * FROM Voorwerp
         WHERE titel like '%" . $_GET['titel'] . "%'";

    if ($zoekVerkoper != '') {
        $zoek .= "and verkoper like '" . $_GET['verkoper'] . "'";
    }
    if ($_GET['minstartprijs'] > 0) {
        $zoek .= "and startprijs > " . $_GET['minstartprijs'];
    }
    if ($_GET['maxstartprijs'] > 0) {
        $zoek .= "and startprijs < " . $_GET['maxstartprijs'];
    }
    if (isset($_GET['gesloten'])) {
        $zoek .= "and veilingGesloten = 1";
    }
    if (isset($_GET['geblokkeerd'])) {
        $zoek .= "and geblokkeerd = 1";
    }

    $zoek .= "ORDER BY veilingbegin DESC";

    $stmt = $conn->prepare($zoek);
} else {
    $zoek = "SELECT TOP 200 * FROM Voorwerp ORDER BY veilingbegin DESC";
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
                        <h1 class="title">Voorwerp blokkeren</h1>
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
                                $voorwerp = $row['voorwerpnummer'];
                                $titel = $row['titel'];
                                $startprijs = $row['startprijs'];
                                $verkoper = $row['verkoper'];
                                $gesloten = $row['veilingGesloten'];
                                $geblokkeerd = $row['geblokkeerd'];

                                if ($geblokkeerd == 1) {
                                    echo "<tr>
                                          <td width=\"5%\"><i class=\"fa fa-cube has-text-danger\"></i></td>";
                                }else if ($gesloten == 1) {
                                    echo "<tr>
                                          <td width=\"5%\"><i class=\"fa fa-cube\"></i></td>";
                                } else if ($gesloten == 0) {
                                    echo "<tr>
                                          <td width=\"5%\"><i class=\"fa fa-cube has-text-success\"></i></td>";
                                }
                                echo "
                                <td>" . $voorwerp . "</td>
                                <td>" . $titel . "</td>
                                <td>" . $verkoper . "</td>";

                                if($geblokkeerd == 1){
                                    echo "<td class=\"level-right\"><a class=\"button is-small is-primary\" href=\"/admin/wijzigen/scripts/voorwerp_blokkeren_script.php?voorwerpnummer=" . $voorwerp . "&status=deblokkeer\">Deblokkeren</a></td>
                                          </tr>";
                                } else if($geblokkeerd == 0){
                                    echo "<td class=\"level-right\"><a class=\"button is-small is-primary\" href=\"/admin/wijzigen/scripts/voorwerp_blokkeren_script.php?voorwerpnummer=" . $voorwerp . "&status=blokkeer\">Blokkeren</a></td>
                                          </tr>";
                                }
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
                            <label class="label" for="voorwerpnummer">Voorwerpnummer</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input is-medium" type="number" id="voorwerpnummer" name="voorwerpnummer">
                                <span class="icon is-medium is-left">
                                <i class="fa fa-hashtag"></i>
                            </div>
                        </div>
                        <div class="content">
                            <div class="content">
                                <label class="label" for="titel">Titel</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-medium" type="text" id="titel" name="titel">
                                    <span class="icon is-medium is-left">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <label class="label" for="verkoper">Verkoper</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input is-medium" type="text" id="verkoper" name="verkoper">
                                <span class="icon is-medium is-left">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <div class="content">
                            <label class="label" for="land">Land</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input is-medium" type="text" id="land" name="land">
                                <span class="icon is-medium is-left">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <div class="content">
                            <label class="label" for="minstartprijs">Minimum startprijs</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input is-medium" type="number" min="0" step="10" id="minstartprijs"
                                       name="minstartprijs">
                                <span class="icon is-medium is-left">
                                <i class="fa fa-eur"></i>
                            </div>
                        </div>
                        <div class="content">
                            <label class="label" for="maxstartprijs">Maximum startprijs</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input is-medium" type="number" min="0" step="10" id="maxstartprijs"
                                       name="maxstartprijs">
                                <span class="icon is-medium is-left">
                                <i class="fa fa-eur"></i>
                            </div>
                        </div>
                        <div class="content">
                            <div class="control">
                                <label class="label" for="gesloten">Gesloten</label>
                                <input class="checkbox" type="checkbox" id="gesloten" value="1" name="gesloten">
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
