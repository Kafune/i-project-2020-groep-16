

<?php
session_start();

include_once("root.php");
include_once("meldingen.php");
include_once("db.php");



function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week', // this is
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function getnotifications(){
    $gebruiker = "iproject16";
    $wachtwoord = "zv1VeSWK";
    $conn2 = new PDO('sqlsrv:server=mssql2.iproject.icasites.nl;database=iproject16', $gebruiker, $wachtwoord);

    $q="SELECT `voorwerpnummer` FROM `voorwerp` WHERE `veilingeinde` > date('Y-m-d H:i:s')";
    $q= $conn2->prepare($q);
    $q->execute();
    $q = $q->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($q) && count($q)){
        foreach ($q as $key) {
            $page_details2= $conn2->prepare("UPDATE `bod` SET `status`= 1 WHERE `voorwerp` ='".$key['voorwerpnummer']."'");
            $page_details2->execute();
            $query = "SELECT id FROM bod WHERE bodbedrag=(SELECT MAX(bodbedrag) FROM bod) AND Voorwerp ='".$key['voorwerpnummer']."'";
            $bod_details2= $conn2->prepare($query);
            $bod_details2->execute();
            $person_array2 = $bod_details2->fetch(PDO::FETCH_ASSOC);
            $page_details2= $conn2->prepare("UPDATE `bod` SET `status`= 2 WHERE `id` ='".$person_array2['id']."'");
            $page_details2->execute();
        }
    }

    if (isset($_SESSION['gebruiker'])){
        $gebruiker = $_SESSION['gebruiker'];
    }
    $query = "SELECT bod.*,voorwerp.titel FROM bod,voorwerp WHERE bod.bodbedrag=(SELECT MAX(bodbedrag) FROM bod WHERE gebruiker ='".$gebruiker."') GROUP BY bod.voorwerp";
    $bod_details2= $conn2->prepare($query);
    $bod_details2->execute();
    $person_array2 = $bod_details2->fetchAll(PDO::FETCH_ASSOC);
    $output = '';
    if(!empty($person_array2) && count($person_array2)>0){
        $output .='<table>';
        $status = '';
        foreach ($person_array2 as $key) {
            if($key['status'] == 2){
                $status .='je hebt de veiling gewonnen';
            }elseif ($key['status'] == 1) {
                $status .='je hebt helaas de veiling verloren';
            }else{
                break;
            }
            $output .='<tr><td><a href="voorwerp.php?voorwerpnummer='.$key['voorwerp'].'" >'.$key['titel'].'</a><br><b style="color:black;">'.$status.'</b></td><td style="padding: 10px;">'.time_elapsed_string($key['bodtijdstip']).'</td><tr>';
        }

        $output .='</table>';
    }else{
        $output .='<center><h2>Geen notificaties beschikbaar</h2></center>';
    }

    return $output;
}


$page = $conn->prepare("SELECT voorwerpnummer,veilingeinde FROM voorwerp WHERE veilingGesloten = 0 ");
$page->execute();
$row = $page->fetchAll(PDO::FETCH_ASSOC);

$dateTime = time();
foreach ($row as $key) {
    $auction_stop_time = strtotime($key['veilingeinde']);
    $voorwerpnummer = $key['voorwerpnummer'];
    if($dateTime > $auction_stop_time){
        $query = $conn->prepare("UPDATE voorwerp SET veilingGesloten = 1 WHERE voorwerpnummer = :voorwerpnummer");
        $query->bindParam(':voorwerpnummer', $voorwerpnummer);
        $query->execute();
    }
}

if (!isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off') {
    $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirect_url");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/styles/css/mystyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Eenmaal Andermaal</title>

    <style>
        .is-black .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            padding: 5px 10px;
            border-radius: 50%;
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
<nav class="navbar is-primary">
    <div class="navbar-brand">
        <a class="navbar-item" href="/index.php">
            <img src="/sources/Logo.png" alt="Eenmaal Andermaal">
        </a>
        <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>



    <div class="navbar-menu" id="navMenu">
        <div class="navbar-start">
            <a class="navbar-item" href="/index.php">Home</a>
            <a class="navbar-item" href="/rubriekenboom.php">Categoriën</a>
            <a class="navbar-item" href="#">Top Veilingen</a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Contact</a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/contact.php">Contact EenmaalAndermaal</a>
                    <?php
                    if (isset($_SESSION['gebruiker'])){
                        echo "<a class=\"navbar-item\" href=\"/contact/ContactVerkoper.php\">Contact Verkoper</a>";
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="navbar-end is">
            <?php

            if (!isset($_SESSION['ingelogd'])) {
                echo '<a class="button is-black" href="/registratie/email.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Registreren</a>
                  <a class="button is-black" href="/login.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Log In</a>';
            } else {
                if (isset($_SESSION['verkoper'])) {
                    echo '<a class="button is-black" href="#" onclick="myFunction();" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto"><span>Notification</span></a> <div style="width: 20%;padding:5px;    max-height: 300px;color: white;overflow: auto;position: absolute;top: 90%;    right: 22%;background-color: #e50056;display:none;" id="noti_div">'.getnotifications().'</div><a class="button is-black" href="/voorwerpen/rubrieken_voorwerp_toevoegen.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Verkoop</a>';
                }
                if (isset($_SESSION['admin'])) {
                    echo '<a class="button is-black" href="/admin/index.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Dashboard</a>';
                }

                echo '<a class="button is-black" href="/profiel/gebruikersprofiel.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Mijn Profiel</a>
                  <a class="button is-black" href="/scripts/logout.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Uitloggen</a>';
            }
            ?>
        </div>
    </div>
</nav>
<?php laatMeldingZien();?>
</body>
<script>
    function myFunction() {
        var x = document.getElementById("noti_div");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    document.addEventListener('DOMContentLoaded', () => {

        // Get all "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {

                    // Get the target from the "data-target" attribute
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);

                    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });
        }

    });
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-150449112-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-150449112-2');
</script>


