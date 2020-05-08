<?php
session_start();
include_once('../includes/db.php');

if(isset($_SESSION['gebruikersnaam'])){
    $gebruiker = $_SESSION['gebruikersnaam'];
    $sql = "DELETE FROM gebruiker WHERE gebruikersnaam = ?";
    $q = $conn->prepare($sql);
    $res = $q->execute(array($gebruiker));
    echo "<script>
    alert('Account is verwijderd..');
    window.location.href='logout.php';
    </script>";
    $conn->close();
}
else{

}




?>
