<?php
include_once("../includes/header.php");


if (empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}
?>

<div class="columns is-centered">
    <section class="section is-small">
        <div class="container">
            <h1 class="title">Verificatiecode invullen</h1>
            <h2 class="subtitle">Als u een brief heeft ontvangen met daarin de verificatiecode, vul die dan hieronder
                in.</h2>
            <form action="" method="post">
                <label class="label" for="verificatiecode">Verificatiecode</label>
                <input type="text" class="input" id="verificatiecode" name="verificatiecode">
                <br><br>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-success" type="submit" name="verifieerverkoper">Verzenden</button>
                    </div>
                    <div class="control">
                        <button class="button is-danger" type="reset">Annuleren</button>
                    </div>
            </form>
        </div>
    </section>
</div>

<?php

if (isset($_POST['verifieerverkoper'])) {
    require_once('../includes/root.php');
    include_once('../includes/db.php');
    global $conn;

    $verificatiecode = $_POST['verificatiecode'];
    $gebruikersnaam = $_SESSION['gebruiker'];

    $verifieerverkoper= $conn->prepare("SELECT controlenummer FROM Verkoper WHERE gebruikersnaam = :gebruikersnaam");
    $verifieerverkoper->bindParam(':gebruikersnaam', $gebruikersnaam);
    $verifieerverkoper->execute();
    $result = $verifieerverkoper->fetch(PDO::FETCH_ASSOC);

    if($verificatiecode === $result['controlenummer']) {
        $sql = "UPDATE Gebruiker SET isVerkoper = 1 WHERE gebruikersnaam = :gebruikersnaam";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmt->execute();
        $_SESSION['success'] = "succesVerkoperRegistratie";
        header('location: gebruikersprofiel.php');

    } else {
        $_SESSION['error'] = "errorVerkoperRegistratie";
        header('location: verifierenVerkoper.php');
    }
}

include_once("/includes/footer.php");
?>
