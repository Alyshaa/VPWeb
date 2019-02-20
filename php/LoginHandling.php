<?php
session_start();
$data = file_get_contents("php://input");
$json = json_decode($data, true);
$method = $json['operation'];
if (isset($json['paswd'])) {

  if ($method == 'Login') {

    if (password_verify($json['paswd'], getPW())) {

      $_SESSION['loggedin'] = 'true';
      echo "true";

    }else {
      echo "false";

    }

  }elseif ($method == 'changePW'){
    if (password_verify($json['oldpw'], getPW())) {

      unset($_SESSION['loggedin']);
      kspeichern($json['paswd']);
      echo "true";
    }else{
      echo "oldpw";
    }

  }

}else {

  echo "false";
}

function kspeichern($value)
{
    file_put_contents('pw.txt', password_hash($value, PASSWORD_DEFAULT));
}
function getPW()
{
  return file_get_contents('pw.txt');
}
?>
