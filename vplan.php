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

</head>
<body>
<main>
    <a id="Vertretunsplan" font-size="10">Vertretungsplan</a>
    <a id="Datum"></a>
    <hr>
    HTML;
    <body>
    <div id="header">
        <h2>Vertretungsplan</h2>
        <h2 id="date"><a>Mittwoch, 30.01.2019</a></h2>
    </div>
    <hr/>
    <main>
        <h2>
            Fehlende Kollegen: Fr. Jasak, Hr. Möhl, Fr. Heuer, Fr. Nickel
        </h2>
    </main>
    <br/>
    <table>
        <tr>
            <th>Stunde</th>
            <th>Klasse</th>
            <th>Vertretung</th>
            <th>Fach</th>
        </tr>
        <tr>
            <td>Stunde</td>
            <td>Klasse</td>
            <td>Vertretung</td>
            <td>Fach</td>
        </tr>
    </table>
</main>
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
