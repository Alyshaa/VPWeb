<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: ../index.php');
}

$pdo = new PDO('mysql:host=172.17.17.100;dbname=vertretungsplan', 'justin', 'BL<aj+V,$@9gbwQD');

$stunde = $_GET['stunde'];
$klasse = $_GET['klasse'];
$fach = $_GET['fach'];
$vertretung = $_GET['vertretung'];
$anmerkung = $_GET['anmerkung'];

echo $stunde;
echo $klasse;
echo $fach;
echo $vertretung;
echo $anmerkung;

$statement = $pdo->prepare('INSERT INTO plan ( stunde, klasse, vertretung, fach, anmerkung) VALUES (?, ?, ?, ?, ?)');

$statement->execute(array( $stunde, $klasse, $vertretung, $fach, $anmerkung));


header("Location: ../editor.php");

?>

