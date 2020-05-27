<?php
//includes
include_once("includes/header.php");
include_once("includes/db.php");


//verbinding met local db
$gebruiker = "iproject16";
$wachtwoord = "zv1VeSWK";

try {
    $conn = new PDO('sqlsrv:server=localhost;database=EenmaalAndermaalTestMilan', $gebruiker, $wachtwoord);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Er is iets fout<br>{$e->getMessage()}";
}


////als gebruiker niet is ingelogd wordt hij/zij gestuurd naar login pagina
//if(empty($_SESSION['gebruiker'])) { #werkt dit?
//    header("Location: login.php");
//}
//check of gebruiker is ingelogd
if (isset($_SESSION['gebruiker'])) {
//maakt variabel 'gebruikersnaam aan' met als input de huidige gebruiker
    $gebruikersnaam = $_SESSION['gebruiker'];
}


//als de GET van zoekbalk leeg is worden alle voorwerpen laten zien
if(empty($_GET['searching'])){
    $page = $conn->prepare("SELECT * FROM voorwerp WHERE koper ='".$value['gebruikersnaam']."' OR verkoper ='".$value['gebruikersnaam']."'");

}
//als de GET van zoekbalk gevuld is worden alle voorwerpen laten zien die de zoekopdracht ergens in de inhoud heeft zitten
else{
    $search = $_GET['searching'];
    $page = $conn->prepare("SELECT * FROM voorwerp WHERE titel LIKE '%".$search."%' AND (koper ='".$value['gebruikersnaam']."' OR verkoper ='".$value['gebruikersnaam']."')");
}


$page->execute();
$row = $page->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="styles/css/mystyles.css">
<link rel="stylesheet" href="styles/custom_styles.css">

<body style="background-color: #f5f5f5">
    <br><br>
    <div class="container">

        <nav class="level">
            <div class="level-left">
                <div type="" name="" id="" class="button is-primary">Nieuw voorwerp ter verkoop aanbieden</div>
            </div>
            <div class="level-right">
                <form method="GET" action="">
                    <div class="field has-addons has-addons-right">
                        <p class="control">
                            <input type="text" class="input" name="searching" id="" placeholder="Veiling zoeken" required>
                        </p>
                        <p class="control">
                            <button type="submit" class="button is-primary">Zoek</button>
                        </p>
                    </div>
                </form>
            </div>
        </nav>

        <div class="block">
            <div class="box">
                <h1 class="title">Openstaande biedingen</h1>
                <p>Hier staan al uw openstaande biedingen.
                    Heeft een gebruiker meer geboden dan uw laatste bod?
                    Dan kunt u hier een nieuw bod uitbrengen.
                </p>
                <hr>
                <div class="columns is-multiline">
                    <?php foreach($row as $value){

                        ?>
                    <div class="column is-one-third" >
                        <div class="card" style="min-height:0px">
                            <div class="card-content">
                                <p class="title is-5 has-text-weight-bold">
                                    <?php echo $value['titel'] ?>
                                </p>
                                <p>Uw laatste bod: <?php echo $value[''] ?></p> <!--?-->
                                <br>
                                <div class="columns is-multiline"> <!--dit moet hetzelfde zijn als de biedlijst in playstaytion4.php/voorwerp.php-->
                                    <div class="column">
                                        <p class="has-text-weight-bold">Gebruiker</p>
                                        <p>test1</p> <!--name-->
                                    </div>
                                    <div class="column has-text-centered">
                                        <p class="has-text-weight-bold">Bod</p>
                                        <p>€test2</p> <!--table data-->
                                    </div>
                                    <div class="column has-text-right">
                                        <p class="has-text-weight-bold">Datum/Tijd</p>
                                        <p>test3</p> <!--auction-end-->
                                    </div>
<!--                                    <div id="auction_end"></div>-->
<!--                                    <div id="name"></div>-->
<!--                                    <div id="tableData" style="padding:20px;">-->
                                </div>


                                <div class="field has-addons has-addons-centered"> <!--dit moet hetzelfde zijn als de bied-submit in playstaytion4.php/voorwerp.php-->
                                    <p class="control">
                                        <input type="number" class="input" name="" id="" placeholder="€" required>
                                    </p>
                                    <p class="control">
                                        <button type="submit" name="" class="button is-primary">Bieden</button>
                                    </p>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                            <?php header("Location: $value['voorwerpid'].php"); ?> <!--voorwerpid bestaat niet-->
                                        </span>
                                </p>
                            </footer>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="box">
                <h1 class="title">Uw veilingen</h1>
                <p>Hier staan al uw openstaande veilingen.
                </p>
                <hr>
                <div class="columns is-multiline">
                    <?php foreach($row as $value){

                        ?>
                    <div class="column is-one-third" >
                        <div class="card" style="min-height:0px">

                            <div class="card-content">
                                <p class="title is-5 has-text-weight-bold">
                                    <?php echo $value['titel'] ?>
                                </p>
                                <p>Hoogste bod:<?php echo $value[''] ?></p> <!--?-->
                                <br>
                                <div class="columns is-multiline"> <!--dit moet hetzelfde zijn als de biedlijst in playstaytion4.php/voorwerp.php-->
                                    <div class="column">
                                        <p class="has-text-weight-bold">Gebruiker</p>
                                        <p>test1</p> <!--name-->
                                    </div>
                                    <div class="column has-text-centered">
                                        <p class="has-text-weight-bold">Bod</p>
                                        <p>€test2</p> <!--table data-->
                                    </div>
                                    <div class="column has-text-right">
                                        <p class="has-text-weight-bold">Datum/Tijd</p>
                                        <p>test3</p> <!--auction-end-->
                                    </div>
<!--                                    <div id="auction_end"></div>-->
<!--                                    <div id="name"></div>-->
<!--                                    <div id="tableData" style="padding:20px;">-->
                                </div>



                            </div>
                            <footer class="card-footer">
                                <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                            <?php header("Location: $value['voorwerpid'].php"); ?> <!--voorwerpid bestaat niet-->
                                        </span>
                                </p>
                            </footer>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
</body>
<?php
include_once("includes/footer.php");
?>