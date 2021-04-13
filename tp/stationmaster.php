<?php

// Datenbankverbindung öffnen
require 'secret_webinterface_admin.php';

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
    <link rel="stylesheet" type="text/css" href="../style.css"/>
    <title>Stations - internetz.app</title>
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
            <h3>Station löschen</h3>


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
                <br><br>
                <label for="nutzer">Angemeldeter Nutzer:</label><br>
                <input disabled required type="text" id="nutzer" name="nutzer" value="<?php echo htmlentities($_SERVER["HTTP_X_USER"]); ?>">
                <input type="submit" id="submit" name="submit" value="Senden" class="button_red">
        </form>


        </p>
        <br>
        <hr>
        <br>
        <p>
            <h3>Station hinzufügen</h3>


            <form action="add_station.php" method="post">
            <div>
                    <label for="name">Name:</label><br> 
                    <input type="text" name="name" id="name" placeholder="Stationsname" maxlength="128"/>
            </div>      
            <input type="submit" id="submit" name="submit" value="Senden" class="button_red">
        </form>
        </p>
        <br>
        <hr>
        <br>
        <p>
            <warnhead2><strong>Gefahrenbereich:</strong></warnheadh2><br>
            <warnhead3>Stationen zurücksetzen</warnhead3><br>
            <warntext>Diese Aktion setzt alle Stationen unwiderruflich auf den Status "Offen" zurück.</warntext><br>
            <form action="reset_stations.php" method="post">
                <div>   
                        <input type="checkbox" id="agreement" name="agreement" required>
                        <label for="agreement">Ich weiß was ich tue.</label>
                </div>
                <input type="submit" id="submit" name="submit" value="Zurücksetzen" class="button_red">
            </form>
        </p>
        <br>
        <br>
        <a href="../index.php" class="button">Stationsübersicht</a>
    </main>
</div>
</body>
</html>