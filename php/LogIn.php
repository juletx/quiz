<?php
    require_once "Config.php";
    $loginURL= $client->createAuthUrl();
?>
<form class="form-inline" id="login" name="login" method="post">
	<input class="form-control mr-sm-2 my-1 my-sm-0" type="email" id="eposta_login" name="eposta_login"
		pattern="([a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s)|([a-z]+\.?[a-z]{2,}@ehu.eu?s)" placeholder="Ehuko eposta" title="Epostak Ehuko ikasle edo irakasle batena izan behar du" required>
	<input class="form-control mr-sm-2 my-1 my-sm-0" type="password" id="pasahitza_login" name="pasahitza_login" placeholder="Pasahitza" required>
	<input class="btn btn-success mr-2 my-1 my-sm-0" type="submit" value="Login">
    <button type="button" class="btn btn-danger my-1 my-sm-0" onclick="window.location = '<?php echo $loginURL ?>';"><a class="fa fa-google"></a></button>
</form>

<?php
	if (isset($_POST["eposta_login"])) {
		include '../php/DbConfig.php';
		$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
		$eposta = $_POST['eposta_login'];
		$pasahitza = $_POST['pasahitza_login'];
	
		$sql = "SELECT * FROM users WHERE eposta='$eposta'";
		$emaitza = mysqli_query($esteka, $sql);
		if (!$emaitza) {
			echo "<script>alert('Errorea datu basearen kontsultan'); history.go(-1);</script>";
		} else {
			$lerroKopurua = mysqli_num_rows($emaitza);
			if ($lerroKopurua == 0) {
				echo "<script>alert('Erabiltzaile edo pasahitz okerra'); history.go(-1);</script>";
			} else {
				$row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC);
				if ($row['blokeatuta']) {
					echo "<script>alert('Erabiltzailea blokeatuta dago, jarri kontaktuan adminarekin'); history.go(-1);</script>";
				} else {
					$pasahitza_hash = $row['pasahitza'];
					if (!password_verify($pasahitza, $pasahitza_hash)) {
						echo "<script>alert('Erabiltzaile edo pasahitz okerra'); history.go(-1);</script>";
					} else {
						$_SESSION["eposta"] = $eposta;
						echo "<script>alert('Ongi etorri ".$eposta."');</script>";
						if ($eposta == "admin@ehu.es") {
							echo "<script>window.location.href = '../php/HandlingAccounts.php'</script>";
						}
						echo "<script>window.location.href = '../php/HandlingQuizesAjax.php'</script>";
					}
				}
			}
		}
		mysqli_free_result($emaitza);
		mysqli_close($esteka);
	}
?>