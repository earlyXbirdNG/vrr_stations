<?php

// Datenbankverbindung öffnen
require 'secret_webinterface.php';

// Fehler abfangen
if (!$dbconnect) {
    die("Die Verbindung zur Datenbank konnte nicht hergestellt werden. Bitte wende dich an einen Administrator zur weiteren Unterstzützung.");
}

// SQL-Abfrage definieren
$sql = 'SELECT station, status, DATE_FORMAT(datum, "%e.%m.%y") AS datum, nutzer FROM stations WHERE status="Offen" OR status="Reserviert" ORDER BY station';
$sql_count_reserved = 'SELECT station FROM stations WHERE status="Reserviert"';

// SQL-Abfrage durchfuehren
$result = mysqli_query($dbconnect, $sql);
$result_count_reserved = mysqli_query($dbconnect, $sql_count_reserved);

// Anzahl der Datensaetze ermitteln
$num = mysqli_num_rows($result);
$num_reserved = mysqli_num_rows($result_count_reserved);


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>StationKit - internetz.app</title>
    <style>

    </style>
</head>
<body>
<div class="wrapper">

<a href="index.php" class="button_home">Startseite</a>
<a href="tp/stationmaster.php" class="button_admin">Admin</a>
<br><br>
<br><br>

<img src="img/sbahn.png" alt="Banner: RRX">


<!--    <a href="admin_login.php" class="button_home">Administrieren</a>  -->
    <main>
    
        <h1>Stationsübersicht</h1>
        <warntext>Unwetterschäden im Rhein/Ruhr-Gebiet. Einige Stationen sind nicht befahrbar und daher</warntext><br>
        <warntext>als Reserviert durch UNWETTER gekennzeichnet. Dies betrifft zzT. 12 Stationen.</warntext><br>

        <?php
        echo "<h3>(Offen: " . htmlentities($num) . " Stationen, beinhaltet " . htmlentities($num_reserved) . " reservierte Stationen) </h3>";
        ?>

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