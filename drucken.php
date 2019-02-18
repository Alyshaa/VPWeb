<?php
require '../vendor/autoload.php';

use Dompdf\Dompdf;

$html = <<< HTML
<!DOCTYPE html>
<html>
<head>
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
        $html .= "<a> Es gibt keinen Vertretungsplan für diesen Tag.</a>" . PHP_EOL;
        //header("Location: ../index.php?datum=" . $vpdatum);
    } else {
        $vpdatumconvert = date("d.m.Y", strtotime($vpdatumconvert));

        $html .='<div id="header">';
        $html .='<h2>Vertretungsplan</h2>';
        $html .='<h2 id="date"><a>' . $vpdatumconvert . '</a></h2>';
        $html .='</div>';
        $html .='<hr />';

        if (file_exists("./docs/fehlendekollegen/" . $vpdatum . ".txt")) { // gucke ob eine datei für fehelbde kollegen für den tag existiert
            $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen/' . $vpdatum . '.txt');

            $html .="<main>";
			$html .="<h2>Fehlende Kollegen: $fehlende_kollegen </h2>";
		    $html .="</main>";

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
    $html .= "Ich Benötige ein datum um dir eine PDF erstellen zu können. Bitte versuche es erneut!";
}
$html .= <<< HTML
</body>
</html>
HTML;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($vpdatum);
?>
