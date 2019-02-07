<!DOCTYPE HTML>
<html>
    <head>
        <title>Neuer Eintrag</title>
    </head>
    <body>
    </form>
    <?php
    $datum = $_GET['datum'];
    ?>
    <form action="php/EintragSpeichern.php" method="get">
        <div>
            <label>Stunde:
                <input type="text" name="stunde" id="stunde">
            </label>
            <label>Klasse:
                <input type="text" name="klasse" id="klasse">
	    </label>
            <label>Vertretung:
                <input type="text" name="vertretung" id="vertretung">
	    </label>
	    <label>Fach:
                <input type="text" name="fach" id="fach">
            </label>
            <label>Anmerkung:
                <input type="text" name="anmerkung" id="anmerkung">
            </label>
            <label>Datum:
                <input type="date" name="datum" id="datum" value="<?php echo $datum ?>">
            </label>
            <input type="submit"  name="submit" value="speichern">
        </div>

    </body>
</html>


