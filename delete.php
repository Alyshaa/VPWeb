<?php
session_start();
if(!isset($_SESSION['loggedin'])){
  header('Location: index.php');

}
$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'justin', 'BL<aj+V,$@9gbwQD');
$id = $_GET['id'];
$statement = $pdo->prepare("DELETE FROM plan WHERE id = $id");
$statement->execute(array(10));
header("Location: editor.php");
?>
