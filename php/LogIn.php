<?php include '../php/SecurityLoggedOut.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div id="form">
			<form id="galderenF" name="galderenF" action="#" method="post">
				<fieldset>
					<legend>
						<h2>Login</h2>
					</legend>
					<label for="eposta">Ehuko eposta(*):</label>
					<input type="email" id="eposta" name="eposta"
						pattern="([a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s)|([a-z]+\.?[a-z]{2,}@ehu.eu?s)" required>
					<br><br>
					<label for="pasahitza">Pasahitza(*):</label>
					<input type="password" id="pasahitza" name="pasahitza" required>
					<br><br>
					<input type="submit" value="Login">
					<input type="reset" value="Berrezarri">
				</fieldset>
			</form>

			<?php
                if (isset($_POST["eposta"])) {
                    include '../php/DbConfig.php';
                    $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

                    $eposta = $_POST['eposta'];
					$pasahitza = $_POST['pasahitza'];
                
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
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>