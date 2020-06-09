<?php
//includes
include_once("../includes/header.php");
include_once("../includes/db.php");

//check of gebruiker is ingelogd
if (isset($_SESSION['gebruiker'])) {
//maakt variabel 'gebruikersnaam aan' met als input de huidige gebruiker
    $gebruikersnaam = $_SESSION['gebruiker'];
}
//
$sql = "SELECT voorwerpnummer, titel,veilingeinde, startprijs,
        max(bodbedrag) as 'hoogste bod', gebruiker, geblokkeerd, veilingGesloten
        FROM voorwerp
        LEFT JOIN Bod ON voorwerp.voorwerpnummer = bod.Voorwerp
        WHERE verkoper = :verkoper ";

//if (strlen($_GET['titel']) > 0) {
//    $sql .= " and titel like '%" . $_GET['titel'] . "%' ";
//}
if (isset($_GET['voorwerpnummer'])) {
    $sql .= " and voorwerpnummer = " . $_GET['voorwerpnummer'] . " ";
}
if (isset($_GET['gesloten'])) {
    $sql .= " and veilingGesloten = 1 ";
}
if (isset($_GET['geblokkeerd'])) {
    $sql .= " and geblokkeerd = 1 ";
}
//
$sql .= " GROUP BY voorwerpnummer, titel, veilingeinde, gebruiker, startprijs, geblokkeerd, veilingGesloten";
//
$stmt = $conn->prepare($sql);
//
$stmt->bindParam(':verkoper', $gebruikersnaam);
$stmt->execute();
echo "test";
?>

    <link rel="stylesheet" href="styles/css/mystyles.css">
    <link rel="stylesheet" href="styles/custom_styles.css">

    <body style="background-color: #f5f5f5">
    <br><br>
    <div class="columns" style="padding: 0rem 2rem">
        <div class="column is-9">
            <div class="card events-card">
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped">
                            <tbody>
                            <tr>
                                <th></th>
                                <th><abbr title="Voorwerpnummer">Nr.</abbr></th>
                                <th>Titel</th>
                                <th>Veilingeinde</th>
                                <th>Startprijs</th>
                                <th>Hoogste bod</th>
                                <th>Hoogste bieder</th>
                            </tr>
                            <?php
                            while ($row = $stmt->fetch()) {
                                $voorwerpnummer = $row['voorwerpnummer'];
                                $titel = $row['titel'];
                                $phpdate = strtotime($row['veilingeinde']);
                                $veilingeinde = date('d-m-Y H:i:s', $phpdate);
                                $startprijs = $row['startprijs'];
                                $hoogstebod = "€" . $row['hoogste bod'];
                                if ($hoogstebod == "€") {
                                    $hoogstebod = 'Geen biedingen';
                                }
                                $gebruiker = $row['gebruiker'];
                                $geblokkeerd = $row['geblokkeerd'];
                                $gesloten = $row['veilingGesloten'];

                                echo "<tr>";

                                if ($geblokkeerd == 1) {
                                    echo "<tr>
                                          <td width=\"5%\"><i class=\"fa fa-cube has-text-danger\"></i></td>";
                                } else if ($gesloten == 1) {
                                    echo "<tr>
                                          <td width=\"5%\"><i class=\"fa fa-cube\"></i></td>";
                                } else if ($gesloten == 0) {
                                    echo "<tr>
                                          <td width=\"5%\"><i class=\"fa fa-cube has-text-success\"></i></td>";
                                }

                                echo "
                                    <td>" . $voorwerpnummer . "</td>
                                    <td>" . $titel . "</td>
                                    <td>" . $veilingeinde . "</td>
                                    <td>€" . $startprijs . "</td>
                                    <td>" . $hoogstebod . "</td>
                                    <td>" . $gebruiker . "</td>
                                    </tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="columuns is-3">
            <div class="column">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Zoeken</p>
                    </header>
                    <form method="get" class="card-content">
                        <div class="content">
                            <label class="label" for="voorwerpnummer">Voorwerpnummer</label>
                            <div class="control has-icons-left">
                                <input class="input is-medium" type="number" id="voorwerpnummer" name="voorwerpnummer">
                                <span class="icon is-medium is-left">
                                <i class="fa fa-hashtag"></i>
                            </div>
                        </div>
                        <div class="content">
                            <div class="content">
                                <label class="label" for="titel">Titel</label>
                                <div class="control has-icons-left">
                                    <input class="input is-medium" type="text" id="titel" name="titel">
                                    <span class="icon is-medium is-left">
                                    <i class="fa fa-search"></i>
                                </div>
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
    </body>
<?php
include_once("../includes/footer.php");
?>