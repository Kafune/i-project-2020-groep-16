<?php
session_start();
echo $_SESSION['registratieStatus'];

if($_SESSION["registratieStatus"] == 1) {

    if (isset($_POST['codeCheck'])) {
        $verificatiecode = $_POST['code'];

        if ($verificatiecode == $_SESSION['verificatieCode']) {
            $_SESSION["registratieStatus"] = 2;
            header('location: ../../registratie/inlog.php');
        } else {
            $message = "Ongeldige code";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
} else {
    header('location:../../registratie/email.php');
}
?>