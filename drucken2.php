<?php


?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Vertretungsplan der Schule</title>
		<link rel="stylesheet" href="vpstyle.css" />
		<!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> -->
	</head>
	<body>
		<div id="header">
			echo <h2>Vertretungsplan</h2>
			echo '<h2 id="date"><a>'. . '</a></h2>';
		</div>
		<hr/>
		<main>
			<h2>
				Fehlende Kollegen: Fr. Jasak, Hr. Möhl, Fr. Heuer, Fr. Nickel
			</h2>
		</main>
		<br/>
		<table>
			<tr>
				$html .= '<td><a class="td">' . (empty($row['stunde']) ? "&nbsp;" : $row['stunde']) . '</a></td>'.PHP_EOL;
				$html .= '<td><a class="td">' . (empty($row['klasse']) ? "&nbsp;" : $row['klasse']) . '</a></td>'.PHP_EOL;
				$html .= '<td><a class="td">' . (empty($row['vertretung']) ? "&nbsp;" : $row['vertretung']) . '</a></td>'.PHP_EOL;
				$html .= '<td><a class="td">' . (empty($row['fach']) ? "&nbsp;" : $row['fach']) . '</a></td>'.PHP_EOL;
			</tr>
		</table>
	</body>
</html>
