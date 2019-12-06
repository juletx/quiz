<?php
	include '../php/DbConfig.php';
	$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

	$gaia = $_GET['gaia'];
	$sql = "SELECT * FROM questions WHERE gaia='$gaia'";
	$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

	while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
	}

	echo '<div>
			<h2>Emaitzak</h2>
			<h4>Erantzun zuzenak:<h4>
			<h4>Erantzun okerrak:<h4>
		<div>';

?>