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
echo "<td><a href='' style=\"text-decoration: none\"> ID </a></td>";
echo "<td><a href='' style=\"text-decoration: none\"> Stunde </a></td>";
echo "<td><a href='' style=\"text-decoration: none\"> Klasse </a></td>";
echo "<td><a href='' style=\"text-decoration: none\"> Vertretung </a></td>";
echo "<td><a href='' style=\"text-decoration: none\"> Anmerkung <a</td>";
echo "<td> Hinzugefügt </td>";

$sql = "SELECT * FROM plan ORDER BY id";
                        //->fetchALL(PDO::FETCH_ASSOC)
foreach ($pdo->query($sql)as $row) {
    echo "<tr>";
    echo '<td><a href="" style="text-decoration: none">' . $row['id'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none">' . $row['stunde'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none">' . $row['klasse'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none">' . $row['vertretung'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none" style="color: black">' . $row['anmerkung'] . '</a></td>';
    echo '<td><a href="" style="text-decoration: none" style="color: black" >' . $row['hinzugefuegt'] . '</a></td>';
    echo '<td><a href="delete.php?id=' . $row['id'] . '">Entfernen</a></td>';
    echo "</tr>";
}
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td><a href=\"New.php\">Neuer Eintrag</a></td>";
$fehlende_kollegen = file_get_contents('./docs/fehlendekollegen.txt');

?>

<a>Fehlende Kollegen</a>

<form method="post">
    <input type="text" id="fehlendekollegen" value="<?php echo $fehlende_kollegen; ?>">
    <input type="submit" name="kspeichern" value="speichern" action="?submit">
</form>

<?php

function kspeichern()
{

    $textfieldvlaue = $_GET['fehlendekollegen'];
    file_put_contents("./docs/fehlendekollegen.txt",$textfieldvlaue );
    echo $fehlendekollegen;
    echo $textfieldvlaue;
    echo "Gespeichert";
}
if(isset($_POST['submit'])){
    kspeichern();
}
?>

</body>
</html>
