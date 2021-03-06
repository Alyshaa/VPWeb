<?php
$html = <<< HTML
<!DOCTYPE html>
<html>
<head>

<script>
        function autoScrollandReload(scrollDistance,pause){

            var interval = setInterval(function(){

                var scrolled = window.pageYOffset;
                var scroll_size = document.body.scrollHeight;
                var scroll_remaining = scroll_size-scrolled;;

                if(scroll_remaining <= window.innerHeight){
                    clearInterval(interval);

                    document.body.scrollTop = document.documentElement.scrollTop = 0;
                    setTimeout(location.reload(),500);

                }else{
                    window.scrollBy(0,scrollDistance);
                };

            },pause);

        };

        autoScrollandReload(100,2000);
    </script>

    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/vpstyle.css" rel="stylesheet">
</head>
<body>
<main>

HTML;
$heute = date('Y-m-d');
$morgen = strtotime("+1 day");
$datummorgen = date("Y-m-d", $morgen);

//$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'vpweb', '3052cNs3?qRu@5G');

if (isset($_GET['datum'])) {
    $vpdatum = $_GET['datum'];
    $vpdatumconvert = $vpdatum;
    $zaehler = 0;
    $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';
    foreach ($pdo->query($sql) as $row) {
        $zaehler += 1;
    }
    if ($zaehler == 0) {
        $html .= "<a> Es gibt keinen Vertretungsplan für diesen Tag.</a>" . PHP_EOL;
        //header("Location: ../index.php?datum=" . $vpdatum);
    } else {
        $vpdatumconvert = date("d.m.Y", strtotime($vpdatumconvert));

        $html .= '<div id="header">';
        $html .= '<h2>Vertretungsplan</h2>';
        $html .= '<h2 id="date"><a>' . $vpdatumconvert . '</a></h2>';
        $html .= '</div>';
        $html .= '<hr />';

        if (file_exists("./docs/fehlendekollegen/" . $vpdatum . ".txt")) { // gucke ob eine datei für fehelbde kollegen für den tag existiert
            $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen/' . $vpdatum . '.txt');

            $html .= "<main>";
            $html .= "<h2>Fehlende Kollegen: $fehlende_kollegen </h2>";
            $html .= "</main>";

        } else {
            $html .= $vpdatum . ".txt";
        }       // wen nicht wird nichts angezeigt

        $html .= '<table>' . PHP_EOL;
        $html .= "<tr>" . PHP_EOL;
        $html .= '<th><a class="th"> Stunde </th>' . PHP_EOL;
        $html .= '<th><a class="th"> Klasse </th>' . PHP_EOL;
        $html .= '<th><a class="th"> Vertretung </th>' . PHP_EOL;
        $html .= '<th><a class="th"> Fach </th>' . PHP_EOL;
        $html .= "</tr>" . PHP_EOL;
        $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';
        foreach ($pdo->query($sql) as $row) {
            $html .= "<tr>" . PHP_EOL;
            $html .= '<td><a class="td">' . (empty($row['stunde']) ? "&nbsp;" : $row['stunde']) . '</a></td>' . PHP_EOL;
            $html .= '<td><a class="td">' . (empty($row['klasse']) ? "&nbsp;" : $row['klasse']) . '</a></td>' . PHP_EOL;
            $html .= '<td><a class="td">' . (empty($row['vertretung']) ? "&nbsp;" : $row['vertretung']) . '</a></td>' . PHP_EOL;
            $html .= '<td><a class="td">' . (empty($row['fach']) ? "&nbsp;" : $row['fach']) . '</a></td>' . PHP_EOL;
            $html .= "</tr>" . PHP_EOL;
        }
        $html .= '</table>' . PHP_EOL;
    }
} else {
    $html .= "Fehler: Kein vertretungsplan gefunden! ErrorCode:     ";
}
$html .= <<< HTML
</body>
</html>
HTML;
echo $html;
?>
