<?php
if (empty($_SESSION['admin'])) {
    header('Location:../index.php');
}
?>

<div class="container">
    <div class="columns">
        <div class="column is-2" style="padding-top: 3rem">
            <aside class="menu is-centered">
                <p class="menu-label">
                    General
                </p>
                <ul class="menu-list">
                    <li><a href="/admin/index.php" ">Dashboard</a></li>
                </ul>
                <p class="menu-label">
                    Adminstratie
                </p>
                <ul class="menu-list">
                    <li><a href="/admin/gebruikers.php">Gebruikers</a></li>
                    <li>
                        <a>Rubrieken</a>
                        <ul>
                            <li><a href="/admin/rubrieken.php">Wijzigen</a></li>
                            <li><a href="/admin/wijzigen/rubriek_toevoegen/rubriek_toevoegen.php?status=kiesparent">Toevoegen</a></li>
                            <li><a href="/admin/wijzigen/rubriek_verwijderen.php?">Verwijderen</a></li>
                        </ul>
                    </li>
                </ul>
                <p class="menu-label">
                    Rapporten
                </p>
                <ul class="menu-list">
                    <li><a>Gebruikers</a></li>
                    <li><a>Verkopers</a></li>
                    <li><a>Voorwerpen</a></li>
                    <li><a>Rubrieken</a></li>
                </ul>
            </aside>
        </div>