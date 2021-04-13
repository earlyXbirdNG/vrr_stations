<?php

// Datenbankverbindung öffnen
require 'secret_webinterface_admin.php';

// Fehler abfangen
if (!$dbconnect) {
    die("Die Verbindung zur Datenbank konnte nicht hergestellt werden. Bitte wende dich an einen Administrator zur weiteren Unterstzützung.");
}


if (isset($_POST["submit"])) {
    // mysqli_real_escape_string() sorgt dafür, dass eingegebener Text nicht als SQL-Befehl
    // verstanden werden kann (z.B. Anführungszeichen koennten sonst für Probleme sorgen)
   // $id = mysqli_real_escape_string($dbconnect, $_POST["id"]);
   // $status = mysqli_real_escape_string($dbconnect, $_POST["status"]);
   // $nutzer = mysqli_real_escape_string($dbconnect, htmlentities($_SERVER["HTTP_X_USER"]));


    // SQL-Abfrage definieren
    $sql = "UPDATE `stations` SET status = 'Offen' WHERE id IS NOT NULL";

    // Abfrage durchfuehren
    $result = mysqli_query($dbconnect, $sql);

}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Stations - internetz.app</title>
</head>
<body>
<div class="wrapper">
<a href="../index.php" class="button_home">Startseite</a>
<a href="stationmaster.php" class="button_admin">Admin</a>
<br><br>
<br><br>

<img src="../img/sbahn.png" alt="Banner: RRX">


<!--  <a href="admin_login.php" class="button_home">Administrieren</a>  -->
    <main>
    
        <h1>Ergebnis Deiner Anfrage</h1>

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
                    echo "Die Stationen wurden erfolgreich zurückgesetzt.";
                }
                // SQL-Fehler
                else {
                    echo "Huch, ein Fehler. Das sollte nicht passieren. Fehlercode: <code>" . mysqli_error($dbconnect) . "</code><br>" .
                        "Gehe zurück und versuche es erneut Wenn der Fehler wiederholt auftritt,<br>" .
                        "wende dich bitte an den Support.<br>";
                }

                ?>
            </b>
        </p>

        <a href="../index.php" class="button">Stationsübersicht</a>
        <a href="stationmaster.php" class="button button-green">Zurück</a>
    </main>
</div>
</body>
</html>