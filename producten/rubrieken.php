<?php
include_once("../includes/header.php");
include_once("../includes/db.php");

$sql = "SELECT * FROM Rubriek WHERE volgnr = 1";
$resultaat = $dbh->query($sql);
?>

<div class="has-background-black has-text-white">
    <div class="container">
        <?php
        if ($resultaat->rowCount() > 0) {
            while ($row = $resultaat->fetch()) {
                $rubriek = $row['rubrieknaam'];
                echo "<p>$$rubriek</p>";
            }
        ?>
    </div>
</div>
<?php
include_once("/includes/footer.php");
?>
