﻿<?php

// Datenbankverbindung öffnen
require 'secret_webinterface.php';

// Fehler abfangen
if (!$dbconnect) {
    die("Die Verbindung zur Datenbank konnte nicht hergestellt werden. Bitte wende dich an einen Administrator zur weiteren Unterstzützung.");
}

// SQL-Abfrage definieren
$sql = "SELECT * FROM stations WHERE status='Offen'";

// SQL-Abfrage durchfuehren
$result = mysqli_query($dbconnect, $sql);

// Anzahl der Datensaetze ermitteln
$num = mysqli_num_rows($result);


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Stations - internetz.app</title>
    <style>

    </style>
</head>
<body>
<div class="wrapper">
    <a href="index.php" class="button_home">Startseite</a>
    <a href="admin_login.php" class="button_home">Administrieren</a>
    <main>
    
        <h1>Stationsübersicht</h1>
        <p>
            Folgend siehst du eine Auflistung aller Stationen im VRR und deren Erhebungsstatus.
        </p>

        <a href="edit_station.php" class="button_small">Neue Meldung</a>
        <a href="erfasst.php" class="button_small">Nur erfasste zeigen</a>
        <a href="index.php" class="button_small">Alle zeigen</a>

        <!-- Suche -->
        <form action="search.php" method="post">
            
                <label for="query"></label><br>
                <input type="text" id="query" name="query" placeholder="Station finden..." required>
                
                <input type="submit" id="submit" name="submit" value="Finden">
        </form>
        <br>

      <!--  <p><strong>Platzhater fuer einen fetten Text</strong></p> -->
        <table>
            <thead>
            <tr>
                <th>Station</th>
                <th>Status</th>
                <th>Datum</th>
                <th>Nutzer</th>
                <th>Interne ID</th>
            </tr>
            </thead>
            <tbody>
            <!-- Ausgabe der Datensaetze */  -->

            <?php


            if($num > 0){

                while ($dataset = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "<td>" . htmlentities($dataset["station"]) . "</td>\n";
                    echo "<td>" . htmlentities($dataset["status"]) . "</td>\n";
                    echo "<td>" . htmlentities($dataset["datum"]) . "</td>\n";
                    echo "<td>" . htmlentities($dataset["nutzer"]) . "</td>\n";
                    echo "<td>" . htmlentities($dataset["id"]) . "</td>\n";
                    echo "</tr>\n";
                }                
            }
            ?>

            </tbody>
        </table>
    </main>
</div>
</body>
</html>