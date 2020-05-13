<?php
include_once("includes/header.php");

?>
<link rel="stylesheet" href="styles/css/mystyles.css">
<link rel="stylesheet" href="styles/custom_styles.css">

<body>
<div class="container">
    <div class="block">
        <h1 class="title"></h1>
    </div>
    <div class="block">
        <div class="box">
            <h1 class="title">Openstaande biedingen</h1>
            <p>Hier staan al uw openstaande biedingen.
                Heeft een gebruiker meer geboden dan uw laatste bod?
                Dan kunt u hier een nieuw bod uitbrengen.
            </p>
            <hr>
            <div class="columns is-multiline">
                 <div class="column is-one-third" >
                        <div class="card" style="min-height:0px">

                            <div class="card-content">
                                <p class="title is-6">
                                    Voorbeeldtitel
                                </p>
                                <p class="">

                                </p>
                                <p>Uw laatste bod:</p>
<!--                                --><?php //foreach($row_geb as $value){ ?>
<!---->
<!--                                    <div class="columns">-->
<!--                                        <div class="column">-->
<!--                                            <p>--><?php //echo $value['gebruiker']?><!--</p>-->
<!--                                        </div>-->
<!--                                        <div class="column has-text-centered">-->
<!--                                            <p>€--><?php //echo $value['bodbedrag']?><!--</p>-->
<!--                                        </div>-->
<!--                                        <div class="column has-text-right">-->
<!--                                            <p>--><?php //echo $value['bodtijdstip']?><!--</p>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                --><?php //} ?>


                                    <div class="columns is-multiline">
                                        <div class="column">
                                            <p>test1</p>
                                        </div>
                                        <div class="column has-text-centered">
                                            <p>€test2</p>
                                        </div>
                                        <div class="column has-text-right">
                                            <p>test3</p>
                                        </div>
                                    </div>


                                <div class="field has-addons has-addons-centered">
                                    <p class="control">
                                        <input type="number" class="input" name="" id="" placeholder="€" required>
                                    </p>
                                    <p class="control">
                                        <button type="submit" name="" class="button is-primary">Bieden</button>
                                    </p>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                        </span>
                                </p>
                            </footer>
                        </div>
                    </div>
                <div class="column is-one-third" >
                    <div class="card" style="min-height:0px">

                        <div class="card-content">
                            <p class="title is-6">
                                Voorbeeldtitel
                            </p>
                            <p class="">

                            </p>
                            <p>Uw laatste bod:</p>
                            <!--                                --><?php //foreach($row_geb as $value){ ?>
                            <!---->
                            <!--                                    <div class="columns">-->
                            <!--                                        <div class="column">-->
                            <!--                                            <p>--><?php //echo $value['gebruiker']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-centered">-->
                            <!--                                            <p>€--><?php //echo $value['bodbedrag']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-right">-->
                            <!--                                            <p>--><?php //echo $value['bodtijdstip']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!---->
                            <!--                                --><?php //} ?>


                            <div class="columns is-multiline">
                                <div class="column">
                                    <p>test1</p>
                                    <p>test1.2</p>
                                    <p>test1.2</p>
                                    <p>test1.2</p>
                                </div>
                                <div class="column has-text-centered">
                                    <p>€test2</p>
                                    <p>test2.2</p>
                                    <p>test1.2</p>
                                    <p>test1.2</p>
                                </div>
                                <div class="column has-text-right">
                                    <p>test3</p>
                                    <p>test3.2</p>
                                    <p>test1.2</p>
                                    <p>test1.2</p>
                                </div>
                            </div>


                            <div class="field has-addons has-addons-centered">
                                <p class="control">
                                    <input type="number" class="input" name="" id="" placeholder="€" required>
                                </p>
                                <p class="control">
                                    <button type="submit" name="" class="button is-primary">Bieden</button>
                                </p>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                        </span>
                            </p>
                        </footer>
                    </div>
                </div>
                <div class="column is-one-third" >
                    <div class="card" style="min-height:0px">

                        <div class="card-content">
                            <p class="title is-6">
                                Voorbeeldtitel
                            </p>
                            <p class="">

                            </p>
                            <p>Uw laatste bod:</p>
                            <!--                                --><?php //foreach($row_geb as $value){ ?>
                            <!---->
                            <!--                                    <div class="columns">-->
                            <!--                                        <div class="column">-->
                            <!--                                            <p>--><?php //echo $value['gebruiker']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-centered">-->
                            <!--                                            <p>€--><?php //echo $value['bodbedrag']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-right">-->
                            <!--                                            <p>--><?php //echo $value['bodtijdstip']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!---->
                            <!--                                --><?php //} ?>


                            <div class="columns is-multiline">
                                <div class="column">
                                    <p>test1</p>
                                </div>
                                <div class="column has-text-centered">
                                    <p>€test2</p>
                                </div>
                                <div class="column has-text-right">
                                    <p>test3</p>
                                </div>
                            </div>


                            <div class="field has-addons has-addons-centered">
                                <p class="control">
                                    <input type="number" class="input" name="" id="" placeholder="€" required>
                                </p>
                                <p class="control">
                                    <button type="submit" name="" class="button is-primary">Bieden</button>
                                </p>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                        </span>
                            </p>
                        </footer>
                    </div>
                </div>
                <div class="column is-one-third" >
                    <div class="card" style="min-height:0px">

                        <div class="card-content">
                            <p class="title is-6">
                                Voorbeeldtitel
                            </p>
                            <p class="">

                            </p>
                            <p>Uw laatste bod:</p>
                            <!--                                --><?php //foreach($row_geb as $value){ ?>
                            <!---->
                            <!--                                    <div class="columns">-->
                            <!--                                        <div class="column">-->
                            <!--                                            <p>--><?php //echo $value['gebruiker']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-centered">-->
                            <!--                                            <p>€--><?php //echo $value['bodbedrag']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-right">-->
                            <!--                                            <p>--><?php //echo $value['bodtijdstip']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!---->
                            <!--                                --><?php //} ?>


                            <div class="columns is-multiline">
                                <div class="column">
                                    <p>test1</p>
                                </div>
                                <div class="column has-text-centered">
                                    <p>€test2</p>
                                </div>
                                <div class="column has-text-right">
                                    <p>test3</p>
                                </div>
                            </div>


                            <div class="field has-addons has-addons-centered">
                                <p class="control">
                                    <input type="number" class="input" name="" id="" placeholder="€" required>
                                </p>
                                <p class="control">
                                    <button type="submit" name="" class="button is-primary">Bieden</button>
                                </p>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                        </span>
                            </p>
                        </footer>
                    </div>
                </div>
                <div class="column is-one-third" >
                    <div class="card" style="min-height:0px">

                        <div class="card-content">
                            <p class="title is-6">
                                Voorbeeldtitel
                            </p>
                            <p class="">

                            </p>
                            <p>Uw laatste bod:</p>
                            <!--                                --><?php //foreach($row_geb as $value){ ?>
                            <!---->
                            <!--                                    <div class="columns">-->
                            <!--                                        <div class="column">-->
                            <!--                                            <p>--><?php //echo $value['gebruiker']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-centered">-->
                            <!--                                            <p>€--><?php //echo $value['bodbedrag']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-right">-->
                            <!--                                            <p>--><?php //echo $value['bodtijdstip']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!---->
                            <!--                                --><?php //} ?>


                            <div class="columns is-multiline">
                                <div class="column">
                                    <p>test1</p>
                                </div>
                                <div class="column has-text-centered">
                                    <p>€test2</p>
                                </div>
                                <div class="column has-text-right">
                                    <p>test3</p>
                                </div>
                            </div>


                            <div class="field has-addons has-addons-centered">
                                <p class="control">
                                    <input type="number" class="input" name="" id="" placeholder="€" required>
                                </p>
                                <p class="control">
                                    <button type="submit" name="" class="button is-primary">Bieden</button>
                                </p>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                        </span>
                            </p>
                        </footer>
                    </div>
                </div>

            </div>
        </div>
        <div class="box">
            <h1 class="title">Uw veilingen</h1>
            <p>Hier staan al uw openstaande biedingen.
                Heeft een gebruiker meer geboden dan uw laatste bod?
                Dan kunt u hier een nieuw bod uitbrengen.
            </p>
            <hr>
            <div class="columns is-multiline">
                <div class="column is-one-third" >
                    <div class="card" style="min-height:0px">

                        <div class="card-content">
                            <p class="title is-6">
                                Voorbeeldtitel
                            </p>
                            <p class="">

                            </p>
                            <p>Hoogste bod:</p>
                            <!--                                --><?php //foreach($row_geb as $value){ ?>
                            <!---->
                            <!--                                    <div class="columns">-->
                            <!--                                        <div class="column">-->
                            <!--                                            <p>--><?php //echo $value['gebruiker']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-centered">-->
                            <!--                                            <p>€--><?php //echo $value['bodbedrag']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-right">-->
                            <!--                                            <p>--><?php //echo $value['bodtijdstip']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!---->
                            <!--                                --><?php //} ?>


                            <div class="columns is-multiline">
                                <div class="column">
                                    <p>test1</p>
                                </div>
                                <div class="column has-text-centered">
                                    <p>€test2</p>
                                </div>
                                <div class="column has-text-right">
                                    <p>test3</p>
                                </div>
                            </div>



                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                        </span>
                            </p>
                        </footer>
                    </div>
                </div>
                <div class="column is-one-third" >
                    <div class="card" style="min-height:0px">

                        <div class="card-content">
                            <p class="title is-6">
                                Voorbeeldtitel
                            </p>
                            <p class="">

                            </p>
                            <p>Hoogste bod:</p>
                            <!--                                --><?php //foreach($row_geb as $value){ ?>
                            <!---->
                            <!--                                    <div class="columns">-->
                            <!--                                        <div class="column">-->
                            <!--                                            <p>--><?php //echo $value['gebruiker']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-centered">-->
                            <!--                                            <p>€--><?php //echo $value['bodbedrag']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-right">-->
                            <!--                                            <p>--><?php //echo $value['bodtijdstip']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!---->
                            <!--                                --><?php //} ?>


                            <div class="columns is-multiline">
                                <div class="column">
                                    <p>test1</p>
                                </div>
                                <div class="column has-text-centered">
                                    <p>€test2</p>
                                </div>
                                <div class="column has-text-right">
                                    <p>test3</p>
                                </div>
                            </div>



                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                        </span>
                            </p>
                        </footer>
                    </div>
                </div>
                <div class="column is-one-third" >
                    <div class="card" style="min-height:0px">

                        <div class="card-content">
                            <p class="title is-6">
                                Voorbeeldtitel
                            </p>
                            <p class="">

                            </p>
                            <p>Hoogste bod:</p>
                            <!--                                --><?php //foreach($row_geb as $value){ ?>
                            <!---->
                            <!--                                    <div class="columns">-->
                            <!--                                        <div class="column">-->
                            <!--                                            <p>--><?php //echo $value['gebruiker']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-centered">-->
                            <!--                                            <p>€--><?php //echo $value['bodbedrag']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-right">-->
                            <!--                                            <p>--><?php //echo $value['bodtijdstip']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!---->
                            <!--                                --><?php //} ?>


                            <div class="columns is-multiline">
                                <div class="column">
                                    <p>test1</p>
                                </div>
                                <div class="column has-text-centered">
                                    <p>€test2</p>
                                </div>
                                <div class="column has-text-right">
                                    <p>test3</p>
                                </div>
                            </div>



                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                        </span>
                            </p>
                        </footer>
                    </div>
                </div>
                <div class="column is-one-third" >
                    <div class="card" style="min-height:0px">

                        <div class="card-content">
                            <p class="title is-6">
                                Voorbeeldtitel
                            </p>
                            <p class="">

                            </p>
                            <p>Hoogste bod:</p>
                            <!--                                --><?php //foreach($row_geb as $value){ ?>
                            <!---->
                            <!--                                    <div class="columns">-->
                            <!--                                        <div class="column">-->
                            <!--                                            <p>--><?php //echo $value['gebruiker']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-centered">-->
                            <!--                                            <p>€--><?php //echo $value['bodbedrag']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="column has-text-right">-->
                            <!--                                            <p>--><?php //echo $value['bodtijdstip']?><!--</p>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!---->
                            <!--                                --><?php //} ?>


                            <div class="columns is-multiline">
                                <div class="column">
                                    <p>test1</p>
                                </div>
                                <div class="column has-text-centered">
                                    <p>€test2</p>
                                </div>
                                <div class="column has-text-right">
                                    <p>test3</p>
                                </div>
                            </div>



                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                        <span>
                                            <a href="" class="">Details</a>
                                        </span>
                            </p>
                        </footer>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<br>
</body>
<?php
include_once("includes/footer.php");
?>

<script>


</script>