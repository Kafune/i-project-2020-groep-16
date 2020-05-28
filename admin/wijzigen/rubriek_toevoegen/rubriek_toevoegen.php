<?php
include_once('../../../includes/header.php');
include_once('../../menu.php');
include_once('../../../includes/db.php');

if (isset($_GET['id'])) {
    $sql = "SELECT r1.rubrieknummer, r1.rubrieknaam as rubrieknaam1, r1.rubriek, r2.rubrieknaam as rubrieknaam2
            FROM Rubriek as r1
            LEFT JOIN Rubriek as r2 ON r1.rubriek = r2.rubrieknummer
            WHERE r1.Rubriek = :rubrieknummer ORDER BY r1.rubrieknaam ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':rubrieknummer', $_GET['id']);
} else if (empty($_GET['id'])) {
    $sql = "SELECT r1.rubrieknummer, r1.rubrieknaam as rubrieknaam1, r1.rubriek, r2.rubrieknaam as rubrieknaam2
            FROM Rubriek as r1
            LEFT JOIN Rubriek as r2 ON r1.rubriek = r2.rubrieknummer 
            WHERE r1.Rubriek = -1 ORDER BY r1.rubrieknaam";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
?>

<div class="column is-9">
    <div class="columns" style="padding-top: 3rem">
        <div class="column is-8">
            <div class="card events-card">
                <header class="card-header">
                    <p class="card-header-title">
                        Rubrieken
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                    </a>
                </header>
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped">
                            <tbody>
                            <?php

                            while ($row = $stmt->fetch()) {
                                $rubrieknaam = $row['rubrieknaam1'];
                                $parentnaam = $row['rubrieknaam2'];
                                $parent = $row['rubriek'];
                                $id = $row['rubrieknummer'];

                                echo "
                                <tr>
                                <td width=\"5%\"><i class=\"fa fa-bookmark\"></i></td>
                                <td>" . $parentnaam . "</td>
                                <td>" . $rubrieknaam . "</td>
                                <td><a class=\"button is-small is-primary\" href=\"/admin/wijzigen/rubriek_toevoegen.php?id=" . $id . "\">Sub-rubrieken</a></td>
                                <td class=\"level-right\"><a class=\"button is-small is-primary\" href=\"rubriek_toevoegen_naam.php?id=" . $id . "\">Kies parent</a></td>
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
