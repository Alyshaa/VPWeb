<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
        function changePW(password, password2, operation) {
            if (password === password2) {
                fetch('php/LoginHandling.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        paswd: password,
                        operation: operation
                    })
                }).then(response => response.text())
                    .then(data => {
                        if (data == 'true') {
                            window.location.replace('index.php');
                        }
                        console.log(data);
                    });
            } else {
                console.log('sdf');
            }
        }
    </script>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');

}
?>

<?php
//zu berechnende daten--->
$morgen = strtotime("+1 day");
$datummorgen = date("Y-m-d", $morgen);
//<---
?>
<a href="index.php"> zurück </a>
<h1>Vertretungsplan Editor</h1>
<a>Vertretungsplan für einen anderen Tag anzeigen</a>
<form action="editor.php" method="get">
    <input type="date" id="planfuertag" name="datum" value="<?php if (isset($_GET['datum'])) {
        $vpdatum = $_GET['datum'];
        echo $vpdatum;
    } else {
        echo $datummorgen;
    } ?>"/>
    <input type="Submit" value="Absenden"/>
</form>
</br>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');

if (isset($_GET['datum'])) {
    $vpdatum = $_GET['datum'];
    echo "<h2>Warnung Sie bearbeiten den Vertretungsplan für den: " . $vpdatum . "</h2>";

    echo '<table border = "1">';
    echo '<td><a href="" style="text-decoration: none"> ID </a></td>';
    echo '<td><a href="" style="text-decoration: none"> Stunde </a></td>';
    echo '<td><a href="" style="text-decoration: none"> Klasse </a></td>';
    echo '<td><a href="" style="text-decoration: none"> Vertretung </a></td>';
    echo '<td><a href="" style="text-decoration: none"> Fach <a></td>';
    echo '<td><a href="" style="text-decoration: none"> Anmerkung <a></td>';
    echo '<td><a href="" style="text-decoration: none"> Hinzugefügt <a></td>';
    echo '<td><a href="" style="text-decoration: none"> Aktion <a></td>';

    $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY id';
//->fetchALL(PDO::FETCH_ASSOC)
    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td><a href="" style="text-decoration: none">' . $row['id'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['stunde'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['klasse'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['vertretung'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['fach'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['anmerkung'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['hinzugefuegt'] . '</a></td>';
        echo '<td><a href="../delete.php?id=' . $row['id'] . '">Entfernen</a></td>';
        echo '</tr>';
    }
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td><a href="./new.php?datum=' . $vpdatum . '">Neuer Eintrag</a></td>';
    echo '</table>';

} else {
    echo "Alle Einträge werden angezeigt!";
    echo '<table border = "1">';
    echo '<td><a href="" style="text-decoration: none"> ID </a></td>';
    echo '<td><a href="" style="text-decoration: none"> Datum </a></td>';
    echo '<td><a href="" style="text-decoration: none"> Stunde </a></td>';
    echo '<td><a href="" style="text-decoration: none"> Klasse </a></td>';
    echo '<td><a href="" style="text-decoration: none"> Vertretung </a></td>';
    echo '<td><a href="" style="text-decoration: none"> Fach <a></td>';
    echo '<td><a href="" style="text-decoration: none"> Anmerkung <a></td>';
    echo '<td><a href="" style="text-decoration: none"> Hinzugefügt <a></td>';
    echo '<td><a href="" style="text-decoration: none"> Aktion <a></td>';

    $sql = 'SELECT * FROM plan ORDER BY datum';
//->fetchALL(PDO::FETCH_ASSOC)
    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td><a href="" style="text-decoration: none">' . $row['id'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['datum'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['stunde'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['klasse'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['vertretung'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['fach'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['anmerkung'] . '</a></td>';
        echo '<td><a href="" style="text-decoration: none">' . $row['hinzugefuegt'] . '</a></td>';
        echo '<td><a href="delete.php?id=' . $row['id'] . '">Entfernen</a></td>';
        echo '</tr>';
    }
//echo '<td></td>';
//echo '<td></td>';
//echo '<td></td>';
//echo '<td></td>';
//echo '<td></td>';
//echo '<td></td>';
//echo '<td></td>';
//echo '<td><a href="new.php">Neuer Eintrag</a></td>';
    echo '</table>';
    
}

?>

<a>Passwort Ändern</a>
<br>
<form>
    <input type='password' id='cpw' value='' placeholder="Passwort">
    <input type='password' id='cpw2' value='' placeholder="Passwort Wiederholen">
    <button type='button'
            onclick="changePW(document.querySelector('#cpw').value, document.querySelector('#cpw2').value, 'changePW')">
        speichern
    </button>
</form>

<form action="php/Logout.php">
    <input class="loginbtn logoutbtn" type="submit" value="Logout">
</form>
</body>
</html>
