<?php
include_once("../includes/header.php");
include_once("../includes/db.php");
include_once("../includes/functies.php");

if (empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}

$sql = "SELECT id, voorwerp, titel, startprijs, bodbedrag, bodtijdstip, gebruiker
        FROM Bod 
        INNER JOIN Voorwerp ON Bod.voorwerp = Voorwerp.voorwerpnummer
        WHERE gebruiker = :gebruiker
        ORDER BY bodtijdstip DESC";

$queryArray = array(
    ':gebruiker' => $_SESSION['gebruiker']
);

$resultaat = haalAlleGegevensArray($conn, $sql, $queryArray);

//Check of de huidige ingelogde gebruiker de hoogste bieder is.
$bodstatusItem = array();
foreach ($resultaat as $waarde) {
    $sql2 = "SELECT TOP 1 gebruiker, voorwerp, bodbedrag FROM Bod WHERE voorwerp = :voorwerp ORDER BY bodbedrag DESC";

    $queryArray2 = array(
        ':voorwerp' => $waarde['voorwerp'],
    );

    $resultaat2 = haalGegevensArray($conn, $sql2, $queryArray2);

    var_dump($resultaat2['gebruiker']);

    if ($resultaat2['gebruiker'] !== $_SESSION['gebruiker']) {
//        $bodstatus = "Overboden";
        array_push($bodstatusItem, "Overboden");
    } else {
//        $bodstatus = "Hoogste bieder";
        array_push($bodstatusItem, "Hoogste bieder");
    }
}


//Zoekveld op naam
if (isset($_GET['verzenden'])) {
    $zoekquery = "SELECT id, voorwerp, titel, startprijs, bodbedrag, bodtijdstip, gebruiker
                FROM Bod 
                INNER JOIN Voorwerp ON Bod.voorwerp = Voorwerp.voorwerpnummer
                WHERE gebruiker = :gebruiker AND titel LIKE CONCAT('%', :zoekopdracht, '%')";

    $zoekQueryArray = array(
        ':gebruiker' => $_SESSION['gebruiker'],
        ':zoekopdracht' => $_GET['searching']
    );

    $resultaat = haalAlleGegevensArray($conn, $zoekquery, $zoekQueryArray);
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
                                <input type="text" class="input" name="searching" id="" placeholder="Voorwerp zoeken"
                                       required>
                            </p>
                            <p class="control">
                                <input type="submit" name="verzenden" value="Zoeken" class="button is-primary">
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table has-background-primary has-text-white is-fullwidth">
                <thead>
                <tr>
                    <th class="has-text-white">Product</th>
                    <th class="has-text-white">Datum & tijdstip</th>
                    <th class="has-text-white">Startprijs</th>
                    <th class="has-text-white">Bodbedrag</th>
                    <th class="has-text-white">Verkoper</th>
                    <th class="has-text-white">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($resultaat as $key => $waarde) :
                    ?>
                    <tr>
                        <td>
                            <a href="/voorwerp.php?voorwerpnummer=<?= $waarde['voorwerp'] ?>"><?= $waarde['titel'] ?></a>
                        </td>
                        <td><?= date('d-m-Y', strtotime($waarde['bodtijdstip'])) ?> <?=date('H:i', strtotime($waarde['bodtijdstip']))?></td>
                        <td><?= $waarde['startprijs'] ?></td>
                        <td><?= $waarde['bodbedrag'] ?></td>
                        <td><?= $waarde['gebruiker'] ?></td>
                        <td><?= $bodstatusItem[$key] ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
                </tbody>
            </table>

        </div>
    </div>

<?php
include_once("../includes/footer.php");