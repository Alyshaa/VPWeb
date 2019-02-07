<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');

}
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');
$id = $_GET['id'];
echo $id;
$statement = $pdo->prepare("DELETE FROM plan WHERE id = ?");
$statement->execute(array($id));
header("Location: editor.php");
?>
