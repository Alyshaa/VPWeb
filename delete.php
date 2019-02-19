<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');

}
include './config/dbConnection.php';
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', $dbUser, $dbUserPassword );

$id = $_GET['id'];
$datum = $_GET['datum'];

echo $id;
$statement = $pdo->prepare("DELETE FROM plan WHERE id = ?");
$statement->execute(array($id));
header("Location: editor.php?datum=" . $datum);
?>
