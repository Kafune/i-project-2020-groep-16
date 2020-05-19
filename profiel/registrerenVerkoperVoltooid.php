<?php
include_once("../includes/header.php");
include_once ('../includes/errors.php');

if(empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}
?>

<div class="columns is-centered">
    <section class="section is-small">
        <div class="container">
            <h1 class="title">Registreren Compleet</h1>
            <h2 class="subtitle">Als u geen creditcard heeft ingevuld, zal u zo spoedig mogelijk een brief ontvangen.</h2>
        </div>
    </section>
</div>

<?php
include_once("../includes/footer.php");

?>