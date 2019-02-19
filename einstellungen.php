<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Einstellungen</title>
    <link href="css/designnew.css" rel="stylesheet">
    <script type="text/javascript">
        function changePW(password, password2, operation) {
            if (password === password2) {
                fetch('php/LoginHandling.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        paswd: password,
                        operation: operation
                    })
                }).then(response => response.text())
                    .then(data => {
                        if (data == 'true') {
                            window.location.replace('index.php');
                        }
                        console.log(data);
                    });
            } else {
                console.log('sdf');
            }
        }
    </script>
</head>
<body>
<main>
    <h1>Einstellungen</h1>
    <br>

    <h2>Passwort ändern</h2>
    <form>
        <input class="eingabe textfield" type='password' id='cpw' value='' placeholder="Passwort" readonly>
        <input class="textfield" type='password' id='cpw2' value='' placeholder="Passwort Wiederholen" readonly>
        <button class='loginbtn' type='button'
                onclick="changePW(document.querySelector('#cpw').value, document.querySelector('#cpw2').value, 'changePW')">
            speichern
        </button>
    </form>
</main>
</body>
</html>
