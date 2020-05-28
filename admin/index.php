<?php
include_once('../includes/header.php');
include_once('menu.php');
include_once ('../includes/db.php');
include_once ('dataVerwerking.php');

$sql = "SELECT TOP 10 titel, voorwerpnummer FROM Voorwerp ORDER BY veilingbegin DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
<!-- END NAV -->
<div class="column is-10" style="padding-top: 3rem">
    <section class="hero is-primary is-small">
        <div class="hero-body">
            <div class="container">
                <?php echo '<h1 class="title">Welkom '.$voornaam.'</h1>'?>
            </div>
        </div>
    </section>
    <section class="info-tiles">
        <div class="tile is-ancestor has-text-centered">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <?php echo '<p class="title">'.$aantalgebruikers.'</p>'?>
                    <p class="subtitle">Gebruikers</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <?php echo '<p class="title">'.$aantalverkopers.'</p>'?>
                    <p class="subtitle">Verkopers</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <?php echo '<p class="title">'.$aantalvoorwerpen.'</p>'?>
                    <p class="subtitle">Voorwerpen</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <?php echo '<p class="title">'.$aantalrubrieken.'</p>'?>
                    <p class="subtitle">Rubrieken</p>
                </article>
            </div>

        </div>
    </section>
    <div class="columns">
        <div class="column is-half">
            <section class="hero is-primary is-small">
                <div class="hero-body">
                    <div class="container">
                        <h1>Nieuwste voorwerpen</h1>
                    </div>
                </div>
            </section>
            <div class="card-table">
                <div class="content">
                    <table class="table is-fullwidth is-striped">
                        <tbody>
                        <?php

                        while ($row = $stmt->fetch()) {
                            $titel = $row['titel'];
                            $voorwerpnummer = $row['voorwerpnummer'];

                            echo "
                                <tr>
                                <td width=\"5%\"><i class=\"fa fa-cube\"></i></td>
                                <td>" . $titel . "</td>
                                <td>" . $voorwerpnummer . "</td>
                                <td class=\"level-right\"><a class=\"button is-small is-primary\" 
                                href='/playstation4.php?voorwerpnummer=".$voorwerpnummer."'>Bekijken</a></td>
                                </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="column is-half">
            <section class="hero is-primary is-small">
                <div class="hero-body">
                    <div class="container">
                        <h1>Top 10 biedingen van de maand</h1>
                    </div>
                </div>
            </section>
            <div class="card-table">
                <div class="content">
                    <table class="table is-fullwidth is-striped">
                        <tbody>
                        <?php

                        while ($resultbiedingen = $stmt_biedingen->fetch()) {
                            $voorwerp = $resultbiedingen['Voorwerp'];
                            $bodbedrag = $resultbiedingen['bodbedrag'];
                            $gebruiker = $resultbiedingen['gebruiker'];

                            echo "
                                <tr>
                                <td width=\"5%\"><i class=\"fa fa-credit-card\"></i></td>
                                <td>" . $voorwerp . "</td>
                                <td>€ " . $bodbedrag . "</td>
                                <td>" . $gebruiker . "</td>
                                <td class=\"level-right\"><a class=\"button is-small is-primary\" 
                                href='/playstation4.php?voorwerpnummer=".$voorwerp."'>Bekijken</a></td>
                                </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script async type="text/javascript" src="../js/bulma.js"></script>
</body>

</html>

<?php
include_once ('../includes/footer.php');
