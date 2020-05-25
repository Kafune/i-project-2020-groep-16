<?php
include_once("includes/header.php");
include_once("includes/db.php");

if (isset($_GET['rubriek'])) {
    $rubrieknummer = $_GET['rubriek'];
    $page = $conn->prepare("SELECT * FROM voorwerp AS v
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
                        select *
                        from cte
                        INNER JOIN VoorwerpInRubriek as vr ON cte.rubrieknummer = vr.rubrieknummer
                        INNER JOIN Voorwerp as v ON vr.voorwerpnummer = v.voorwerpnummer
                        order by v.veilingbegin DESC;";
    $page = $conn->prepare($sql_alle_childs);
    $page->bindParam(':parent', $parent);
}else if (empty($_GET['searching'])) {
    $page = $conn->prepare("SELECT TOP 30 * FROM voorwerp ORDER BY veilingbegin DESC");
} else {
    $search = $_GET['searching'];
    $page = $conn->prepare("SELECT TOP 30 * FROM voorwerp WHERE titel LIKE '%" . $search . "%' ORDER BY veilingbegin DESC");
}
$page->execute();
$row = $page->fetchAll(PDO::FETCH_ASSOC);






/* print_r($_POST);
if($_POST){
    $search = $_POST['query'];
    $all_data = $conn->prepare("SELECT * FROM voorwerp WHERE titel LIKE '%$search%'");
    $all_data->execute();
    $row_data = $all_data->fetchAll(PDO::FETCH_ASSOC);
    //print_r($row_data);
    if($row_data)
}*/


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
                            <p class="card-footer-item">
                                    <span>
                                        <a href="">Bied</a>
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