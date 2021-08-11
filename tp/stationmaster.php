<?php

// Datenbankverbindung öffnen
require 'secret_webinterface_admin.php';

// Fehler abfangen
if (!$dbconnect) {
    die("Die Verbindung zur Datenbank konnte nicht hergestellt werden. Bitte wende dich an einen Administrator zur weiteren Unterstzützung.");
}

// SQL-Abfrage definieren
$sql = "SELECT * FROM stations ORDER BY station";

// SQL-Abfrage durchfuehren
$result = mysqli_query($dbconnect, $sql);

// Anzahl der Datensaetze ermitteln
$num = mysqli_num_rows($result);


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style.css"/>
    <title>StationKit - internetz.app</title>
    <style>

    </style>
</head>
<body>
<div class="wrapper">


<a href="../index.php" class="button_home">Startseite</a>
<a href="stationmaster.php" class="button_admin">Admin</a>
<br><br>
<br><br>

<img src="../img/sbahn.png" alt="Banner: RRX">


<!-- <a href="admin_login.php" class="button_home">Administrieren</a> -->
    <main>
        <h1>Admin-Center</h1>
        
        <p>
            <h3>Station hinzufügen</h3>


            <form action="add_station.php" method="post">
            <div>
                    <label for="name">Name:</label><br> 
                    <input type="text" name="name" id="name" placeholder="Stationsname" maxlength="128"/>
            </div>
            <br>      
            <input type="submit" id="submit" name="submit" value="Senden" class="button_red">
        </form>
        </p>
        <br>
        <hr>
        <br>
        <p>
            <warnhead2>Gefahrenbereich</warnhead2><br><br>
            <warnhead3>Stationen zurücksetzen</warnhead3><br>
            <warntext>Diese Aktion setzt alle Stationen unwiderruflich auf den Status "Offen" zurück.</warntext><br>
            <form action="reset_stations.php" method="post">
                <div>   
                        <input type="checkbox" id="agreement" name="agreement" required>
                        <label for="agreement"><warntext>Ich weiß was ich tue.</warntext></label>
                </div>
                <br>
                <input type="submit" id="submit" name="submit" value="Zurücksetzen" class="button_red">
            </form>
        </p>
        <br>
        <p>
            <warnhead3>Station löschen</warnhead3><br><br>
            <warntext>Diese Aktion löscht eine Station permanent und unwiderruflich!</warntext><br>
                <form action="delete_station.php" method="post">

                    <label for='id'>Station:</label><br>
                    <select id="id" name="id" placeholder="Station" required>
                    <?php
                        if($num > 0){

                            while ($dataset = mysqli_fetch_assoc($result)) {
                                echo "<option value=" . htmlentities($dataset["id"]) . ">" . htmlentities($dataset["station"]) . "</option>";
                            //  echo "<option value=" . htmlentities($dataset["id"]) . ">" . htmlentities($dataset["station"]) . " (" . htmlentities($dataset["status"]) . ")" . "</option>";
                            }                
                        }
                    ?>
                    </select>                    
                        <br>
                        <br>
                        <div>   
                            <input type="checkbox" id="agreement" name="agreement" required>
                            <label for="agreement"><warntext>Ich weiß was ich tue.</warntext></label>
                        </div>
                        <br>
                        <input type="submit" id="submit" name="submit" value="Senden" class="button_red">
                    </form>
                <br>
                <br>
                <br>
                <a href="../index.php" class="button">Stationsübersicht</a>
    </main>
</div>
</body>
</html>