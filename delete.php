<?php
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');
$id = $_GET['id'];
//$statement = $pdo->prepare("DELETE FROM plan WHERE id = $id");
//$statement->execute(array(10));
header("Location: editor.php");
?>