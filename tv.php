<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vertretungsplan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/design.css" rel="stylesheet">

<!--    <script>-->
<!--        onbeforeunload = function () {-->
<!--            window.scrollTo(0, 0);-->
<!--        }-->
<!--        onload = e=>{-->
<!--            var d = document.documentElement;-->
<!--            var offset = d.scrollTop + window.innerHeight;-->
<!--            var height = d.offsetHeight;-->
<!---->
<!--            if (offset >= height) {-->
<!--                setTimeout(function () {-->
<!--                    location.reload(1);-->
<!--                }, 5000);-->
<!---->
<!--            }-->
<!--          setInterval(function(){-->
<!--              scrollBy(0,100);-->
<!--          }, 5000);-->
<!--        };-->
<!--        onscroll = function() {-->
<!--            var d = document.documentElement;-->
<!--            var offset = d.scrollTop + window.innerHeight;-->
<!--            var height = d.offsetHeight;-->
<!---->
<!--            if (offset >= height) {-->
<!--                setTimeout(function () {-->
<!--                    location.reload(1);-->
<!--                }, 5000);-->
<!---->
<!--            }-->
<!--        };-->
<!--    </script>-->



    <script>
        function autoScrollandReload(scrollDistance,pause){

            var interval = setInterval(function(){

                var scrolled = window.pageYOffset;
                var scroll_size = document.body.scrollHeight;
                var scroll_remaining = scroll_size-scrolled;;

                if(scroll_remaining <= window.innerHeight){
                    clearInterval(interval);

                    document.body.scrollTop = document.documentElement.scrollTop = 0;
                    setTimeout(location.reload(),500);

                }else{
                    window.scrollBy(0,scrollDistance);
                };

            },pause);

        };

        autoScrollandReload(100,2000);
    </script>

</head>
<body>
<main>
    <h1>Vertretungsplan</h1>
    <?php
    $heute = date('Y-m-d');
    $morgen = strtotime("+1 day");
    $datummorgen = date("Y-m-d", $morgen);
    ?>
    <?php
    session_start();

    //$pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'root', '');
    $pdo = new PDO('mysql:host=localhost;dbname=vertretungsplan', 'vpweb', '3052cNs3?qRu@5G');

    if (isset($_GET['datum'])) {
        $vpdatum = $_GET['datum'];
        $zaehler = 0;
        $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';
        foreach ($pdo->query($sql) as $row) {
            $zaehler += 1;
        }
        if ($zaehler == 0) {
            echo "<a href=''style='text-decoration:none'> Es gibt keinen Vertretungsplan für diesen Tag.</a>";
        } else {
            if (file_exists("./docs/fehlendekollegen/" . $vpdatum . ".txt")) { // gucke ob eine datei für fehelbde kollegen für den tag existiert
                $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen/' . $vpdatum . '.txt');
                echo "<a class='abstand' href=''style='text-decoration:none'>Fehlende Kollegen: " . $fehlende_kollegen . "</a>";
            }
            echo '<table>';
            echo '<th><a class="th" href=""> Stunde </th>';
            echo '<th><a class="th" href=""> Klasse </th>';
            echo '<th><a class="th" href=""> Vertretung </th>';
            echo '<th><a class="th" href=""> Fach </th>';
            $sql = 'SELECT * FROM plan WHERE datum="' . $vpdatum . '" ORDER BY klasse';
            foreach ($pdo->query($sql) as $row) {
                echo "<tr>";
                echo '<td><a class="td" href="">' . $row['stunde'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['klasse'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['vertretung'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['fach'] . '</a></td>';
                echo "</tr>";
            }
            echo '</table>';
        }
    } else { //ANZEIGEN WENN KEIN DATUM AUSGEWÄHLT WURDE
        $vpdatum = $heute;
        $zaehler = 0;
        $sql = 'SELECT * FROM plan WHERE datum="' . $heute . '" ORDER BY klasse';
        foreach ($pdo->query($sql) as $row) {
            $zaehler += 1;
        }
        if ($zaehler == 0) {
            echo "<a id='Error' href=''style='text-decoration:none'> Es gibt keinen Vertretungsplan für heute.</a>";
        } else {
            echo "<a class='abstand' href=\"\"style=\"text-decoration:none\">Fehlende Kollegen:</a>";
            $fehlende_kollegen = file_get_contents('./docs/fehlendekollegen/' . $heute . '.txt');
            echo "<a class='abstand' href=\"\"style=\"text-decoration:none\">$fehlende_kollegen</a>";
            echo '<table>';
            echo '<th><a class="th" href=""> Stunde </th>';
            echo '<th><a class="th" href=""> Klasse </th>';
            echo '<th><a class="th" href=""> Vertretung </th>';
            echo '<th><a class="th" href=""> Fach </th>';
            $sql = 'SELECT * FROM plan WHERE datum="' . $heute . '" ORDER BY klasse';
            foreach ($pdo->query($sql) as $row) {
                echo "<tr>";
                echo '<td><a class="td" href="">' . $row['stunde'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['klasse'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['vertretung'] . '</a></td>';
                echo '<td><a class="td" href="">' . $row['fach'] . '</a></td>';
                echo "</tr>";
            }
            echo '</table>';
        }
    }

    ?>
</main>
</body>
</html>
