<?php session_start (); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<main class="container-fluid py-3 flex-fill">
		<h1>Quiz: galderen jokoa</h1>
		<br>
		<h2>10 jokalari onenak</h2>
		<div class="table-responsive-sm" id="taula">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>POSTUA</th>
						<th>NICKA</th>
						<th>PUNTUAK</th>
						<th>ZUZENAK</th>
						<th>OKERRAK</th>
					</tr>
				</thead>
				<tbody>
					<?php
						include '../php/DbConfig.php';
						$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
						
						$sql = "SELECT * FROM results ORDER BY 3*zuzenak-okerrak DESC LIMIT 10";
						$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

						$postua = 1;

						while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
							$puntuak = 3 * $row['zuzenak'] - $row['okerrak'];
							echo '<tr>
									<td>'.$postua.'</td>
									<td>'.$row['nicka'].'</td>
									<td>'.$puntuak.'</td>
									<td>'.$row['zuzenak'].'</td>
									<td>'.$row['okerrak'].'</td>
								</tr>';
							$postua = $postua + 1;
						}
					?>
				<tbody>
			</table>
		</div>
	</main>
	<?php include '../html/Footer.html' ?>
</body>

</html>