<?php

// Datenbankverbindung öffnen
require 'secret_webinterface.php';

// Fehler abfangen
if (!$dbconnect) {
    die("Die Verbindung zur Datenbank konnte nicht hergestellt werden. Bitte wende dich an einen Administrator zur weiteren Unterstzützung.");
}

// SQL-Abfrage definieren
$sql = "SELECT * FROM stations";

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
       <!-- <img src="img/banner_grillparty.jpg" alt="Banner: Grillparty"> -->
        <h1>Station aktualisieren</h1>
        <p>
            Waehle die Station die du aktualisieren moechtest.
        </p>
      <!--  <p><strong>Platzhater fuer einen fetten Text</strong></p> -->
      <form action="update.php" method="post">
            
            <label for='id'>Station:</label><br>
            <select id="id" name="id" placeholder="Station" required>
            <?php
                if($num > 0){

                    while ($dataset = mysqli_fetch_assoc($result)) {
                        echo "<option value=" . htmlentities($dataset["id"]) . ">" . htmlentities($dataset["station"]) . "</option>";
                    }                
                }
            ?>
            </select>                    
                <br><br>

                <label for="status">Status:</label><br>
                <select id="status" name="status" placeholder="Neuer Status" required>
                    <option value="Erhoben">Erhoben</option>
                    <option value="Offen">Offen</option>
                    </select>
                <br><br>

                <label for="nutzer">Deine Initalien:</label><br>
                <input type="text" id="nutzer" name="nutzer" placeholder="z.B. VRR" required>
                <br><br>

                <input type="submit" id="submit" name="submit" value="Senden" class="button">
        </form>
    </main>
</div>
</body>
</html>