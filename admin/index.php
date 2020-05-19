<?php
include_once('../includes/header.php');
include_once('menu.php');
include_once ('../includes/db.php');
include_once ('dataVerwerking.php');
?>
<!-- END NAV -->
<div class="column is-9" style="padding-top: 3rem">
    <section class="hero is-primary welcome is-small">
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
        <div class="column is-6">
            <div class="card events-card">
                <header class="card-header">
                    <p class="card-header-title">
                        Events
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                    </a>
                </header>
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped">
                            <tbody>
                            <tr>
                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                <td>Lorum ipsum dolem aire</td>
                                <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                            </tr>
                            <tr>
                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                <td>Lorum ipsum dolem aire</td>
                                <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                            </tr>
                            <tr>
                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                <td>Lorum ipsum dolem aire</td>
                                <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                            </tr>
                            <tr>
                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                <td>Lorum ipsum dolem aire</td>
                                <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                            </tr>
                            <tr>
                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                <td>Lorum ipsum dolem aire</td>
                                <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                            </tr>
                            <tr>
                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                <td>Lorum ipsum dolem aire</td>
                                <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                            </tr>
                            <tr>
                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                <td>Lorum ipsum dolem aire</td>
                                <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                            </tr>
                            <tr>
                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                <td>Lorum ipsum dolem aire</td>
                                <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                            </tr>
                            <tr>
                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                <td>Lorum ipsum dolem aire</td>
                                <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <footer class="card-footer">
                    <a href="#" class="card-footer-item">View All</a>
                </footer>
            </div>
        </div>
        <div class="column is-6">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Inventory Search
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="control has-icons-left has-icons-right">
                            <input class="input is-large" type="text" placeholder="">
                            <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                    </span>
                            <span class="icon is-medium is-right">
                      <i class="fa fa-check"></i>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        User Search
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="control has-icons-left has-icons-right">
                            <input class="input is-large" type="text" placeholder="">
                            <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                    </span>
                            <span class="icon is-medium is-right">
                      <i class="fa fa-check"></i>
                    </span>
                        </div>
                    </div>
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
function getAantalGebruikers(){
    $sql_gebruikers = "SELECT count(*) FROM Gebruiker";
    $result = $conn->prepare($sql_gebruikers);
    $result->execute();
    $aantalgebruikers = $result->fetchColumn();
    echo $aantalgebruikers;
    return $aantalgebruikers;
}