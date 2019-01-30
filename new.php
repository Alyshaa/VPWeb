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
    //$statement = $pdo->prepare("INSERT INTO plan (id, stunde, klasse, vertretung, annmerkung) VALUES (?, ?, ?;?,?)");
    //$statement->execute(array('', '1', '8', 'Mathematik mit frau x', 'Könnte sich noch ändern'));

    $stunde = trim($_POST['Stunde']);
    $klasse = trim($_POST['klasse']);
    $vertretung = trim($_POST['vertretung']);
    $anmerkung = trim($_POST['anmerkung']);

    $statement = $pdo->prepare("INSERT INTO plan (stunde, klasse, vertretung, anmerkung) VALUES (:name, :email, :text)");
    $result = $statement->execute(array('stunde' => $stunde, 'klasse' => $klasse, 'vertretung' => $vertretung, 'anmerkung' => $anmerkung));

        header("Location: editor.php");
    }

else
{
    //header("Location: new.php");
}




?>