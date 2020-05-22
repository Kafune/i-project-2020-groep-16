<?php
include_once("includes/header.php");
include_once("includes/db.php");
?>
    <div class="columns">
        <div class="column is-half" style="padding-left: 3rem">
            <nav class="breadcrumb" aria-label="breadcrumb">
                <ul>
                    <?php
                    $id = $_GET['rubriek'];

                    while ($id > 0) {
                        $sql_breadcrumb = "SELECT * FROM Rubriek WHERE rubrieknummer = :id";

                        $breadcrumb_result = $conn->prepare($sql_breadcrumb);
                        $breadcrumb_result->bindParam(':id', $id);

                        $breadcrumb_result->execute();

                        $resultaten = $breadcrumb_result->fetch(PDO::FETCH_ASSOC);

                        $namen[] = $resultaten['rubrieknaam'];
                        $nummer[] = $resultaten['rubrieknummer'];

                        $id = $resultaten['rubriek'];

                    }
                    echo "<li><a href='rubriekenboom.php?'>Rubrieken</a></li>";
                    $reversed_namen = array_reverse($namen);
                    $reversed_nummer = array_reverse($nummer);

                    for ($i = 0; $i < count($reversed_namen); $i++) {
                        echo "<li><a href='rubriekenboom.php?rubriek=" . $reversed_nummer[$i] . "'>" . $reversed_namen[$i] . "</a></li>";
                    }
                    ?>
                </ul>
            </nav>
            <?php
            if (!isset($_GET['rubriek'])) {
                $sql = "SELECT * FROM Rubriek WHERE rubriek = -1 ORDER BY rubrieknaam ASC";

                $result = $conn->prepare($sql);
                $result->execute();

                echo '
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped">
                            <tbody>';

                while ($row = $result->fetch()) {
                    $rubrieknummer = $row['rubrieknummer'];
                    $rubrieknaam = $row['rubrieknaam'];

                    echo "
                    <tr>
                    <td width=\"5%\"><i class=\"fa fa-cube\"></i></td>
                    <td>" . $rubrieknaam . "</td>
                    <td><a class=\"button is-small is-primary\" 
                    href='rubriekenboom.php?rubriek=" . $rubrieknummer . "'>Sub-rubrieken</a></td>
                    <td class=\"level-right\"><a class=\"button is-small is-primary\" 
                    href='index.php?parent=" . $rubrieknummer . "'>Voorwerpen</a></td>
                    </tr>";
                }
            } else {
                $sql = "SELECT * FROM Rubriek WHERE rubriek = :rubrieknummer ORDER BY rubrieknaam ASC";

                $result = $conn->prepare($sql);
                $result->bindParam(':rubrieknummer', $_GET['rubriek']);
                $result->execute();

                echo '
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped">
                            <tbody>';

                while ($row = $result->fetch()) {
                    $rubrieknummer = $row['rubrieknummer'];
                    $rubrieknaam = $row['rubrieknaam'];

                    echo "
                    <tr>
                    <td width=\"5%\"><i class=\"fa fa-cube\"></i></td>
                    <td>" . $rubrieknaam . "</td>
                    <td><a class=\"button is-small is-primary\" 
                    href='rubriekenboom.php?rubriek=" . $rubrieknummer . "'>Sub-rubrieken</a></td>
                    <td class=\"level-right\"><a class=\"button is-small is-primary\" 
                    href='index.php?parent=" . $rubrieknummer . "'>Voorwerpen</a></td>
                    </tr>";
                }
            }
            ?>
            </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>

<?php
include_once("includes/footer.php");
?>