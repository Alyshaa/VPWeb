<?php
session_start();
if(!isset($_SESSION['loggedin'])){
  header('Location: index.php');

}
$pdo = new PDO('mysql:host=172.17.17.100;dbname=vertretungsplan', 'justin', 'BL<aj+V,$@9gbwQD');
$id = $_GET['id'];
echo $id;
$statement = $pdo->prepare("DELETE FROM plan WHERE id = ?");
$statement->execute(array($id));
header("Location: editor.php");
?>
