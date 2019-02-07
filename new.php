<!DOCTYPE HTML>
<html>
    <head>
        <title>Neuer Eintrag</title>
        <link href="css/designnew.css" rel="stylesheet">
    </head>
    <body>
    <?php
    $datum = $_GET['datum'];
    ?>
    <main>
        <h1>Eintrag hinzufügen</h1>
        <article>
            <form action="php/EintragSpeichern.php" method="get">
                <div>
                    <label>Stunde:</label><br><br>
                    <label>Klasse:</label><br><br>
                    <label>Vertretung:</label><br><br>
                    <label>Fach:</label><br><br>
                    <label>Anmerkung:</label>
                </div>
        </article>
        <aside>
            <select class="pos1 textfield" type="text" name="stunde" id="stunde" list="stunde2">
                <option value="" hidden>Stunde auswählen:</option>
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
            </select>
            <input class="pos1 textfield" type="text" name="klasse" id="klasse" maxlength="2">
            <input class="pos1 textfield" type="text" name="vertretung" id="vertretung" maxlength="30">
            <input class="pos1 textfield" type="text" name="fach" id="fach" maxlength="5">
            <input class="pos1 textfield" type="text" name="anmerkung" id="anmerkung">
            <input type="date" name="datum" id="datum" value="<?php echo $datum ?>">
            <input class="loginbtn spnbtn" type="submit" name="submit" value="speichern">
            </form>
        </aside>
    </main>


    </body>
</html>


