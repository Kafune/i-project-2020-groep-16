<?php
include_once("../includes/header.php");
include_once("../includes/db.php");
?>
    <div class="columns">
        <div class="column" style="padding-left: 3rem">
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
                    echo "<li><a href='rubrieken.php?volgnr=1'>Rubrieken</a></li>";
                    $reversed_namen = array_reverse($namen);
                    $reversed_nummer = array_reverse($nummer);

                    for ($i=0; $i< count($reversed_namen);$i++){
                        echo "<li><a href='rubrieken.php?rubriek=" . $reversed_nummer[$i] ."'>" . $reversed_namen[$i] . "</a></li>";
                    }
                    ?>
                </ul>
            </nav>
            <?php

            if (!isset($_GET['rubriek'])) {
                $sql = "SELECT * FROM Rubriek WHERE rubriek = -1 ORDER BY rubrieknaam ASC";

                $result = $conn->prepare($sql);
                $result->execute();

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['rubrieknummer'];
                    $rubriek = $row['rubrieknaam'];
                    $rubrieknr = $row['rubrieknummer'];
                    echo '<a href="rubrieken.php?rubriek=' . $id . '"> '.$rubriek.'</a><br>';
                }
            } else {
                $sql = "SELECT * FROM Rubriek WHERE rubriek = :rubrieknummer ORDER BY rubrieknaam ASC";

                $result = $conn->prepare($sql);
                $result->bindParam(':rubrieknummer', $_GET['rubriek']);
                $result->execute();

                if(empty($result->fetch(PDO::FETCH_ASSOC))){
                    header("Location: voorwerptoevoegen.php?rubriek=".$_GET['rubriek']."");
                }

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['rubrieknummer'];
                    $rubriek = $row['rubrieknaam'];
                    $rubrieknr = $row['rubrieknummer'];
                    echo '<a href="rubrieken.php?rubriek=' .$id. '"> '.$rubriek.'</a><br>';
                }
            }
            ?>
        </div>
    </div>

<?php
include_once("../includes/footer.php");
?>