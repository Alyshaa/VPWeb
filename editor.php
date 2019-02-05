<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
      function changePW(password, password2, operation){
        if(password === password2){
          fetch('php/LoginHandling.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            paswd: password,
            operation: operation
          })
        }).then(response=>response.text())
          .then(data=>{
           if (data == 'true') {
             window.location.replace('index.php');
           }
            console.log(data);
        });

      }else{
        console.log('sdf');
      }
      }


    </script>
</head>
<body>
<?php
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

$sql = 'SELECT * FROM plan ORDER BY id';
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
echo '<td><a href="new.php">Neuer Eintrag</a></td>';
echo '</table>';

$fehlende_kollegen = file_get_contents('./docs/fehlendekollegen.txt');

?>
<a>Fehlende Kollegen</a>
<form action="php/KollegenSpeichern.php" method="get">
    <input type='text' id='fehlendekollegen' name="Fehlendekollegen" value='<?php echo $fehlende_kollegen; ?>'>
    <input type="Submit" value="Absenden" />
</form>

<br>
<a>Passwort Ändern</a>
<br>
<form>
    <input type='password' id='cpw' value='' placeholder="Passwort">
    <input type='password' id='cpw2' value='' placeholder="Passwort Wiederholen">
    <button type='button' onclick="changePW(document.querySelector('#cpw').value, document.querySelector('#cpw2').value, 'changePW')" >speichern</button>
</form>
<?php
$CurrentVPWebversion = file_get_contents('https://raw.githubusercontent.com/Informaten/VPWeb/master/docs/version.txt');
$NeusteVPWebVersion= file_get_contents('./docs/version.txt');

echo"Ihre VPWeb version ist: $CurrentVPWebversion </br>";
echo"Die Neuste VPWeb version ist: $NeusteVPWebVersion";

?>

</body>
</html>
