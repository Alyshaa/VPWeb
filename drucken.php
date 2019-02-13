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
    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');
    if (isset($_GET['datum'])) {
        $vpdatum = $_GET['datum'];
        $vpdatumconvert = $vpdatum;
        $zaehler = 0;
        $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';
        foreach ($pdo->query($sql) as $row) {
            $zaehler += 1;
        }
        if ($zaehler == 0) {
            echo "<a> Es gibt keinen Vertretungsplan für diesen Tag.</a>";
            header("Location: ../index.php?datum=" . $vpdatum);
        } else {
            $vpdatumconvert = date("d.m.Y", strtotime($vpdatumconvert));
            echo 'Vertretungsplan vom: ' . $vpdatumconvert .'';

            if (file_exists("./docs/fehlendekollegen/" . $vpdatum . ".txt")){ // gucke ob eine datei für fehelbde kollegen für den tag existiert
                $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen/' . $vpdatum . '.txt');
                echo "<a class='abstand'>Fehlende Kollegen: " . $fehlende_kollegen ."</a>";
            }else{
                echo $vpdatum . ".txt";
            }       // wen nicht wird nichts angezeigt

            echo '<table>';
            echo '<th><a class="th"> Stunde </th>';
            echo '<th><a class="th"> Klasse </th>';
            echo '<th><a class="th"> Vertretung </th>';
            echo '<th><a class="th"> Fach </th>';
            $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';
            foreach ($pdo->query($sql) as $row) {
                echo "<tr>";
                echo '<td><a class="td">' . $row['stunde'] . '</a></td>';
                echo '<td><a class="td">' . $row['klasse'] . '</a></td>';
                echo '<td><a class="td">' . $row['vertretung'] . '</a></td>';
                echo '<td><a class="td">' . $row['fach'] . '</a></td>';
                echo "</tr>";
            }
            echo '</table>';
            echo '</br>';
        }
    } else {
        echo "Ich Benötige ein datum um dir eine PDF erstellen zu können. Bitte versuche es erneut!";
    }
    ?>
</body>
</html>
