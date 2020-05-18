<?php
include_once("../includes/header.php");
include_once("../includes/db.php");
?>
    <div class="columns">
        <div class="column">
            <nav class="breadcrumb" aria-label="breadcrumb">
                <ul>
                    <?php
                    $parentnr = $_GET['parent'];
                    $volgnr = $_GET['volgnr'];

                    while ($volgnr != 1) {
                        $sql_breadcrumb = "SELECT * FROM Rubriek WHERE rubrieknummer = :parentnr";

                        $breadcrumb_result = $conn->prepare($sql_breadcrumb);
                        $breadcrumb_result->bindParam(':parentnr', $parentnr);

                        $breadcrumb_result->execute();

                        $row = $breadcrumb_result->fetch(PDO::FETCH_ASSOC);

                        $naam = $row['rubrieknaam'];
                        $parentnr = $row['rubriek'];
                        $rubrieknr = $row['rubrieknummer'];
                        $volgnr = $row['volgnr'];
                        $breadcrumb_volgnr = $row['volgnr'] + 1;

                        echo "<li><a href='rubrieken.php?parent=" . $rubrieknr . "&volgnr=" . $breadcrumb_volgnr . "'>" . $rubrieknr . $naam . "</a></li>";
                    }
                    echo "<li><a href='rubrieken.php?volgnr=1'>Rubrieken</a></li>";

                    ?>
                </ul>
            </nav>
            <h1>Rubrieken</h1>
            <?php

            if ($_GET['volgnr'] == 1) {
                $sql = "SELECT * FROM Rubriek WHERE volgnr = 1";

                $result = $conn->prepare($sql);
                $result->execute();

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $volgnr = $row['volgnr'] + 1;
                    $id = $row['rubrieknummer'];
                    $rubriek = $row['rubrieknaam'];
                    $rubrieknr = $row['rubrieknummer'];
                    echo '<a href="rubrieken.php?parent=' . $id . '&volgnr=' . $volgnr . '">' . $rubrieknr . " " . $rubriek . '</a><br>';
                }
            } else {
                $parent = $_GET['parent'];
                $sql1 = "SELECT * FROM Rubriek WHERE Rubriek = :parent ORDER by rubrieknaam ASC";

                $result = $conn->prepare($sql1);
                $result->bindParam(':parent', $parent);
                $result->execute();

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $volgnr = $row['volgnr'] + 1;
                    $id = $row['rubrieknummer'];
                    $parent = $row ['rubriek'];
                    $rubriek = $row['rubrieknaam'];
                    if ($_GET['parent'] != $id) {
                        echo '<a href="rubrieken.php?parent=' . $id . '&volgnr=' . $volgnr . '">' . $id . " " . $rubriek . '</a><br>';
                    }
                }
            }
            ?>
        </div>
    </div>

<?php
include_once("../includes/footer.php");
?>