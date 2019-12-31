<?php session_start (); ?>
<?php
	include '../php/DbConfig.php';
	$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

	$gaia = $_SESSION['gaia'];

	$sql = "SELECT * FROM questions WHERE gaia='$gaia'";
	$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

	$zuzenak = 0;
	$okerrak = 0;
	$hutsak = 0;

	while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
		$id = $row['id'];
		if (isset($_POST[$id])) {
			$_SESSION['galderak'][$id] = "1";
			if ($_POST[$id] == $row['erantzuna']){
				$zuzenak = $zuzenak + 1;
			}
			else {
				$okerrak = $okerrak + 1;
			}
		}
		else {
			$hutsak = $hutsak + 1;
		}
	}

	$nicka = $_SESSION['nick'];

	$sql = "SELECT * FROM results WHERE nicka='$nicka'";
	$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

	if (mysqli_num_rows($emaitza) == 0) {
		$sql = "INSERT INTO results VALUES ('$nicka', $zuzenak, $okerrak)";
	}
	else {
		$sql = "UPDATE results SET zuzenak=zuzenak+".$zuzenak.", okerrak=okerrak+".$okerrak;
	}

	$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

	echo '<h2>Emaitzak</h2>
		<h4>Erantzun zuzenak: '.$zuzenak.'<h4>
		<h4>Erantzun okerrak: '.$okerrak.'<h4>
		<h4>Erantzun gabekoak: '.$hutsak.'<h4>';
?>