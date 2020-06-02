<?php
include_once("../includes/header.php");
include_once("../includes/db.php");
include_once("../includes/functies.php");

if (empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}

$sql = "SELECT voorwerp, titel, startprijs, max(bodbedrag) AS bodbedrag, max(bodtijdstip) AS bodtijdstip, gebruiker, verkoper
        FROM Bod
        INNER JOIN Voorwerp ON Bod.voorwerp = Voorwerp.voorwerpnummer";
$sql .= " WHERE gebruiker = :gebruiker";
$sql .= " AND";
if(isset($_GET['archief'])) {
    $sql .= " veilinggesloten = 1";
} else {
    $sql .= " veilinggesloten = 0";
}

$sql .= " GROUP BY voorwerp, titel, gebruiker, startprijs, verkoper";
$sql .= " ORDER BY bodtijdstip DESC";

$queryArray = array(
    ':gebruiker' => $_SESSION['gebruiker']
);

$resultaat = haalAlleGegevensArray($conn, $sql, $queryArray);

//Check of de huidige ingelogde gebruiker de hoogste bieder is.
$bodstatusItem = array();
$bodstatusBedrag = array();

foreach ($resultaat as $waarde) {
    $sql2 = "SELECT TOP 1 gebruiker, voorwerp, bodbedrag FROM Bod WHERE voorwerp = :voorwerp ORDER BY bodbedrag DESC";

    $queryArray2 = array(
        ':voorwerp' => $waarde['voorwerp'],
    );
    $stmt = $conn->prepare($sql2);
    $stmt->execute($queryArray2);


    $resultaat2 = $stmt->fetch();

    if ($resultaat2['gebruiker'] !== $_SESSION['gebruiker']) {
        array_push($bodstatusItem, "Overboden");
    } else {
        array_push($bodstatusItem, "Hoogste bieder");
    }
    array_push($bodstatusBedrag, $resultaat2['bodbedrag']);
}


//Zoekveld op naam
if (isset($_GET['verzenden'])) {
    $zoekquery = "SELECT voorwerp, titel, startprijs, max(bodbedrag) AS bodbedrag, max(bodtijdstip) AS bodtijdstip, gebruiker
                FROM Bod 
                INNER JOIN Voorwerp ON Bod.voorwerp = Voorwerp.voorwerpnummer
                WHERE gebruiker = :gebruiker AND titel LIKE CONCAT('%', :zoekopdracht, '%')
                GROUP BY voorwerp, titel, gebruiker, startprijs
                ORDER BY bodtijdstip DESC";

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
                <div class="column is-2">
                    <?php
                    if (isset($_GET['verzenden'])||isset($_GET['archief'])):
                        ?>
                        <a href="/profiel/veilingoverzicht.php" class="button is-primary"><- Terug</a>
                    <?php
                    else :
                        ?>
                        <a href="/profiel/gebruikersprofiel.php" class="button is-primary"><- Terug</a>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="column is-2">
                    <form method="GET">
                        <input type="submit" name="archief" value="Gesloten Veilingen" class="button is-primary">
                    </form>
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
            <div class="tablewrapper">
            <table class="table has-background-primary has-text-white is-fullwidth">
                <thead>
                <tr>
                    <th class="has-text-white">Product</th>
                    <th class="has-text-white">Datum & tijdstip</th>
                    <th class="has-text-white">Startprijs</th>
                    <th class="has-text-white">Bodbedrag</th>
                    <th class="has-text-white">Hoogste bod</th>
                    <th class="has-text-white">Status</th>
                    <th class="has-text-white">Verkoper</th>
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
                        <td><?= date('d-m-Y', strtotime($waarde['bodtijdstip'])) ?> <?= date('H:i', strtotime($waarde['bodtijdstip'])) ?></td>
                        <td>€<?= $waarde['startprijs'] ?>,-</td>
                        <td>€<?= $waarde['bodbedrag'] ?>,-</td>
                        <td>€<?= $bodstatusBedrag[$key]?>,-</td>
                        <td><?= $bodstatusItem[$key] ?></td>
                        <td><?= $waarde['verkoper'] ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

<?php
include_once("../includes/footer.php");