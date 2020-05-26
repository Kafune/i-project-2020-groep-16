<?php
if(empty($_SESSION['admin'])){
    header('Location:../index.php');
}
?>

<div class="container">
    <div class="columns">
        <div class="column is-3" style="padding-top: 3rem">
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
                    <li><a href="/admin/rubrieken.php">Rubrieken</a></li>
<!--                    <li><a href="/admin/voorwerpen.php">Voorwerpen</a></li>-->
<!--                    <li><a>Cloud Storage Environment Settings</a></li>-->
<!--                    <li><a>Authentication</a></li>-->
<!--                    <li><a>Payments</a></li>-->
                </ul>
            </aside>
        </div>