<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/design.css" rel="stylesheet">
</head>
<body>
<main>
    <h1>Vertretungsplan</h1>
    <?php
    $heute = date('Y-m-d');
    $morgen = strtotime("+1 day");
    $datummorgen = date("Y-m-d", $morgen);
    ?>
    <a>Vertretungsplan für einen anderen Tag anzeigen</a><br><br>
    <form action="index.php" method="get">
        <input class='textfield' type="date" name="datum" id="datum" value="<?php if (isset($_GET['datum'])) {
            $vpdatum = $_GET['datum'];
            echo $vpdatum;
        } else {
            echo $datummorgen;
        } ?>">
        <button class='loginbtn' type="Submit" value="OK">OK</button>
    </form>
    </br>
    <?php
    session_start();

    $pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');
    //$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'vpweb', '3052cNs3?qRu@5G');

    if (isset($_GET['datum'])) {
        $vpdatum = $_GET['datum'];
        $zaehler = 0;
        $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';
        foreach ($pdo->query($sql) as $row) {
            $zaehler += 1;
        }
        if ($zaehler == 0) {
            echo "<a href=''style='text-decoration:none'> Es gibt keinen Vertretungsplan für diesen Tag.</a>";
        } else {
            if (file_exists("./docs/fehlendekollegen/" . $vpdatum . ".txt")) { // gucke ob eine datei für fehelbde kollegen für den tag existiert
                $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen/' . $vpdatum . '.txt');
                echo "<a class='abstand' href=''style='text-decoration:none'>Fehlende Kollegen: " . $fehlende_kollegen . "</a>";
            }
            echo '<table>';
            echo '<th><a class="th" href=""> Stunde </th>';
            echo '<th><a class="th" href=""> Klasse </th>';
            echo '<th><a class="th" href=""> Vertretung </th>';
            echo '<th><a class="th" href=""> Fach </th>';
            $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';
            foreach ($pdo->query($sql) as $row) {
                echo "<tr>";
                echo '<td><a class="td" href="">' . $row['stunde'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['klasse'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['vertretung'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['fach'] . '</a></td>';
                echo "</tr>";
            }
            echo '</table>';
            echo '</br>';
            echo '<a href="drucken.php?datum=' . $vpdatum . '">PDF Download</a>';
        }
        if (isset($_SESSION['loggedin'])) {
            echo "<meta http-equiv='refresh' content='0; URL=editor.php'>";
        } else {
            echo "<script src='js/NotLoggedIn.js'></script>";
        }
    } else { //ANZEIGEN WENN KEIN DATUM AUSGEWÄHLT WURDE
        $vpdatum = $heute;
        $zaehler = 0;
        $sql = 'SELECT * FROM plan WHERE datum="' . $heute . '" ORDER BY klasse';
        foreach ($pdo->query($sql) as $row) {
            $zaehler += 1;
        }
        if ($zaehler == 0) {
            echo "<a id='Error' href=''style='text-decoration:none'> Es gibt keinen Vertretungsplan für heute.</a>";
        } else {
            echo "<a class='abstand' href=\"\"style=\"text-decoration:none\">Fehlende Kollegen:</a>";
            $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen/' . $heute . '.txt');
            echo "<a class='abstand' href=\"\"style=\"text-decoration:none\">$fehlende_kollegen</a>";
            echo '<table>';
            echo '<th><a class="th" href=""> Stunde </th>';
            echo '<th><a class="th" href=""> Klasse </th>';
            echo '<th><a class="th" href=""> Vertretung </th>';
            echo '<th><a class="th" href=""> Fach </th>';
            $sql = 'SELECT * FROM plan WHERE datum="' . $heute . '" ORDER BY klasse';
            foreach ($pdo->query($sql) as $row) {
                echo "<tr>";
                echo '<td><a class="td" href="">' . $row['stunde'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['klasse'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['vertretung'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['fach'] . '</a></td>';
                echo "</tr>";
            }
            echo '</table>';
            echo '</br>';
            echo '<br/>';
            echo '<a href="drucken.php?datum=' . $vpdatum . '">PDF Download</a>';
        }
        if (isset($_SESSION['loggedin'])) {
            echo "<meta http-equiv='refresh' content='0; URL=editor.php'>";
        } else {
            echo "<script src='js/NotLoggedIn.js'></script>";
        }
    }
    ?>
</main>
</body>
</html>
