<?php

include_once("includes/header.php");
include_once("includes/db.php");
include_once("includes/meldingen.php");

$prod_id = $_GET['voorwerpnummer'];
$page_details = $conn->prepare("SELECT * FROM voorwerp WHERE voorwerpnummer ='" . $prod_id . "'");
$page_details->execute();
$row_details = $page_details->fetch(PDO::FETCH_ASSOC);

$page_photo = $conn->prepare("SELECT * FROM Bestand WHERE voorwerpnummer ='" . $row_details['voorwerpnummer'] . "'");
$page_photo->execute();
$row_image = $page_photo->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['status'])) {
    if ($_GET['status'] == 0) {
        echo "<script>alert('Je kan niet bieden totdat iemand anders geboden heeft.');</script>";
    }
}

?>

<link rel="stylesheet" href="styles/css/mystyles.css">
<link rel="stylesheet" href="styles/custom_styles.css">
<style>
    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #table td, #table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #table tr:hover {
        background-color: #ddd;
    }

    #table #high {
        background-color: #4CAF50;
        color: white;
    }

    #table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<body style="background-image: url('sources/background 1.gif');">
<div class="container has-background-white containerExtraPadding">
    <div class="block">
        <nav class="breadcrumb" aria-label="breadcrumb">
            <ul>
                <?php
                $voorwerpnummer = $_GET['voorwerpnummer'];

                $sql_rubriek = "SELECT rubrieknummer FROM VoorwerpInRubriek WHERE voorwerpnummer = " . $voorwerpnummer . "";

                $rubriek_result = $conn->prepare($sql_rubriek);
                $rubriek_result->execute();

                $result = $rubriek_result->fetch();
                $id = $result['rubrieknummer'];


                while ($id > 0) {
                    $sql_breadcrumb = "SELECT * FROM Rubriek WHERE rubrieknummer = :id";

                    $breadcrumb_result = $conn->prepare($sql_breadcrumb);
                    $breadcrumb_result->bindParam(':id', $id);

                    $breadcrumb_result->execute();

                    $resultaten = $breadcrumb_result->fetch(PDO::FETCH_ASSOC);

                    $namen[] = $resultaten['rubrieknaam'];
                    $nummer[] = $resultaten['rubrieknummer'];

                    $id = $resultaten['rubriek'];

                }
                echo "<li><a href='/rubriekenboom.php?'>Rubrieken</a></li>";
                $reversed_namen = array_reverse($namen);
                $reversed_nummer = array_reverse($nummer);

                for ($i = 0; $i < count($reversed_namen); $i++) {
                    echo "<li><a href='/index.php?parent=" . $reversed_nummer[$i] . "'>" . $reversed_namen[$i] . "</a></li>";
                }
                ?>
            </ul>
        </nav>
        <div class="columns">
            <div class="column is-half">
                <img src="<?php echo 'upload/' . $row_image['filenaam'] ?>" alt="Placeholder" style="width:100%; max-height:500px ;object-fit: contain"
                     class="image">
                <p><?php echo $row_details['plaatsnaam'] ?></p>
                <br>
                <p class="has-text-weight-bold">Verkoper</p>
                <a href="/verkoper/verkoperpagina.php?verkoper=<?= $row_details['verkoper'] ?>"><?php echo $row_details['verkoper'] ?></a>
                <p class="has-text-weight-bold">Betalingswijze</p>
                <p><?php echo $row_details['betalingswijze'] ?></p>
                <p class="has-text-weight-bold">Betalingsinstructies</p>
                <p><?php echo $row_details['betalingsinstructie'] ?></p>
                <br>
                <p class="has-text-weight-bold">Startverkoop</p>
                <p><?php $phpdate = strtotime($row_details['veilingbegin']);
                    $sqldate = date('d-m-Y H:i:s', $phpdate);
                    echo $sqldate ?></p>
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
                    <h1 id="countdown" style="padding: 1rem"
                        class="title has-text-weight-bold has-text-centered has-background-primary has-text-white"></h1>
                    <div class="card events-card">
                        <div class="card-table">
                            <div class="content">
                                <table class="table is-fullwidth is-striped">
                                    <tbody>
                                    <?php

                                    $sql = "SELECT * FROM Bod where voorwerp = :voorwerp ORDER BY bodbedrag DESC";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam('voorwerp', $row_details['voorwerpnummer']);
                                    $stmt->execute();

                                    while ($row = $stmt->fetch()) {
                                        $bieder = $row['gebruiker'];
                                        $bodbedrag = $row['bodbedrag'];
                                        $tijdstip = date('H:i:s', strtotime($row['bodtijdstip']));
                                        $dag = date('d-m-Y', strtotime($row['bodtijdstip']));

                                        echo "
                                            <tr>
                                            <td width=\"5%\"><i class=\"fa fa-user\"></i></td>
                                            <td>" . $bieder . "</td>
                                            <td>€" . $bodbedrag . "</td>
                                            <td >" . $tijdstip . "</td>
                                            <td >" . $dag . "</td>
                                            </tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <form class="form-inline" action="scripts/bieden.php" method="post" style="padding-top: 2rem">
                        <div class="columns">
                            <div class="column is-three-quarters">
                                <div class="control has-icons-left">
                                    <input class="input is-medium" type="number" min="0" id="bodbedrag"
                                           name="bodbedrag" required>
                                    <span class="icon is-medium is-left">
                                <i class="fa fa-eur"></i>
                                </div>
                            </div>
                            <div class="column is-one-quarter">
                                <div class="control is-1">
                                    <input class="is-hidden" type="number" id="voorwerpnummer" name="voorwerpnummer"
                                           value="<?= $voorwerpnummer?>">
                                    <input type="submit" class="button is-primary" name="bied" value="Bied">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php
include_once("includes/footer.php");
$username = '';
if (isset($_SESSION['gebruiker'])) {
    $username = $_SESSION['gebruiker'];
}
?>


<!--Countdown Script-->
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("<?php $phpdate = strtotime($row_details['veilingeinde']);
        $sqldate = date('Y-m-d H:i:s', $phpdate);
        echo $sqldate ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function () {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var dagen = Math.floor(distance / (1000 * 60 * 60 * 24));
        var uren = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minuten = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var secondes = Math.floor((distance % (1000 * 60)) / 1000);

        if ((uren + "").length === 1) {
            uren = "0" + uren;
        }
        if ((minuten + "").length === 1) {
            minuten = "0" + minuten;
        }
        if ((secondes + "").length === 1) {
            secondes = "0" + secondes;
        }

        if (dagen > 0) {
            document.getElementById("countdown").innerHTML = dagen + " dagen en " + uren + ":"
                + minuten + ":" + secondes;
        } else {
            document.getElementById("countdown").innerHTML = uren + ":" + minuten + ":" + secondes;
        }

        // Display the result in the element with id="demo"


        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "Veilig afgelopen";
        }
    }, 1000);
</script>