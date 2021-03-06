<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan Editor</title>
    <link href="css/design.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<main>
    <?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.php');
    }//gucke ob man sich erfolgreich eingeloggt hat

    $morgen = strtotime("+1 day");
    $datummorgen = date("Y-m-d", $morgen);

    ?>
    <!-- <a class="loginbtn backbtn" href="index.php"> zurück </a><br><br> -->
    <a class="loginbtn backbtn" href="tv.php?datum=<?php echo $_GET['datum']; ?>"> Im TV Modus ansehen </a><br><br>

    <h1>Vertretungsplan Editor</h1>
    <a href="" style="text-decoration:none">Vertretungsplan auswhälen</a><br><br>
    <form action="editor.php" method="get">
        <input class='textfield' type="date" id="planfuertag" name="datum" value="<?php if (isset($_GET['datum'])) {
            $vpdatum = $_GET['datum'];
            echo $vpdatum;
        } else {
            echo $datummorgen;
        } ?>"/>
        <button class='loginbtn' type="Submit" value="Absenden">Öffnen</button>
    </form>
    </br>
    <?php

    //$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');
    $pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'vpweb', '3052cNs3?qRu@5G');

    if (isset($_GET['datum'])) { //Gucke ob man einen bestimmten vertretungsplan sehen möchte
        $vpdatum = $_GET['datum'];

        if (isset($_GET['Fehlendekollegen'])) {
            $fk = $_GET['Fehlendekollegen'];
            file_put_contents('./docs/fehlendekollegen/' . $vpdatum . '.txt', $fk);
        }
        $vpdatumconvert = $vpdatum;
        $vpdatumconvert = date("d.m.Y", strtotime($vpdatumconvert));
        echo "<h2>Sie bearbeiten den Vertretungsplan für den: " . $vpdatumconvert . "</h2>";
        $zaehler = 0;
        $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';

        if (file_exists("./docs/fehlendekollegen/" . $vpdatum . ".txt")) { // gucke ob eine datei für fehelbde kollegen für den tag existiert
            $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen/' . $vpdatum . '.txt');
            if ($fehlende_kollegen != "") { //gucke ob die datei leer ist. wenn ja dann wird nichts angezeigt
                $vorlagetext = file_get_contents('./docs/fehlendekollegen/vorlage.txt');
                if ($fehlende_kollegen != $vorlagetext){
                echo "<a class='abstand' href=''style='text-decoration:none'>Fehlende Kollegen: " . $fehlende_kollegen . "</a>";
                }
            }
        } else {// Erstelle die datei und packe den vorlage text hinein
            $vorlagetext = file_get_contents('./docs/fehlendekollegen/vorlage.txt');
            file_put_contents('./docs/fehlendekollegen/' . $vpdatum . '.txt', $vorlagetext);
        }       // wen nicht wird sie schoneinmal erstellt um keine fehlermeldungen anzuzeigen

        foreach ($pdo->query($sql) as $row) {
            $zaehler += 1;
        }
        if ($zaehler == 0) {
            echo "<a href=''style='text-decoration:none'> Es gibt keinen Vertretungsplan für diesen Tag.</a>";
            echo "<br>";
            echo '<a class="aktion" href="./new.php?datum=' . $vpdatum . '">Neuer Eintrag</a>';
        } else {
            echo '<table>';
            echo '<th><a class="th" href=""> Stunde </a></th>';
            echo '<th><a class="th" href=""> Klasse </a></th>';
            echo '<th><a class="th" href=""> Vertretung </a></th>';
            echo '<th><a class="th" href=""> Fach </a></th>';
            //echo '<th><a class="th" href=""> Anmerkung </a></th>';
            //echo '<th><a class="th" href=""> Hinzugefügt </a></th>';
            echo '<th><a class="th" href=""> Aktion </a></th>';
            $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY id';
//->fetchALL(PDO::FETCH_ASSOC)
            foreach ($pdo->query($sql) as $row) {
                                    echo $row['id'];
                //guge ob ein eintrag bearbeitet werden soll
                if (isset($_GET['id']) && isset($_GET['edit']) == "true") {
                    $eintragDatum = $row['datum'];
                    $eintragDatumconvertiert = date("d.m.Y", strtotime($eintragDatum));

                    if ($row['id'] == $_GET['id']) { //gucke ob der eintrag bearbeitet werden soll
                        echo '<tr>';

                        echo '<form action="php/EintragBearbeiten.php" method="get">';
                        echo '<td><input type="text" id="Stunde" name="stunde" value="'. $row['stunde'] .'" maxlength="2"></td>';
                        echo '<td><input type="text" id="Klasse" name="klasse" value="'. $row['klasse'] .'" maxlength="5"></td>';
                        echo '<td><input type="text" id="vertretung" name="vertretung" value="'. $row['vertretung'] .'" maxlength="35"></td>';
                        echo '<td><input type="text" id="fach" name="fach" value="'. $row['fach'] .'" maxlength="10" ></td>';
                        echo '<input type="hidden" id="id" name="id" value="' . $row['id']  . '">';
                        echo '<td><button class="loginbtn spnbtn" type="submit" name="datum" value="' . $vpdatum . '">Speichern</button></td>';

                        echo '</form>';
                    } else { //Der zu bearbeitende eintrag
                        echo '<tr>';
                        echo '<td><a class="td" href="">' . $row['stunde'] . '</a></td>';
                        echo '<td><a class="td" href="">' . $row['klasse'] . '</a></td>';
                        echo '<td><a class="td" href="">' . $row['vertretung'] . '</a></td>';
                        echo '<td><a class="td" href="">' . $row['fach'] . '</a></td>';
                        //echo '<td><a class="td" href="">' . $row['anmerkung'] . '</a></td>';
                        //echo '<td><a class="td" href="">' . $row['hinzugefuegt'] . '</a></td>';
                        echo $row['id'];
                        echo '<td><a class="aktion" href="delete.php?id=' . $row['id'] . '&datum=' . $vpdatum . '">Entfernen</a>';
                        echo '<br><a class="aktion" href="editor.php?id=' . $row['id'] . '&datum=' . $vpdatum . '&edit=true">Bearbeiten</a>';
                        echo '</td>';
                                                                                                                            //<br><a class="aktion" href="editor.php?id=' . 
                        echo '</tr>';
                    }
                }else{
                    $eintragDatum = $row['datum'];
                    $eintragDatumconvertiert = date("d.m.Y", strtotime($eintragDatum));
                    echo '<tr>';
                    echo '<td><a class="td" href="">' . $row['stunde'] . '</a></td>';
                    echo '<td><a class="td" href="">' . $row['klasse'] . '</a></td>';
                    echo '<td><a class="td" href="">' . $row['vertretung'] . '</a></td>';
                    echo '<td><a class="td" href="">' . $row['fach'] . '</a></td>';
                    //echo '<td><a class="td" href="">' . $row['anmerkung'] . '</a></td>';
                    //echo '<td><a class="td" href="">' . $row['hinzugefuegt'] . '</a></td>';
                    echo '<td><a class="aktion" href="delete.php?id=' . $row['id'] . '&datum=' . $vpdatum . '">Entfernen</a></td>';
                    echo '</tr>';
                }
            }
                echo '<tr>'; //Neuer Eintrag
                echo '<form action="php/EintragSpeichern.php" method="get">';
                echo '<td><input type="text" id="Stunde" name="stunde" value="" maxlength="2"></td>';
                echo '<td><input type="text" id="Klasse" name="klasse" value="" maxlength="5"></td>';
                echo '<td><input type="text" id="vertretung" name="vertretung" value="" maxlength="35"></td>';
                echo '<td><input type="text" id="fach" name="fach" value="" maxlength="10" ></td>';
                //echo '<td><input type="text" id="anmerkung" name="anmerkung" value=""></td>';
                // echo '<td></td>';
                echo '<td><button class="loginbtn spnbtn" type="submit" name="datum" value="' . $vpdatum . '">Speichern</button></td>';
                echo '</form>';
                echo '</tr>';

            echo '<tr>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            // echo '<td></td>';
            // echo '<td></td>';
            echo '<td>';
            // echo '<a class="aktion" href="./new.php?datum=' . $vpdatum . '">Neuer Eintrag</a> <br>';
            echo '<a class="aktion" href="./drucken.php?datum=' . $vpdatum . '">PDF Download</a>';
            echo '</td>';
            echo '</tr>';
            echo '</table>';

            echo '<a>Fehlende Kollegen (HTML)</a>';
            echo '<form action="./php/KollegenSpeichern.php" method="get">';
            echo '<textarea rows="4" cols="50" name="Fehlendekollegen">' . $fehlende_kollegen . '</textarea><br>';
            echo '<button class="loginbtn spnbtn" type="submit" name="datum" value="' . $vpdatum . '">Speichern</button>';
            echo '</form>';
        }
    } else {
        echo '<a>Willkommen im VPWeb Editor</a> <br>';
        echo '<a>Um einen Vertretungsplan zu bearbeiten müssen sie zuerst ein datum auswählen</a><br>';
        echo '<a href="editor.php?datum=2019-02-01">zum Demo-Tag</a><br>';
        echo '<a></a><br>';
        echo '<a></a><br>';
    }
    ?>
    <form action="php/logout.php">
        <button class="loginbtn logoutbtn" type="submit" value="Logout">Logout</button>
    </form>
    <br>
    <form action="einstellungen.php">
        <button class="loginbtn logoutbtn" type="submit" value="einstellungen">Einstellungen</button>
    </form>
</main>
</body>
</html>