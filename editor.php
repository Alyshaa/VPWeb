<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');

echo '<table border = "1">';
echo "<td> ID </td>";
echo "<td> Stunde </td>";
echo "<td> Klasse </td>";
echo "<td> vertretung </td>";
echo "<td> Anmerkung </td>";

$sql = "SELECT * FROM plan ORDER BY id";
                        //->fetchALL(PDO::FETCH_ASSOC)
foreach ($pdo->query($sql) as $row) {
    echo "<tr>";
    echo "<td>". $row['id'] . "</td>";
    echo "<td>". $row['stunde'] . "</td>";
    echo "<td>". $row['klasse'] . "</td>";
    echo "<td>". $row['vertretung'] . "</td>";
    echo "<td>". $row['anmerkung'] . "</td>";
    echo '<td><a href="delete.php?id=' . $row['id'] . '">Löschen</a></td>';
    echo "</tr>";
}

echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td><a href=\"New.php\"> - Füge eintrag hinzu - </a></td>";

?>
</body>
</html>
