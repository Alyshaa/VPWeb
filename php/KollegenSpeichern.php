<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}

$kollegen = $_GET['Fehlendekollegen'];
$vpdatum = $_GET['datum'];
file_put_contents('../docs/fehlendekollegen/' . $vpdatum . '.txt', $kollegen);
echo $kollegen;
header("Location: ../editor.php?datum=" . $vpdatum);
?>