<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan Editor</title>
    <link href="css/design.css" rel="stylesheet">
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
<main>
    <?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.php');
    }

    //zu berechnende daten--->
    $morgen = strtotime("+1 day");
    $datummorgen = date("Y-m-d", $morgen);
    //<---
    ?>
    <!-- <a class="loginbtn backbtn" href="index.php"> zurück </a><br><br> -->

    <h1>Vertretungsplan Editor</h1>
    <a href="" style="text-decoration:none">Vertretungsplan für einen anderen Tag anzeigen</a><br><br>
    <form action="editor.php" method="get">
        <input class='textfield' type="date" id="planfuertag" name="datum" value="<?php if (isset($_GET['datum'])) {
            $vpdatum = $_GET['datum'];
            echo $vpdatum;
        } else {
            echo $datummorgen;
        } ?>"/>
        <input class='loginbtn' type="Submit" value="Absenden"/>
    </form>
    </br>

    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');

    if (isset($_GET['datum'])) {
        $vpdatum = $_GET['datum'];
        echo "<h2>Warnung: Sie bearbeiten den Vertretungsplan für den: " . $vpdatum . "</h2>";
        $zaehler = 0;

        $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';

        foreach ($pdo->query($sql) as $row) {
            $zaehler += 1;
        }

        if ($zaehler == 0) {
            echo "<a href=''style='text-decoration:none'> Es gibt keinen vertretungsplan für diesen Tag.</a>";
        } else {

            echo '<table>';
            echo '<th><a href=""style="text-decoration:none"> ID </a></td>';
            echo '<th><a href=""style="text-decoration:none"> Stunde </a></td>';
            echo '<th><a href=""style="text-decoration:none"> Klasse </a></td>';
            echo '<th><a href=""style="text-decoration:none"> Vertretung </a></td>';
            echo '<th><a href=""style="text-decoration:none"> Fach <a></td>';
            echo '<th><a href=""style="text-decoration:none"> Anmerkung <a></td>';
            echo '<th><a href=""style="text-decoration:none"> Hinzugefügt <a></td>';
            echo '<th><a href=""style="text-decoration:none"> Aktion <a></td>';

            $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY id';
//->fetchALL(PDO::FETCH_ASSOC)
            foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td><a href=""style="text-decoration:none">' . $row['id'] . '</a></td>';
                echo '<td><a href=""style="text-decoration:none">' . $row['stunde'] . '</a></td>';
                echo '<td><a href=""style="text-decoration:none">' . $row['klasse'] . '</a></td>';
                echo '<td><a href=""style="text-decoration:none">' . $row['vertretung'] . '</a></td>';
                echo '<td><a href=""style="text-decoration:none">' . $row['fach'] . '</a></td>';
                echo '<td><a href=""style="text-decoration:none">' . $row['anmerkung'] . '</a></td>';
                echo '<td><a href=""style="text-decoration:none">' . $row['hinzugefuegt'] . '</a></td>';
                echo '<tD><a class="aktion" href="../delete.php?id=' . $row['id'] . '">Entfernen</a></td>';
                echo '</tr>';
            }
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td><a class="aktion" href="./new.php?datum=' . $vpdatum . '">Neuer Eintrag</a></td>';
            echo '</table>';
        }
        echo'</br>';
        echo'</br>';
        echo'<a class="aktion" href="./new.php?datum=' . $vpdatum . '">Neuer Eintrag</a>';
        echo'</br>';
    } else {
        echo "<a class='abstand'>Alle Einträge werden angezeigt!</a>";
        echo '<table>';
        echo '<th><a href=""style="text-decoration:none"> ID </a></td>';
        echo '<th><a href=""style="text-decoration:none"> Datum </a></td>';
        echo '<th><a href=""style="text-decoration:none"> Stunde </a></td>';
        echo '<th><a href=""style="text-decoration:none"> Klasse </a></td>';
        echo '<th><a href=""style="text-decoration:none"> Vertretung </a></td>';
        echo '<th><a href=""style="text-decoration:none"> Fach <a></td>';
        echo '<th><a href=""style="text-decoration:none"> Anmerkung <a></td>';
        echo '<th><a href=""style="text-decoration:none"> Hinzugefügt <a></td>';
        echo '<th><a href=""style="text-decoration:none"> Aktion <a></td>';

        $sql = 'SELECT * FROM plan ORDER BY datum';
//->fetchALL(PDO::FETCH_ASSOC)
        foreach ($pdo->query($sql) as $row) {
            echo '<tr>';
            echo '<td><a href=""style="text-decoration:none">' . $row['id'] . '</a></td>';
            echo '<td><a href=""style="text-decoration:none">' . $row['datum'] . '</a></td>';
            echo '<td><a href=""style="text-decoration:none">' . $row['stunde'] . '</a></td>';
            echo '<td><a href=""style="text-decoration:none">' . $row['klasse'] . '</a></td>';
            echo '<td><a href=""style="text-decoration:none">' . $row['vertretung'] . '</a></td>';
            echo '<td><a href=""style="text-decoration:none">' . $row['fach'] . '</a></td>';
            echo '<td><a href=""style="text-decoration:none">' . $row['anmerkung'] . '</a></td>';
            echo '<td><a href=""style="text-decoration:none">' . $row['hinzugefuegt'] . '</a></td>';
            echo '<td><a class="aktion" href="delete.php?id=' . $row['id'] . '">Entfernen</a></td>';
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
    <br>
    <a id='pwabstand'>Passwort Ändern</a>
    <form>
        <input class="eingabe textfield" type='password' id='cpw' value='' placeholder="Passwort">
        <input class="textfield" type='password' id='cpw2' value='' placeholder="Passwort Wiederholen">
        <button class='loginbtn' type='button'
                onclick="changePW(document.querySelector('#cpw').value, document.querySelector('#cpw2').value, 'changePW')">
            speichern
        </button>
    </form>
    <br>
    <form action="php/Logout.php">
        <input class="loginbtn logoutbtn" type="submit" value="Logout">
    </form>
</main>
</body>
</html>
