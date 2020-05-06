<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles/sass/mystyles.scss">
</head>
<body>
<div>
    <form action="check-login.php" method="POST">
        <p>
            <label>Gebruikersnaam</label>
            <input type="text" placeholder="Gebruikersnaam" name="gebruikersnaam"/>
        </p>
        <p>
            <label>Wachtwoord</label>
            <input type="password" placeholder="Wachtwoord" name="wachtwoord"/>
        </p>
        <p>
            <input type="submit" value="Log in"/>
        </p>
    </form>




</div>
</body>
</html>