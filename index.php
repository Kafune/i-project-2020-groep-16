<?php
include_once("includes/header.php");
include_once("includes/db.php");

if (isset($_GET['rubriek'])) {
    $rubrieknummer = $_GET['rubriek'];
    $page = $conn->prepare("SELECT TOP 60 * FROM voorwerp AS v
    LEFT JOIN VoorwerpInRubriek AS r 
    ON v.voorwerpnummer = r.voorwerpnummer
    WHERE r.rubrieknummer =" . $rubrieknummer . "");
} else if(isset($_GET['parent'])){
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
                        order by v.veilingbegin DESC;";
    $page = $conn->prepare($sql_alle_childs);
    $page->bindParam(':parent', $parent);
}else if (empty($_GET['searching'])) {
    $page = $conn->prepare("SELECT TOP 60 * FROM voorwerp ORDER BY veilingbegin DESC");
} else {
    $search = $_GET['searching'];
    $page = $conn->prepare("SELECT TOP 60 * FROM voorwerp WHERE titel LIKE '%" . $search . "%' ORDER BY veilingbegin DESC");
}

$page->execute();
$row = $page->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['filter'])){
    //print_r($_GET);
    $q = '';
    if($_GET['max'] != '' && $_GET['min'] != '' && $_GET['country'] == '' && $_GET['city'] == ''){
        $q = "SELECT TOP 60 * FROM voorwerp WHERE startprijs BETWEEN ".$_GET['min']." AND ".$_GET['max'];
    }elseif ($_GET['country'] != '' && $_GET['city'] != '' && $_GET['max'] == '' && $_GET['min'] == '') {
        $q = "SELECT TOP 60 * FROM voorwerp WHERE plaatsnaam LIKE '%".$_GET['city']."%' AND land LIKE '%".$_GET['country']."%'";
    }elseif ($_GET['city'] != '') {
        $q = "SELECT TOP 60 * FROM voorwerp WHERE plaatsnaam LIKE '%".$_GET['city']."%'";
    }elseif ($_GET['country'] != '') {
        $q = "SELECT TOP 60 * FROM voorwerp WHERE land LIKE '%".$_GET['country']."%'";
    }elseif ($_GET['max'] != '') {
        $q = "SELECT TOP 60 * FROM voorwerp WHERE startprijs BETWEEN 0 AND ".$_GET['max'];
    }elseif ($_GET['min'] != '') {
        $q = "SELECT TOP 60 * FROM voorwerp WHERE startprijs > ".$_GET['min'];
    }elseif ($_GET['country'] != '' && $_GET['min'] != '') {
        $q = "SELECT TOP 60 * FROM voorwerp WHERE land LIKE '%".$_GET['country']."%' AND startprijs > ".$_GET['min'];
    }elseif($_GET['city'] != '' && $_GET['min'] != ''){
        $q = "SELECT TOP 60 * FROM voorwerp WHERE plaatsnaam LIKE '%".$_GET['city']."%' AND startprijs > ".$_GET['min'];
    }elseif($_GET['country'] != '' && $_GET['max'] != ''){
        $q = "SELECT TOP 60 * FROM voorwerp WHERE land LIKE '%".$_GET['country']."%' AND  startprijs BETWEEN 0 AND ".$_GET['max'];
    }elseif($_GET['city'] != '' && $_GET['max'] != ''){
        $q = "SELECT TOP 60 * FROM voorwerp WHERE plaatsnaam LIKE '%".$_GET['city']."%' AND  startprijs BETWEEN 0 AND ".$_GET['max'];
    }elseif($_GET['max'] != '' && $_GET['min'] != '' && $_GET['country'] != '' && $_GET['city'] != ''){
        $q = "SELECT TOP 60 * FROM voorwerp WHERE plaatsnaam LIKE '%".$_GET['city']."%' AND land LIKE '%".$_GET['country']."%' AND  startprijs BETWEEN ".$_GET['min']." AND ".$_GET['max'];
    }elseif($_GET['max'] != '' && $_GET['min'] != ''){
        $q = "SELECT TOP 60 * FROM voorwerp WHERE startprijs BETWEEN ".$_GET['min']." AND ".$_GET['max'];
    }
    $q .= "ORDER BY veilingbegin DESC";
    $page = $conn->prepare($q);
    $page->execute();
    $row = $page->fetchAll(PDO::FETCH_ASSOC);
    //print_r($row);

}


?>
<link rel="stylesheet" href="styles/css/mystyles.css">
<link rel="stylesheet" href="styles/custom_styles.css">

<body>
<div class="block">
    <section class="hero is-primary"> <!-- repeat staat aan & het is niet mooi responsive -->
        <div class="hero-body" style="background-image: url('sources/background 2.png'); background-size: contain;">
            <div class="container has-text-centered">
                <h1 class="title has-text-weight-bold">EENMAAL ANDERMAAL</h1>
                <h2 class="subtitle has-text-weight-bold">De veiling website van Nederland</h2>
            </div>
            <br><br><br>
            <form method="GET" action="">
                <div class="field has-addons has-addons-centered">
                    <p class="control">
                        <input type="text" class="input" name="searching" id="" placeholder="Veiling zoeken" required>
                    </p>
                    <p class="control">
                        <button type="submit" class="button is-black">Zoek</button>
                    </p>
                </div>
            </form>
            <br>
            <form method="GET" action="">
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

                    <p class="control">
                        <button type="submit" class="button is-black">Filter</button>
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
            foreach ($row as $value) {

                $page_photo = $conn->prepare("SELECT * FROM bestand WHERE voorwerpnummer ='" . $value['voorwerpnummer'] . "'");
                $page_photo->execute();
                $row_image = $page_photo->fetch(PDO::FETCH_ASSOC);

                ?>
                <div class="column is-one-third">
                    <div class="card" style="min-height:460px">
                        <div class="card-image">
                            <figure class="image is-3by2">
                                <img src="<?php echo 'upload/' . $row_image['filenaam']; ?>" alt="Placeholder">
                            </figure>
                        </div>
                        <div class="card-content">
                            <p class="title is-6">
                                <?php echo $value['titel'] ?>
                                <span class="tag is-black"> <?php echo $value['plaatsnaam'] ?></span>
                            </p>
                            <p class="">
                                <?php echo $value['beschrijving'] ?>
                            </p>
                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                    <span>
                                        <a href="playstation4.php?voorwerpnummer=<?php echo $value['voorwerpnummer'] ?>"
                                           class="">Details</a>
                                    </span>
                            </p>
                            <p class="card-footer-item has-background-primary has-text-white">
                                    <span>
                                        €<?php echo $value['startprijs']?>,-
                                    </span>
                            </p>
                        </footer>
                    </div>
                </div>
            <?php } ?>

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