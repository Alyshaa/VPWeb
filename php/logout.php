<!DOCTYPE HTML>
<html>
  <head>
    <title>Logout</title>
    <link href="../css/design.css" rel="stylesheet">
  </head>
  <body>
    <main>
      <?php
        session_start();
        session_destroy();
        echo "Logout...";
      ?>
      <meta http-equiv='refresh' content='1; URL=../index.php'>
    </main>
  </body>
</html>
