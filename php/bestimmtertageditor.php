<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Vertretungsplan Editor</h1>

<?php
//zu berechnende daten{
$morgen = strtotime("+1 day");
$darummorgen = date();
//}

$vpdatum = $_GET['datum'];
echo "<h2>Warnung Sie bearbeiten den Vertretungsplan für den: " . $vpdatum . "</h2>";
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: index.php');

}
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');

echo '<table border = "1">';
echo '<td><a href="" style="text-decoration: none"> ID </a></td>';
echo '<td><a href="" style="text-decoration: none"> Stunde </a></td>';
echo '<td><a href="" style="text-decoration: none"> Klasse </a></td>';
echo '<td><a href="" style="text-decoration: none"> Vertretung </a></td>';
echo '<td><a href="" style="text-decoration: none"> Fach <a></td>';
echo '<td><a href="" style="text-decoration: none"> Anmerkung <a></td>';
echo '<td><a href="" style="text-decoration: none"> Hinzugefügt <a></td>';
echo '<td><a href="" style="text-decoration: none"> Aktion <a></td>';

$sql = 'SELECT * FROM plan WHERE datum="'.$vpdatum.'" ORDER BY id';
//->fetchALL(PDO::FETCH_ASSOC)
foreach ($pdo->query($sql)as $row) {
    echo '<tr>';
    echo '<td><a href="" style="text-decoration: none">' . $row['id'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none">' . $row['stunde'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none">' . $row['klasse'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none">' . $row['vertretung'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none">' . $row['fach'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none">' . $row['anmerkung'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none">' . $row['hinzugefuegt'] . '</a></td>';
    echo '<td><a href="delete.php?id=' .$row['id']. '">Entfernen</a></td>';
    echo '</tr>';
}
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td><a href="../new.php?datum='.$vpdatum.'">Neuer Eintrag</a></td>';
echo '</table>';

$fehlende_kollegen = file_get_contents('./docs/fehlendekollegen.txt');

?>
<a>Fehlende Kollegen</a>
<form action="php/KollegenSpeichern.php" method="get">
    <input type='text' id='fehlendekollegen' name="Fehlendekollegen" value='<?php echo $fehlende_kollegen; ?>'>
    <input type="Submit" value="Absenden" />
</form>

</body>
</html>
