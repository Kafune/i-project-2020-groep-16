<?php
include_once("includes/header.php");
include_once("includes/db.php");
include_once("includes/functies.php");

$textlimiet = 100;
$textbreedte = 45;

if (isset($_GET['rubriek'])) {
    $rubrieknummer = $_GET['rubriek'];
    $page = $conn->prepare("SELECT TOP 60 * FROM voorwerp AS v
    LEFT JOIN VoorwerpInRubriek AS r 
    ON v.voorwerpnummer = r.voorwerpnummer
    WHERE v.veilingGesloten = 0 AND (v.geblokkeerd = 0 OR v.geblokkeerd is NULL) AND r.rubrieknummer =" . $rubrieknummer . "");
} else if (isset($_GET['parent'])) {
    $parent = $_GET['parent'];
    $sql_alle_childs = "declare @parent int = :parent ;
                        ;with cte 
                        as (select r.rubrieknummer, r.rubrieknaam
                            from Rubriek as r 
                            where rubrieknummer = @parent
                            UNION ALL
                            select r.rubrieknummer, r.rubrieknaam
                            from Rubriek as r 
                            join cte 
                            on r.rubriek = cte.rubrieknummer)
                        select TOP 30 *
                        from cte
                        INNER JOIN VoorwerpInRubriek as vr ON cte.rubrieknummer = vr.rubrieknummer
                        INNER JOIN Voorwerp as v ON vr.voorwerpnummer = v.voorwerpnummer
                        WHERE v.veilingGesloten = 0 AND (v.geblokkeerd = 0 OR v.geblokkeerd is NULL)
                        ORDER BY v.veilingbegin DESC;";
    $page = $conn->prepare($sql_alle_childs);
    $page->bindParam(':parent', $parent);
} else if (empty($_GET['zoek'])) {
    $page = $conn->prepare("SELECT TOP 60 * FROM voorwerp WHERE veilingGesloten = 0 AND (geblokkeerd = 0 OR geblokkeerd is NULL) ORDER BY veilingbegin DESC");
} else {
    $search = $_GET['zoek'];
    $page = $conn->prepare("SELECT TOP 60 * FROM voorwerp WHERE titel LIKE '%" . $search . "%' AND veilingGesloten = 0 AND (geblokkeerd = 0 OR geblokkeerd is NULL) ORDER BY veilingbegin DESC");
}

$page->execute();
$row = $page->fetchAll(PDO::FETCH_ASSOC);

//kijk of er op een knop geklikt is
if (isset($_GET['filter'])) {
    //kijk daarna of er een veld ingevuld is, omdat er geen verplichte velden zijn
    if (!empty($_GET['zoek']) || !empty($_GET['country']) || !empty($_GET['city']) || !empty($_GET['min'] || !empty($_GET['max']))) {
//if(count(array_filter($_GET)) != count($_GET)) {

        $q = "SELECT TOP 60 * FROM voorwerp";
        $gevuldeVelden = array();
        $queryArray = array();

        if (!empty($_GET['zoek'])) {
            $gevuldeVelden[] = "titel LIKE CONCAT('%', :titel, '%')";
            $queryArray[':titel'] = $_GET['zoek'];
        }

        if (!empty($_GET['country'])) {
            $gevuldeVelden[] = "land LIKE CONCAT('%', :land, '%')";
            $queryArray[':land'] = $_GET['country'];
        }

        if (!empty($_GET['city'])) {
            $gevuldeVelden[] = "plaatsnaam LIKE CONCAT('%', :plaatsnaam, '%')";
            $queryArray[':plaatsnaam'] = $_GET['city'];
        }

        if (!empty($_GET['min']) && !empty($_GET['max'])) {
            $gevuldeVelden[] = "startprijs BETWEEN :minprijs AND :maxprijs";
            $queryArray[':minprijs'] = $_GET['min'];
            $queryArray[':maxprijs'] = $_GET['max'];
        } else if (!empty($_GET['min'])) {
            $gevuldeVelden[] = "startprijs >= :minprijs";
            $queryArray[':minprijs'] = $_GET['min'];
        } else if (!empty($_GET['max'])) {
            $gevuldeVelden[] = "startprijs <= :maxprijs";
            $queryArray[':maxprijs'] = $_GET['max'];
        }

        //zoek naar alle veilingen die open staan.
        $gevuldeVelden[] = "veilinggesloten=0";

        if (count($gevuldeVelden) > 0) {
            $q .= " WHERE " . implode(' AND ', $gevuldeVelden);
        }
        $q .= " ORDER BY veilingbegin DESC";


        $row = haalAlleGegevensArray($conn, $q, $queryArray);
        //print_r($row);
    } else {
        $_SESSION['error'] = "errorLeegZoekOpdracht";
        header('location: index.php');
    }
}


?>
<body>
<div class="block">
    <section class="hero is-primary"> <!-- repeat staat aan & het is niet mooi responsive -->
        <div class="hero-body" style="background-image: url('sources/background 2.png'); background-size: contain;">
            <div class="container has-text-centered">
                <h1 class="title has-text-weight-bold">EENMAAL ANDERMAAL</h1>
                <h2 class="subtitle has-text-weight-bold">De veiling website van Nederland</h2>
            </div>
            <br><br><br>
            <form method="GET" action="index.php">
                <div class="field has-addons has-addons-centered">
                    <p class="control">
                        <input type="text" class="input" name="zoek" id="" placeholder="Veiling zoeken" required>

                    </p>
                    <p class="control">
                        <input type="submit" class="button is-black" value="Zoeken" name="Zoeken"></input>
                    </p>
                </div>
            </form>
            <br>
            <form method="GET">
                <br>
                <div class="field has-addons has-addons-centered">
                    <p class="control">
                        <input type="text" class="input" name="country" id="" placeholder="Land">
                    </p>
                    <input type="hidden" name="filter" value="filter">
                    <p class="control">
                        <input type="text" class="input" name="city" id="" placeholder="Plaatsnaam">
                    </p>
                    <p class="control" style="width:110px">
                        <input type="number" class="input" name="min" id="" placeholder="Min Prijs">
                    </p>
                    <p class="control" style="width:110px">
                        <input type="number" class="input" name="max" id="" placeholder="Max Prijs">
                    </p>
                </div>
            </form>
            <br>
        </div>
    </section>
</div>


<div class="container">
    <div class="block">
        <div class="columns is-multiline">

            <?php
            foreach ($row as $value) :

                $page_photo = $conn->prepare("SELECT * FROM bestand WHERE voorwerpnummer ='" . $value['voorwerpnummer'] . "'");
                $page_photo->execute();
                $row_image = $page_photo->fetch(PDO::FETCH_ASSOC);

                ?>
                <div class="column is-one-third">
                    <div class="card" style="min-height:460px">
                        <div class="card-image">
                            <figure class="image is-3by2">
                                <img src="<?php echo 'upload/' . $row_image['filenaam']; ?>" alt="Voorwerp afbeelding"
                                     class="voorwerp-afbeelding">
                            </figure>
                        </div>
                        <div class="card-content">
                            <p class="title is-6">
                                <?php echo $value['titel'] ?>
                                <span class="tag is-black"> <?php echo $value['plaatsnaam'] ?></span>
                            </p>
                            <p class="">
                                <?php
                                // zorg dat er een line-break plaatsvindt bij een aantal karakters.
                                if(strlen($value['beschrijving']) > $textlimiet) {
                                    echo wordwrap(substr($value['beschrijving'], 0, $textlimiet), $textbreedte, "<br>", true);
                                } else {
                                    echo $value['beschrijving'];
                                }
                                ?>
                            </p>
                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                    <span>
                                        <a href="voorwerp.php?voorwerpnummer=<?php echo $value['voorwerpnummer'] ?>"
                                           class="">Details</a>
                                    </span>
                            </p>
                            <p class="card-footer-item has-background-primary has-text-white">
                                    <span>
                                        €<?php echo $value['startprijs'] ?>,-
                                    </span>
                            </p>
                        </footer>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<br>
</body>
<?php
include_once("includes/footer.php");
?>

<script>


</script>