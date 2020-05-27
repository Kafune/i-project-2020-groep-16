<?php

include_once("includes/header.php");
include_once("includes/db.php");

$prod_id = $_GET['voorwerpnummer'];
$page_details= $conn->prepare("SELECT * FROM voorwerp WHERE voorwerpnummer ='".$prod_id."'");
$page_details->execute();
$row_details = $page_details->fetch(PDO::FETCH_ASSOC);

$page_photo= $conn->prepare("SELECT * FROM Bestand WHERE voorwerpnummer ='".$row_details['voorwerpnummer']."'");
$page_photo->execute();
$row_image = $page_photo->fetch(PDO::FETCH_ASSOC);


if(isset($_GET['status'])){
    if($_GET['status'] == 0){
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

#table tr:nth-child(even){background-color: #f2f2f2;}

#table tr:hover {background-color: #ddd;}
#table #high{
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

                    $sql_rubriek = "SELECT rubrieknummer FROM VoorwerpInRubriek WHERE voorwerpnummer = ".$voorwerpnummer."";

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
                    echo "<li><a href='/index.php?'>Rubrieken</a></li>";
                    $reversed_namen = array_reverse($namen);
                    $reversed_nummer = array_reverse($nummer);

                    for ($i=0; $i< count($reversed_namen);$i++){
                        echo "<li><a href='index.php?parent=" . $reversed_nummer[$i] ."'>" . $reversed_namen[$i] . "</a></li>";
                    }
                    ?>
                </ul>
            </nav>
            <div class="columns">
                <div class="column is-half">
                    <img src="<?php echo 'upload/'.$row_image['filenaam'] ?>" alt="Placeholder" style="width:100%;" class="image">
                    <p><?php echo $row_details['gebruikersnaam'] ?></p>
                    <p><?php echo $row_details['plaatsnaam'] ?></p>
                    <br>
                    <p class="has-text-weight-bold">Verkoper</p>
                    <a href="../verkoper/verkoperpagina.php?verkoper=<?=$row_details['verkoper']?>"><?php echo $row_details['verkoper'] ?></a>
                    <p class="has-text-weight-bold">Betalingswijze</p>
                    <p><?php echo $row_details['betalingswijze'] ?></p>
                    <p class="has-text-weight-bold">Betalingsinstructies</p>
                    <p><?php echo $row_details['betalingsinstructie'] ?></p>
                    <br>
                    <p class="has-text-weight-bold">Startverkoop</p>
                    <p><?php $phpdate = strtotime($row_details['veilingbegin']);
                        $sqldate = date('d-m-Y H:i:s',$phpdate);
                        echo $sqldate?></p>
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
                            <form method="post" action="insertByAjax.php" id="amountForm">
                                <p class="control">
                                    <input type="number" class="input" name="amount" id="bid_amount" placeholder="€" required>
                                    <input type="hidden" name="action" value="insert">
                                    <input type="hidden" id="bid_product_id" name="prod_id" value="<?=$prod_id;?>">
                                </p>
                                <p class="control">
                                    <button type="button" name="" id="bid_submit" class="button is-primary">Verzenden</button>
                                </p>
                            </form>
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
if(isset($_SESSION['gebruiker'])){
    $username = $_SESSION['gebruiker'];
}
?>
<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    var username = "<?=$username;?>";
    var bid = 5;
    getdata();
    function getdata(){

        prod_id = $('#bid_product_id').val();
        $.post("insertByAjax.php",
            {
                action: 'get',
                prod_id: prod_id
            },
            function(data, status){
                var array = JSON.parse(data);
                //alert("Data: " + data + "\nStatus: " + status);
                $('#tableData').html(array.output);
                if(array.highestvalue != 'none'){
                    bid = array.highestvalue;
                }
                if(array.auction_end != 'none'){
                    $('#auction_end').html("<center><h2>End time : "+array.auction_end+"</h2></center>")
                }
                if(array.bid == 'stop'){
                    $('.bid_data').html('');
                    $('.bid_title').text('tijd voorbij');
                    $('#name').html('<center><h1>Winner is '+array.person+'</h1><h1>Highes bid amount : € '+array.highestvalue+'</h1></center>');
                }
            });
        $('#bid_amount').val('');

    }
    $(document).ready(function(){
        $("#bid_submit").click(function(){
            username = 'amar';

            if(username == ''){
                alert('Je moet eerst inloggen om mee te kunnen bieden.');
                return false;
            }
            amount = $('#bid_amount').val();
            amount = parseInt(amount);
            bid = parseInt(bid);
            prod_id = $('#bid_product_id').val();
            if(amount != ''){
                if(amount > bid){
                    $('#bid_amount').css('border','1px solid gray');

                    $('#amountForm').submit();


                }else{
                    alert('vul bedrag meer dan '+bid);
                }

            }else{
                $('#bid_amount').css('border','2px solid red');
            }

        });

        //alert('fine');
    });
</script>