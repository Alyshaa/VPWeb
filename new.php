<!DOCTYPE HTML>
<html>
    <head>
        <title>Neuer Eintrag</title>
    </head>
    <body>
    <form action="" method="post">
        <div>
            <form action="" method="post">
            <label>Klasse:
                <input type="text" name="vorname" id="vorname">
            </label>
            <label>Vertretung:
                <input type="text" name="nachname" id="nachname">
            </label>
            <input type="submit"  name="submit"  value="speichern">
    </form>
        </div>
    </form>
    </body>
</html>

<?php

$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');

if (isset($_POST['submit']))

{
    $statement = $pdo->prepare("INSERT INTO plan (id, Klasse, Vertretung) VALUES (?, ?, ?)");
    $statement->execute(array('', '1', '30'));

        header("Location: editor.php");
    }

else
{
    //header("Location: new.php");
}
?>