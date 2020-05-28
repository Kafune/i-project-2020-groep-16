<?php
include_once("../includes/header.php");
$controleoptie = $_SESSION['controleoptie'];

if (empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}
?>

<?php if($controleoptie === 'Creditcard') { ?>
    <div class="columns is-centered">
        <section class="section is-small">
            <div class="container">
                <h1 class="title">Registreren Voltooid</h1>
                <h2 class="subtitle">U heeft een creditcard gebruikt, er is dus geen verdere verificatie meer nodig.</h2>
            </div>
        </section>
    </div>
<?php } ?>


<?php if($controleoptie === 'Post') { ?>
    <div class="columns is-centered">
        <section class="section is-small">
            <div class="container">
                <h1 class="title">Registreren Deels Voltooid</h1>
                <h2 class="subtitle">U zal zo snel mogelijk een brief ontvangen met daarin een verificatiecode. <br>
                    Deze kunt u invullen op de profielpagina om verkoper te worden.</h2>
            </div>
        </section>
    </div>
<?php } ?>

<?php
include_once("../includes/footer.php");
?>