<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');

//$statement = $pdo->prepare("INSERT INTO plan (id, Klasse, Vertretung, xxx) VALUES (?, ?, ?, ?)");
//$statement->execute(array('10', '20', '30', '40'));

echo "Fehlende Kollegen:";
$fehlende_kollegen = file_get_contents('./docs/fehlendekollegen.txt');
$VPWebversion = file_get_contents('./docs/version.txt');
echo"</br>";
echo $fehlende_kollegen;
echo '<table border="1">';

echo "<td> Stunde </td>";
echo "<td> Klasse </td>";
echo "<td> Vertretung </td>";
echo "<td> Fach </td>";
$sql = "SELECT stunde, klasse, vertretung, fach FROM plan ORDER BY Klasse";
foreach ($pdo->query($sql) as $row) {
    echo "<tr>";
    echo "<td>". $row['stunde'] . "</td>";
    echo "<td>". $row['klasse'] . "</td>";
    echo "<td>". $row['vertretung'] . "</td>";
    echo "<td>". $row['fach'] . "</td>";
    echo "</tr>";
}
echo "<a>VPWeb-Version:$VPWebversion </a>";
echo '</br>';

?>
<a href="Editor.php">Vertretungsplan bearbeiten</a>
</body>
</html>
