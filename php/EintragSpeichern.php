<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
}
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');
//$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'vpweb', '3052cNs3?qRu@5G');

$stunde = $_GET['stunde'];
$klasse = $_GET['klasse'];
$fach = $_GET['fach'];
$vertretung = $_GET['vertretung'];
$anmerkung = $_GET['anmerkung'];
$datum = $_GET['datum'];

$statement = $pdo->prepare('INSERT INTO plan ( stunde, klasse, vertretung, fach, anmerkung, datum) VALUES (?, ?, ?, ?, ?, ?)');
$statement->execute(array($stunde, $klasse, $vertretung, $fach, $anmerkung, $datum));

header("Location: ../editor.php?datum=" . $datum);

?>

