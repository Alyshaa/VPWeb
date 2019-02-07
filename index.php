<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<?php
$heute = date('Y-m-d');
$morgen = strtotime("+1 day");
$datummorgen = date("Y-m-d", $morgen);

?>
<a>Vertretungsplan für einen anderen Tag anzeigen</a>
<form action="index.php" method="get">
    <input type="date" name="datum" id="datum" value="<?php echo $datummorgen ?>">
    <input type="Submit" value="Absenden"/>
</form>
</br>
<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');

if (isset($_GET['datum'])) {
    $vpdatum = $_GET['datum'];

    echo "Fehlende Kollegen:";
    $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen.txt');
    echo "</br>";
    echo $fehlende_kollegen;
    echo '<table border="1">';

    echo "<td> Stunde </td>";
    echo "<td> Klasse </td>";
    echo "<td> Vertretung </td>";
    echo "<td> Fach </td>";

    echo "</br>";
    echo "Das ausgewählte Datum: ";
    echo $vpdatum;
    echo "</br>";
    echo $datummorgen;

    $sql = 'SELECT * FROM plan WHERE datum=' . $vpdatum . ' ORDER BY klasse';
    foreach ($pdo->query($sql) as $row) {
        echo "<tr>";
        echo '<td><a href="" style="text-decoration: none">' . $row['stunde'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['klasse'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['vertretung'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['fach'] . '</a></td>';
        echo "</tr>";
    }
    echo '</br>';
    echo '</table>';
    if (isset($_SESSION['loggedin'])) {
        echo "<a href='editor.php'>Vertretungsplan bearbeiten</a>";
    } else {
        echo "<script src='js/NotLoggedIn.js'></script>";
    }

} else { //ANZEIGEN WENN KEIN DATUM AUSGEWÄHLT WURDE

    echo "Fehlende Kollegen:";
    $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen.txt');
    echo "</br>";
    echo $fehlende_kollegen;
    echo '<table border="1">';
    echo "<td> Stunde </td>";
    echo "<td> Klasse </td>";
    echo "<td> Vertretung </td>";
    echo "<td> Fach </td>";

    echo "</br>";
    echo "Das Datum von heute: ";
    echo $heute;
    echo "</br>";
    $heute = "2019-02-07";
    $heute = date($heute);
    echo $heute;
    echo "</br>";

    $sql = 'SELECT * FROM plan WHERE datum=' . $heute . ' ORDER BY klasse';

    foreach ($pdo->query($sql) as $row) {
        echo "<tr>";
        echo '<td><a href="" style="text-decoration: none">' . $row['stunde'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['klasse'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['vertretung'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['fach'] . '</a></td>';
        echo "</tr>";
    }

    echo '</br>';
    echo '</table>';
    if(isset($_SESSION['loggedin'])){
        // echo "<meta http-equiv='refresh' content='0; URL=editor.php'>";
    }
    else {
        echo "<script src='js/NotLoggedIn.js'></script>";
    }
}
?>

</body>
</html>
