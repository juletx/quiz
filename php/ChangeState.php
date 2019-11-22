<?php
$eposta = trim($_GET["eposta"]);
if (empty($eposta)) {
	echo "<script>alert('Epostarik ez dago'); history.go(-1);</script>";
}

include '../php/DbConfig.php';
$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

$sql = "SELECT blokeatuta FROM users WHERE eposta='$eposta'";
$emaitza = mysqli_query($esteka, $sql);

if (!$emaitza) {
	echo "<script>alert('Errorea datu basearen kontsultan'); history.go(-1);</script>";
	die();
} else {
	$row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC);
	$bloakeatuta = $row['blokeatuta'];
}

mysqli_free_result($emaitza);

if ($bloakeatuta) {
	$bloakeatuta = 0;
	$erantzuna = "Aktibatuta";
} else {
	$bloakeatuta = 1;
	$erantzuna = "Blokeatuta";
}
	
echo $erantzuna;

$sql = "UPDATE users SET blokeatuta='$bloakeatuta' WHERE eposta='$eposta'";
$emaitza = mysqli_query($esteka, $sql);

mysqli_close($esteka);
?>