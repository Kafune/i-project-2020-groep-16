<?php
include_once("includes/db.php");
session_start();
$username = '';
if(isset($_SESSION['gebruiker'])){
    $username = $_SESSION['gebruiker'];
}

if(isset($_POST['amount'])){

	        $date = date('Y-m-d');
            $dateTime = date('Y-m-d h:i:sa');
            $amount = $_POST['amount'];
            $prod_id = $_POST['prod_id'];

            $page_details= $conn->prepare("SELECT gebruiker FROM bod WHERE Voorwerp ='".$prod_id."' ORDER BY id DESC LIMIT 1");
            $page_details->execute();
            $row_details = $page_details->fetch(PDO::FETCH_ASSOC);

            if($row_details['gebruiker'] == $username){
                $outarray = array(
                'bid' => 'run',
                'status'=>0,
                );
                echo json_encode($outarray);
                die;
            }

            $sql = "INSERT INTO `bod`(
				`Voorwerp`, `bodbedrag`, `gebruiker`, `boddag`, `bodtijdstip`
			)
            VALUES (
            :Voorwerp,
            :bodbedrag,
            :gebruiker,
            :boddag,
            :bodtijdstip
            )
           ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Voorwerp', $prod_id);
    $stmt->bindParam(':bodbedrag', $amount);
    $stmt->bindParam(':gebruiker', $username);
    $stmt->bindParam(':boddag', $date);
    $stmt->bindParam(':bodtijdstip', $dateTime);
    $stmt->execute();

    echo 'successfully';
    
}


function searchForId($id, $array) {
   foreach ($array as $key => $val) {
       if ($val['bodbedrag'] === $id) {
           return $val['gebruiker'];
       }
   }
   return null;
}



if($_POST['action'] == 'get'){
$prod_id = $_POST['prod_id'];
$page_details= $conn->prepare("SELECT veilingeinde FROM voorwerp WHERE voorwerpnummer ='".$prod_id."'");
$page_details->execute();
$row_details = $page_details->fetch(PDO::FETCH_ASSOC);

$auction_stop_time = $row_details['veilingeinde'];
$dateTime = date('Y-m-d h:i:sa');
$dateTime = date('Y-m-d h:i:sa');
$bod_details= $conn->prepare("SELECT * FROM bod WHERE Voorwerp ='".$prod_id."' ORDER BY bodtijdstip DESC");
$bod_details->execute();
$person_array = $bod_details->fetchAll(PDO::FETCH_ASSOC);
if(count($person_array) > 0){
$output = '';
    foreach ($person_array as $key => $value) {

        $output .= '<div class="columns">
                                <div class="column">
                                    <p>'.$value['gebruiker'].'</p>
                                </div>
                                <div class="column has-text-centered">
                                    <p>€ '.$value['bodbedrag'].'</p>
                                </div>
                                <div class="column has-text-right">
                                    <p>'.$value['bodtijdstip'].'</p>
                                </div>
                            </div>';
    }





$highestvalue = max(array_column($person_array, 'bodbedrag'));
if($dateTime < $auction_stop_time){
 $outarray = array(
    'bid' => 'run',
    'output'=>$output,
    'highestvalue'=>$highestvalue,
    'auction_end'=>$auction_stop_time,
    'person'=>searchForId($highestvalue,$person_array)
);
}else{
   $outarray = array(
    'bid' => 'stop',
    'output'=>$output,
    'highestvalue'=>$highestvalue,
    'auction_end'=>$auction_stop_time,
    'person'=>searchForId($highestvalue,$person_array)
); 
}

}else{
    $outarray = array(
    'bid' => 'none',
    'output'=>'<center><h1>Geen data beschikbaar</h2></center>',
    'auction_end'=>'none',
    'highestvalue'=>'none',
    'person'=>'none'
);
}

echo json_encode($outarray);

}








?>