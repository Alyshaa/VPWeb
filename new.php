<!DOCTYPE HTML>
<html>
<head>
    <title>Neuer Eintrag</title>
    <link href="css/designnew.css" rel="stylesheet">
</head>
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<body>
<?php
$datum = $_GET['datum'];
?>
<main>
    <a class="loginbtn" href="editor.php?datum=<?php if (isset($_GET['datum'])) {
        $vpdatum = $_GET['datum'];
        echo $vpdatum;
    } else {
        echo $datummorgen;
    } ?> "> zurück </a><br>
    <h1 class="abstand">Eintrag hinzufügen</h1>
    <article>
        <form action="php/EintragSpeichern.php" method="get">
            <div>
                <label>Stunde:</label><br><br>
                <label>Klasse:</label><br><br>
                <label>Vertretung:</label><br><br>
                <label>Fach:</label><br><br>
                <label>Anmerkung:</label><br><br>
                <label>Datum:</label>
            </div>
    </article>
    <aside>
        <select class="pos1 textfield" type="text" name="stunde" id="stunde" list="stunde2">
            <option value="" hidden>Stunde auswählen:</option>
            <option>0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
        </select><br>
        <input class="pos1 textfield" type="text" name="klasse" id="klasse" maxlength="2"><br>
        <input class="pos1 textfield" type="text" name="vertretung" id="vertretung" maxlength="30"><br>
        <input class="pos1 textfield" type="text" name="fach" id="fach" maxlength="5"><br>
        <input class="pos1 textfield" type="text" name="anmerkung" id="anmerkung"><br>
        <input class="pos1 textfield" type="date" name="datum" id="datum" value="<?php echo $datum ?>">
        <input class="loginbtn spnbtn" type="submit" name="submit" value="speichern">
        </form>
    </aside>
</main>


</body>
</html>
