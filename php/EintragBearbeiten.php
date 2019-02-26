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
$datum = $_GET['datum'];
$id = $_GET['id'];

$statement = $pdo->prepare('UPDATE INTO plan ( stunde, klasse, vertretung, fach WHERE id=$id) VALUES (?, ?, ?, ?, ?, ?)');
$statement->execute(array($stunde, $klasse, $vertretung, $fach, $datum , $id));

header("Location: ../editor.php?datum=" . $datum);
?>