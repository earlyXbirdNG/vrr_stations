<?php

// Datenbankverbindung öffnen
require 'secret_webinterface.php';

// Fehler abfangen
if (!$dbconnect) {
    die("Die Verbindung zur Datenbank konnte nicht hergestellt werden. Bitte wende dich an einen Administrator zur weiteren Unterstzützung.");
}


if (isset($_POST["submit"])) {
    // mysqli_real_escape_string() sorgt dafuer, dass eingegebener Text nicht als SQL-Befehl
    // verstanden werden kann (z.B. Anfuehrungszeichen koennten sonst fuer Probleme sorgen)
    $query = mysqli_real_escape_string($dbconnect, $_POST["query"]);

    // SQL-Abfrage definieren
    $sql = "SELECT station, status, DATE_FORMAT(datum, \"%e.%m.%y\") AS datum, nutzer FROM stations WHERE station LIKE '%" . $query . "%' ORDER BY station";

    // Abfrage durchfuehren
    $result = mysqli_query($dbconnect, $sql);

    // Anzahl der Datensaetze ermitteln
    $num = mysqli_num_rows($result);

}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>StationKit - internetz.app</title>
</head>
<body>
<div class="wrapper">

<a href="index.php" class="button_home">Startseite</a>
<a href="tp/stationmaster.php" class="button_admin">Admin</a>
<br><br>
<br><br>

<img src="img/sbahn.png" alt="Banner: RRX">

<!--  <a href="admin_login.php" class="button_home">Administrieren</a>  -->
    <main>
    
        <h1>Stationssuche</h1>
        <warntext>Unwetterschäden im Rhein/Ruhr-Gebiet. Einige Stationen sind nicht befahrbar und daher</warntext><br>
        <warntext>als Erhoben durch UNWETTER gekennzeichnet. Diese Stationen sind jedoch nicht erhoben, sondern</warntext><br>
        <warntext>nur so hinterlegt, damit sie aus den Statistiken rausgerechnet werden. Zum Reservieren oder erheben</warntext><br>
        <warntext>einfach überschreiben.</warntext><br>
        <br>

        <p>
            <b>
                <?php

                // Pruefen, ob direkt oder durch Formular abgerufen
                if (!isset($_POST["submit"])) {
                    echo "Unbekannter Fehler (120).<br>" .
                        "Gehe zurück und versuche es erneut Wenn der Fehler wiederholt auftritt,<br>" .
                        "wende dich bitte an den Support.<br>";
                }
                // Durch Formular, aber keine Daten angegeben
                elseif (!isset($_POST["submit"])) {
                    echo "Leeres Formular (121).<br>" .
                    "Gehe zurück und versuche es erneut Wenn der Fehler wiederholt auftritt,<br>" .
                    "wende dich bitte an den Support.<br>";
                }
                // Pruefen ob  Erfolg
                elseif (isset($result) && $result) {
                    echo "Suche nach " . $query . "</b> :.";
                }
                // SQL-Fehler
                else {
                    echo "Huch, ein Fehler. Das sollte nicht passieren. Fehlercode: <code>" . mysqli_error($dbconnect) . "</code><br>" .
                        "Gehe zurück und versuche es erneut Wenn der Fehler wiederholt auftritt,<br>" .
                        "wende dich bitte an den Support.<br>";
                }

                ?>


            </b>

    

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

        <a href="edit_station.php" class="button_small">Neue Meldung</a>

        </p>


    </main>
</div>
</body>
</html>