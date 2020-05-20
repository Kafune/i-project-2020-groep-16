<?php
include_once("includes/header.php");
include_once("includes/db.php");
$prod_id = $_GET['voorwerpnummer'];
//print_r($_SESSION);
$page_details = $conn->prepare("SELECT * FROM voorwerp WHERE voorwerpnummer ='" . $prod_id . "'");
$page_details->execute();
$row_details = $page_details->fetch(PDO::FETCH_ASSOC);

$page_photo = $conn->prepare("SELECT * FROM Bestand WHERE voorwerpnummer ='" . $row_details['voorwerpnummer'] . "'");
$page_photo->execute();
$row_image = $page_photo->fetch(PDO::FETCH_ASSOC);

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
                <img src="<?php echo 'upload/' . $row_image['filenaam'] ?>" alt="Placeholder" style="width:100%;"
                     class="image">
                <p><?php echo $row_details['verkoper'] ?></p>
                <p><?php echo $row_details['plaatsnaam'] ?></p>
                <br>
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
                    <h1 class="title has-text-weight-bold has-text-centered bid_title">Tijd over</h1>
                    <div id="auction_end"></div>
                    <div id="name"></div>
                    <div id="tableData" style="padding:20px;">
                    </div>
                    <div class="field has-addons has-addons-centered bid_data">
                        <p class="control">
                            <input type="number" class="input" name="" id="bid_amount" placeholder="€" required>
                            <input type="hidden" id="bid_product_id" value="<?= $prod_id; ?>">
                        </p>
                        <p class="control">
                            <button type="submit" name="" id="bid_submit" class="button is-primary">Verzenden</button>
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
$username = '';
if (isset($_SESSION['gebruiker'])) {
    $username = $_SESSION['gebruiker'];
}
?>

<script>
    var username = "<?=$username;?>";
    var bid = 5;
    getdata();

    function getdata() {

        prod_id = $('#bid_product_id').val();
        $.post("insertByAjax.php",
            {
                action: 'get',
                prod_id: prod_id
            },
            function (data, status) {
                var array = JSON.parse(data);
                //alert("Data: " + data + "\nStatus: " + status);
                $('#tableData').html(array.output);
                if (array.highestvalue != 'none') {
                    bid = array.highestvalue;
                }
                if (array.auction_end != 'none') {
                    $('#auction_end').html("<center><h2>Einde veiling : " + array.auction_end + "</h2></center>")
                }
                if (array.bid == 'stop') {
                    $('.bid_data').html('');
                    $('.bid_title').text('tijd voorbij');
                    $('#name').html('<center><h1>Winnaar is ' + array.person + '</h1><h1>Hoogste geboden bedrag : € ' + array.highestvalue + '</h1></center>');
                }
            });
        $('#bid_amount').val('');

    }

    $(document).ready(function () {
        $("#bid_submit").click(function () {
            if (username == '') {
                alert('U moet eerst inloggen om te kunnen bieden!');
                return false;
            }
            amount = $('#bid_amount').val();
            prod_id = $('#bid_product_id').val();
            if (amount != '') {
                if (amount > bid) {

                    $('#bid_amount').css('border', '1px solid gray');

                    $.post("insertByAjax.php",
                        {
                            amount: amount,
                            prod_id: prod_id
                        },
                        function (data, status) {
                            var array = JSON.parse(data);
                            if (array.status == 0) {
                                alert("U kunt pas weer bieden als iemand u heeft overboden!");
                            }
                            getdata();
                        });

                } else {
                    alert('Vul bedrag meer dan ' + bid);

                }

            } else {
                $('#bid_amount').css('border', '2px solid red');
            }

        });

        // alert('fine');
    });
</script>