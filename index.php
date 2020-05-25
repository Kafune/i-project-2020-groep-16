<?php
include_once("includes/header.php");
include_once("includes/db.php");

if(empty($_GET['searching'])){
    $page = $conn->prepare("SELECT TOP 30 * FROM voorwerp ORDER BY veilingbegin DESC");

}
else{
    $search = $_GET['searching'];
    $page = $conn->prepare("SELECT TOP 30 * FROM voorwerp WHERE titel LIKE '%".$search."%' ORDER BY veilingbegin DESC");
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

if(isset($_GET['filter'])){
    //print_r($_GET);
    $q = '';
    if($_GET['max'] != '' && $_GET['min'] != '' && $_GET['country'] == '' && $_GET['city'] == ''){
        $q = "SELECT * FROM voorwerp WHERE startprijs BETWEEN ".$_GET['min']." AND ".$_GET['max'];
    }elseif ($_GET['country'] != '' && $_GET['city'] != '' && $_GET['max'] == '' && $_GET['min'] == '') {
        $q = "SELECT * FROM voorwerp WHERE plaatsnaam LIKE '%".$_GET['city']."%' AND land LIKE '%".$_GET['country']."%'";
    }elseif ($_GET['city'] != '') {
        $q = "SELECT * FROM voorwerp WHERE plaatsnaam LIKE '%".$_GET['city']."%'";
    }elseif ($_GET['country'] != '') {
        $q = "SELECT * FROM voorwerp WHERE land LIKE '%".$_GET['country']."%'";
    }elseif ($_GET['max'] != '') {
        $q = "SELECT * FROM voorwerp WHERE startprijs BETWEEN 0 AND ".$_GET['max'];
    }elseif ($_GET['min'] != '') {
        $q = "SELECT * FROM voorwerp WHERE startprijs > ".$_GET['min'];
    }elseif ($_GET['country'] != '' && $_GET['min'] != '') {
        $q = "SELECT * FROM voorwerp WHERE land LIKE '%".$_GET['country']."%' AND startprijs > ".$_GET['min'];
    }elseif($_GET['city'] != '' && $_GET['min'] != ''){
        $q = "SELECT * FROM voorwerp WHERE plaatsnaam LIKE '%".$_GET['city']."%' AND startprijs > ".$_GET['min'];
    }elseif($_GET['country'] != '' && $_GET['max'] != ''){
        $q = "SELECT * FROM voorwerp WHERE land LIKE '%".$_GET['country']."%' AND  startprijs BETWEEN 0 AND ".$_GET['max'];
    }elseif($_GET['city'] != '' && $_GET['max'] != ''){
        $q = "SELECT * FROM voorwerp WHERE plaatsnaam LIKE '%".$_GET['city']."%' AND  startprijs BETWEEN 0 AND ".$_GET['max'];
    }elseif($_GET['max'] != '' && $_GET['min'] != '' && $_GET['country'] != '' && $_GET['city'] != ''){
        $q = "SELECT * FROM voorwerp WHERE plaatsnaam LIKE '%".$_GET['city']."%' AND land LIKE '%".$_GET['country']."%' AND  startprijs BETWEEN ".$_GET['min']." AND ".$_GET['max'];
    }elseif($_GET['max'] != '' && $_GET['min'] != ''){
        $q = "SELECT * FROM voorwerp WHERE startprijs BETWEEN ".$_GET['min']." AND ".$_GET['max'];
    }

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
            foreach($row as $value){

                $page_photo= $conn->prepare("SELECT * FROM bestand WHERE voorwerpnummer ='".$value['voorwerpnummer']."'");
                $page_photo->execute();
                $row_image = $page_photo->fetch(PDO::FETCH_ASSOC);

                ?>
                <div class="column is-one-third" >
                    <div class="card" style="min-height:460px">
                        <div class="card-image">
                            <figure class="image is-3by2">
                                <img src="<?php echo 'upload/'.$row_image['filenaam']; ?>" alt="Placeholder">
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
                                        <a href="playstation4.php?voorwerpnummer=<?php echo $value['voorwerpnummer'] ?>" class="">Details</a>
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