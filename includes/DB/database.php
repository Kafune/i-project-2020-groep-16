<?php
$user = 'root';
$pass = '';
$db = 'i-project';

$db = new mysqli ('localhost', $user, $pass, $db) or die("niet mogelijk te connecten");



if($db->connect_error)
{
    die("Connectie failed:".$db->connect_error);
}
?>