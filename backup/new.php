<!DOCTYPE HTML>
<html>
    <head>
        <title>Neuer Eintrag</title>
    </head>
    <body>
    <form action="" method="post">
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
            <label>Anmerkung:
                <input type="text" name="anmerkung" id="anmerkung">
            </label>
            <input type="submit"  name="submit"  value="speichern">
        </div>
    </form>
    </body>
</html>

<?php

$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');

if (isset($_POST['submit']))
{

}
else
{

}




?>