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
        <input class='textfield' type="date" name="datum" id="datum" value="<?php echo $datummorgen ?>">
        <input class='loginbtn' type="Submit" value="OK"/>
    </form>
    </br>
    <?php
    session_start();

    $pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');

    if (isset($_GET['datum'])) {
        $vpdatum = $_GET['datum'];
        $zaehler = 0;

        $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';

        foreach ($pdo->query($sql) as $row) {
            $zaehler + 1;
        }

        if ($zaehler == 0) {
            echo "<a href=''style='text-decoration:none'> Es gibt keinen vertretungsplan für diesen Tag.</a>";
        } else {

            echo "<a class='abstand' href=''style='text-decoration:none'>Fehlende Kollegen:</a>";
            $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen.txt');
            echo "<a class='abstand' href=\"\"style=\"text-decoration:none\">$fehlende_kollegen</a>";

            echo '<table>';
            echo "<th>Stunde</td>";
            echo "<th> Klasse </td>";
            echo "<th> Vertretung </td>";
            echo "<th> Fach </td>";
            $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';
            foreach ($pdo->query($sql) as $row) {
                echo "<tr>";
                echo '<td><a href=\'\'style=\'text-decoration:none\'>' . $row['stunde'] . '</a></td>';
                echo '<td><a href=\'\'style=\'text-decoration:none\'>' . $row['klasse'] . '</a></td>';
                echo '<td><a href=\'\'style=\'text-decoration:none\'>' . $row['vertretung'] . '</a></td>';
                echo '<td><a href=\'\'style=\'text-decoration:none\'>' . $row['fach'] . '</a></td>';
                echo "</tr>";
            }
            echo '</table>';
            echo '</br>';
        }
        if (isset($_SESSION['loggedin'])) {
            echo "<meta http-equiv='refresh' content='0; URL=editor.php'>";
        } else {
            echo "<script src='js/NotLoggedIn.js'></script>";
        }

    } else { //ANZEIGEN WENN KEIN DATUM AUSGEWÄHLT WURDE

        $zaehler = 0;
        $sql = 'SELECT * FROM plan WHERE datum="' . $heute . '" ORDER BY klasse';
        foreach ($pdo->query($sql) as $row) {
            $zaehler += 1;
        }
        if ($zaehler == 0) {
            echo "<a id='Error' href=''style='text-decoration:none'> Es gibt keinen vertretungsplan für heute.</a>";
        } else {

            echo "<a class='abstand' href=\"\"style=\"text-decoration:none\">Fehlende Kollegen:</a>";
            $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen.txt');
            echo "<a class='abstand' href=\"\"style=\"text-decoration:none\" >$fehlende_kollegen</a>";
            echo '<table>';
            echo "<th> Stunde </td>";
            echo "<th> Klasse </td>";
            echo "<th> Vertretung </td>";
            echo "<th> Fach </td>";

            $sql = 'SELECT * FROM plan WHERE datum="' . $heute . '" ORDER BY klasse';

            foreach ($pdo->query($sql) as $row) {
                echo "<tr>";
                echo '<td><a href=""style="text-decoration:none">' . $row['stunde'] . '</a></td>';
                echo '<td><a href=""style="text-decoration:none">' . $row['klasse'] . '</a></td>';
                echo '<td><a href=""style="text-decoration:none">' . $row['vertretung'] . '</a></td>';
                echo '<td><a href=""style="text-decoration:none">' . $row['fach'] . '</a></td>';
                echo "</tr>";
            }
            echo '</table>';
            echo '</br>';
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
