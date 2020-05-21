<?php
include_once("../includes/header.php");

if (empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}
?>

<div class="columns is-centered">
    <section class="section is-small">
        <div class="container">
            <h1 class="title">Bericht Versturen Succesvol</h1>
            <h2 class="subtitle">De verkoper zal zo snel mogelijk contact met u opnemen. <br> Er is ook een kopie gestuurd naar uw e-mailadres</h2>
        </div>
    </section>
</div>

<?php
include_once("../includes/footer.html");

?>