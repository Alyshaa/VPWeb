<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');

}
    $pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');
    //$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'vpweb', '3052cNs3?qRu@5G');
$id = $_GET['id'];
$datum = $_GET['datum'];

echo $id;
$statement = $pdo->prepare("DELETE FROM plan WHERE id = ?");
$statement->execute(array($id));
header("Location: editor.php?datum=" . $datum);
?>
