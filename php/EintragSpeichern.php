<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: ../index.php');

}
try{
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'justin', 'BL<aj+V,$@9gbwQD');
}catch(PDOExeption $th){
echo $th->error_log;
}
$stunde = $_GET['stunde'];
$klasse = $_GET['klasse'];
$klasse = $_GET['fach'];
$vertretung = $_GET['vertretung'];
$anmerkung = $_GET['anmerkung'];

$statement = $pdo->prepare('INSERT INTO plan ( stunde, klasse, vertretung, fach, anmerkung) VALUES (?, ?, ?, ?, ?)');

$statement->execute(array( $stunde, $klasse, $vertretung, $fach, $anmerkung));


//header("Location: ../editor.php");

?>

