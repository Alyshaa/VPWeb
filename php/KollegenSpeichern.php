<?php

$textfieldvlaue = $_GET['Fehlendekollegen'];
file_put_contents("../docs/fehlendekollegen.txt",$textfieldvlaue );
echo"$textfieldvlaue";
header("Location: ../editor.php");
?>