<?php
include_once("../includes/header.php");
include_once("../includes/db.php");
include_once("../includes/functies.php");

$bodstatus = "";

if (empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}

$sql = "SELECT id, voorwerp, titel, startprijs, bodbedrag, bodtijdstip, gebruiker
        FROM Bod 
        INNER JOIN Voorwerp ON Bod.voorwerp = Voorwerp.voorwerpnummer
        WHERE gebruiker = :gebruiker";

$queryArray = array(
    ':gebruiker' => $_SESSION['gebruiker']
);

$resultaat = haalAlleGegevensArray($conn, $sql, $queryArray);

$sql2 = "SELECT TOP 2 voorwerp, bodbedrag, gebruiker FROM Bod WHERE voorwerp = :voorwerp ORDER BY bodbedrag DESC";

$queryArray2 = array(
        ':voorwerp' => $resultaat['voorwerp']
);

$resultaat2 = haalGegevensArray($conn, $sql2, $queryArray2);

if($resultaat2['gebruiker'] != $_SESSION['gebruiker']) {
    $bodstatus = "Overboden";
} else {
    $bodstatus = "Hoogste bieder";
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
            <table class="table has-background-primary has-text-white is-fullwidth">
                <thead>
                <tr>
                    <th class="has-text-white">Product</th>
                    <th class="has-text-white">Datum</th>
                    <th class="has-text-white">Startprijs</th>
                    <th class="has-text-white">Bodbedrag</th>
                    <th class="has-text-white">Verkoper</th>
                    <th class="has-text-white">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($resultaat as $waarde) :
                ?>
                <tr>
                    <td><a href="/voorwerp.php?voorwerpnummer=<?=$waarde['voorwerp']?>"><?=$waarde['titel']?></a></td>
                    <td><?=date('d-m-Y', strtotime($waarde['bodtijdstip']))?></td>
                    <td><?=$waarde['startprijs']?></td>
                    <td><?=$waarde['bodbedrag']?></td>
                    <td><?=$waarde['gebruiker']?></td>
                    <td><?=$bodstatus?></td>
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