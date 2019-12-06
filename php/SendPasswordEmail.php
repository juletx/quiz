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
			<form id="galderenF" name="galderenF" action="#" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>
						<h2>Mezua bidali</h2>
					</legend>
					<label for="eposta">Pasahitza berrezartzeko eposta:*</label>
					<input type="email" id="eposta" name="eposta"
						pattern="([a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s)|([a-z]+\.?[a-z]{2,}@ehu\.eu?s)" required>
					<input class="btn btn-success" type="submit" id="submit" value="Bidali">
					<input class="btn btn-danger" type="reset" value="Berrezarri">
				</fieldset>
			</form>

			<?php
                if (isset($_POST["eposta"])) {
					$eposta = trim($_POST["eposta"]);

					if (empty($eposta)) {
						echo "<script>alert('Bete eremu guztiak'); history.go(-1);</script>";
					}
					else if (!(preg_match('/[a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s/', $eposta) || 
						preg_match('/[a-z]+\.?[a-z]{2,}@ehu\.eu?s/', $eposta))) {
						echo "<script>alert('Posta elektronikoa ez da zuzena'); history.go(-1);</script>";
					}
					else {
                        include '../php/DbConfig.php';
						$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
						$sql = "SELECT * FROM users WHERE eposta='$eposta'";
						$emaitza = mysqli_query($esteka, $sql);

						if (!$emaitza) {
							echo "<script>alert('Errorea datu basearen kontsultan'); history.go(-1);</script>";
							die();
						} else if (mysqli_num_rows($emaitza) == 0) {
							echo "<script>alert('Eposta horrekin ez dago erabiltzailerik.'); history.go(-1);</script>";
							die();
						}
						
						mysqli_free_result($emaitza);
                        $subject="Pasahitzaren berrezarpera";
                        $kodea=rand(100000,999999);
                        $_SESSION['eposta']=$eposta;
                        $_SESSION['kodea']=$kodea;
                        $mezua = "
                        <html>
                        <head>
                        <title>Pasahitza berreskuratu<title>
                        </head>
                        <body>
                        <h3>Jarraitu beharreko urratsak:</h3>
                        <ol>
                        <li>Egin klik azpiko estekan</li>
                        <li>Pasahitz berria eta lortutako kodea idatzi</li>
                        <li>Orrialdeak jakinaraziko dizu pazahitza zuzen aldatu</li>
                        </ol>
                        <h3>Orrialde honetara joan:</h3>
                        <h2><a href='http://wst03.000webhostapp.com/wst03/php/ChangePassword.php?eposta=".$eposta."'>Hemen</a></h2>
                        <h2>Berrezarpen kodea:</h2>
                        <h2>".$kodea."</h2>
                        </body>
                        </html>
                        ";
                        $headers =  'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'From: Quiz Game <info@wst03.000webhostapp.com>' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        mail($eposta,$subject,$mezua,$headers);
                        echo 'Eposta zuzen bidali da';
                    }
                }
            ?>
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>