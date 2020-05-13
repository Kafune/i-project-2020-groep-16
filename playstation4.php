<?php
include_once("includes/header.php");
include_once("includes/db.php");
$prod_id = $_GET['voorwerpnummer'];
$page_details= $conn->prepare("SELECT * FROM voorwerp WHERE voorwerpnummer ='".$prod_id."'");
$page_details->execute();
$row_details = $page_details->fetch(PDO::FETCH_ASSOC);

$page_photo= $conn->prepare("SELECT * FROM bestand WHERE voorwerpnummer ='".$row_details['voorwerpnummer']."'");
$page_photo->execute();
$row_image = $page_photo->fetch(PDO::FETCH_ASSOC);


$page_geb= $conn->prepare("SELECT * FROM bod WHERE Voorwerp ='".$row_details['voorwerpnummer']."'");
$page_geb->execute();
$row_geb = $page_geb->fetchAll(PDO::FETCH_ASSOC);
//print_r($row_geb);
?>

    <link rel="stylesheet" href="styles/css/mystyles.css">
    <link rel="stylesheet" href="styles/custom_styles.css">

    <body style="background-image: url('sources/background 1.gif');">
    <div class="container has-background-white containerExtraPadding">
        <div class="block">
            <nav class="breadcrumb" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Producten</a></li>
                    <li><a href="#">Computers en Software</a></li>
                    <li><a href="#">Consoles</a></li>
                    <li><a href="#">Playstation 4</a></li>
                    <li class="is-active"><a href="#" aria-current="page"><?php echo $row_details['titel'] ?></a></li>
                </ul>
            </nav>
            <div class="columns">
                <div class="column is-half">
                    <img src="<?php echo $row_image['filenaam'] ?>" alt="Placeholder" style="width:100%;" class="image">
                    <p><?php echo $row_details['gebruikersnaam'] ?></p>
                    <p><?php echo $row_details['plaatsnaam'] ?></p>
                    <br>
                    <p class="has-text-weight-bold">Betalingswijze</p>
                    <p><?php echo $row_details['betalingswijze'] ?></p>
                    <p class="has-text-weight-bold">Betalingsinstructies</p>
                    <p><?php echo $row_details['betalingsinstructie'] ?></p>
                    <br>
                    <p class="has-text-weight-bold">Startverkoop</p>
                    <p><?php echo $row_details['looptijdeindetijdstip'] ?></p>
                    <br>
                    <p class="has-text-weight-bold">Product ID</p>
                    <p><?php echo $row_details['voorwerpnummer'] ?></p>
                </div>
                <div class="column is-half">
                    <h1 class="title is-1"><?php echo $row_details['titel'] ?></h1>
                    <br>
                    <h2 class="subtitle is-4">Beschrijving</h2>
                    <p><?php echo $row_details['beschrijving'] ?></p>
                    <br>
                    <h2 class="subtitle is-4">Startprijs</h2>
                    <p>€<?php echo $row_details['startprijs'] ?></p>
                    <br>
                    <div class="box">
                        <h1 class="title has-text-weight-bold has-text-centered">Tijd over</h1>

                        <?php foreach($row_geb as $value){ ?>

                            <div class="columns">
                                <div class="column">
                                    <p><?php echo $value['gebruiker']?></p>
                                </div>
                                <div class="column has-text-centered">
                                    <p>€<?php echo $value['bodbedrag']?></p>
                                </div>
                                <div class="column has-text-right">
                                    <p><?php echo $value['bodtijdstip']?></p>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="field has-addons has-addons-centered">
                            <p class="control">
                                <input type="number" class="input" name="" id="" placeholder="€" required>
                            </p>
                            <p class="control">
                                <button type="submit" name="" class="button is-primary">Verzenden</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
<?php
include_once("includes/footer.php");
?>