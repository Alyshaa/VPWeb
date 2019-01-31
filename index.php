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
session_start();

  $pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');

  //$statement = $pdo->prepare("INSERT INTO plan (id, Klasse, Vertretung, xxx) VALUES (?, ?, ?, ?)");
  //$statement->execute(array('10', '20', '30', '40'));

  echo "Fehlende Kollegen:";
  $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen.txt');
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
      echo '<td><a href="" style="text-decoration: none">' . $row['stunde'] . '</a></td>';
      echo '<td><a href="" style="text-decoration: none">' . $row['klasse'] . '</a></td>';
      echo '<td><a href="" style="text-decoration: none">' . $row['vertretung'] . '</a></td>';
      echo '<td><a href="" style="text-decoration: none">' . $row['fach'] . '</a></td>';
      echo "</tr>";
  }
  echo '</br>';
  echo '</table>';
  if(isset($_SESSION['loggedin'])){
    echo "<a href='editor.php'>Vertretungsplan bearbeiten</a>";
  }
  else {
    echo "<script src='js/NotLoggedin.js'></script>";
  }
?>

</body>
</html>
