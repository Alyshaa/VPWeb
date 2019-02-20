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
        function changePW(oldpw, password, password2, operation) {
            if (password === password2) {
                fetch('php/LoginHandling.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        oldpw: oldpw,
                        paswd: password,
                        operation: operation
                    })
                }).then(response => response.text())
                    .then(data => {
                        if (data == 'true') {
                            window.location.replace('index.php');
                        }else if(data == "oldpw"){
                            alert('Altes passwort ist nicht korekt');
                        }else {
                            console.log(data);
                        }

                    });
            } else {
                alert('Passwörter sind nicht gleich');
            }
        }
    </script>
</head>
<body>
<main>
    <h1>Einstellungen</h1>
    <br>
    <a href="editor.php">zurück</a>
    <h2>Passwort ändern</h2>
    <form>
        <input class="eingabe textfield" type='password' id='cpw' value='' placeholder="Passwort"  />

        <input class="textfield" type='password' id='cpw2' value='' placeholder="Passwort Wiederholen"  />

        <input class="textfield" type='password' id='old' value='' placeholder="Altes Passwort eingeben"  />

        <button class='loginbtn' type='button'
                onclick="changePW(document.querySelector('#old').value, document.querySelector('#cpw').value, document.querySelector('#cpw2').value, 'changePW')">
            Speichern
        </button>
    </form

</main>

</body>
</html>
