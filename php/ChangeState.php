<?php include '../php/SecurityAdmin.php' ?>
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
	$blokeatuta = $row['blokeatuta'];
}

mysqli_free_result($emaitza);

if ($blokeatuta) {
	$blokeatuta = 0;
	$erantzuna = "<span style='color:green'>Aktibatuta</span>";
} else {
	$blokeatuta = 1;
	$erantzuna = "<span style='color:red'>Blokeatuta</span>";
}
	
echo $erantzuna;

$sql = "UPDATE users SET blokeatuta='$blokeatuta' WHERE eposta='$eposta'";
$emaitza = mysqli_query($esteka, $sql);

mysqli_close($esteka);
?>