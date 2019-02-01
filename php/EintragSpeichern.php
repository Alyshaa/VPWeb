<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: ../index.php');

}
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'justin', 'Sc-91209078');

$stunde = $_GET['stunde'];
$klasse = $_GET['klasse'];
$vertretung = $_GET['vertretung'];
$anmerkung = $_GET['anmerkung'];

$statement = $pdo->prepare("INSERT INTO plan (id, Stunde, Klasse, Vertretung, Anmerkung) VALUES (?, ?, ?, ?, ?)");
$statement->execute(array('', $stunde, $klasse, $vertretung, $anmerkung,));

header("Location: ../editor.php");
?>
