<?php include '../php/SecurityLoggedOut.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<script src="../js/ShowImageInForm.js"></script>
	<script src="../js/VerifyEnrollmentAjax.js"></script>
	<script src="../js/VerifyPassAjax.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<main class="container-fluid py-3 flex-fill">
		<div id="form">
			<form id="galderenF" name="galderenF" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>
						<h1>Erregistratu</h1>
					</legend>
					<div class="form-group">
						<label for="eposta">Ehuko eposta(*):</label>
						<input type="email" class="form-control" id="eposta" name="eposta"
							pattern="([a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s)|([a-z]+\.?[a-z]{2,}@ehu\.eu?s)" required>
						<div id="matrikulatuta"></div>
					</div>
					<div class="form-group">
						<label for="pasahitza">Pasahitza(*):</label>
						<input type="password" class="form-control" id="pasahitza" name="pasahitza" required>
						<div id="baliozkoa"></div>
					</div>
					<div class="form-group">
						<label for="pasahitza2">Pasahitza errepikatu(*):</label>
						<input type="password" class="form-control" id="pasahitza2" name="pasahitza2" required>
					</div>
					<div class="form-group">
						<label>Erabiltzaile mota(*):</label>
						<br>
						<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" id="ikaslea" name="mota" value="ikaslea"
								checked>
							<label for="ikaslea" class="form-check-label">Ikaslea</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" id="irakaslea" name="mota" value="irakaslea">
							<label for="irakaslea" class="form-check-label">Irakaslea</label>
						</div>
					</div>
					<div class="form-group">
						<label for="deiturak">Deiturak(*):</label>
						<input type="text" class="form-control" id="deiturak" name="deiturak"
							pattern="[A-Za-z]{2,}( [A-Za-z]{2,})+" required>
					</div>
					<label for="argazki">Argazkia:</label>
					<img id="argazki" alt="Aukeratu argazkia" class="argazkia" src="#" />
					<br><br>
					<div class="form-group">
						<input type="file" class="form-control-file" id="argazkiaa" name="argazkia" accept="image/*">
					</div>
					<div class="form-group">
						<input class="btn btn-success" type="submit" id="submit" value="Erregistratu" disabled="true">
						<input class="btn btn-danger" type="reset" value="Berrezarri">
					</div>
				</fieldset>
			</form>

			<?php
                if (isset($_POST["eposta"])) {
					$eposta = trim($_POST["eposta"]);
					$mota = trim($_POST["mota"]);
					$deiturak = trim($_POST["deiturak"]);
					$pasahitza = trim($_POST["pasahitza"]);
					$pasahitza2 = trim($_POST["pasahitza2"]);

					if (empty($eposta) || empty($mota) || empty($deiturak) || empty($pasahitza) || empty($pasahitza2)) {
						echo "<script>alert('Bete eremu guztiak'); history.go(-1);</script>";
					}
					else if (!(preg_match('/[a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s/', $eposta) || 
						preg_match('/[a-z]+\.?[a-z]{2,}@ehu\.eu?s/', $eposta))) {
						echo "<script>alert('Posta elektronikoa ez da zuzena'); history.go(-1);</script>";
					}
					else if ($mota != "ikaslea" && $mota != "irakaslea") {
						echo "<script>alert('Erabiltzaile motak ikaslea edo irakaslea izan behar du'); history.go(-1);</script>";
					}
					else if (!preg_match('/[A-Za-z]{2,}( [A-Za-z]{2,})+/', $deiturak)) {
						echo "<script>alert('Deiturak gutxienez izena eta abizen bat eduki behar ditu'); history.go(-1);</script>";
					}
					else if (strlen($pasahitza) < 6 || $pasahitza != $pasahitza2) {
						echo "<script>alert('Pasahitzek ez dute 6ko luzera edo ez dira berdinak'); history.go(-1);</script>";
					}
					else {
                        include '../php/DbConfig.php';
						$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
						
						$sql = "SELECT * FROM users WHERE eposta='$eposta'";
						$emaitza = mysqli_query($esteka, $sql);

						if (!$emaitza) {
							echo "<script>alert('Errorea datu basearen kontsultan'); history.go(-1);</script>";
							die();
						} else if (mysqli_num_rows($emaitza) > 0) {
							echo "<script>alert('Eposta horrekin jadanik erabiltzaile bat dago'); history.go(-1);</script>";
							die();
						}
						
						mysqli_free_result($emaitza);
					
						$direktorioa = '../images/';
                    	$argazkia = $direktorioa.'Anonimoa.png';
                
                    	if ($_FILES['argazkia']['size'] != 0) {
                    	    $argazkia = $direktorioa.basename($_FILES['argazkia']['name']);
						
                    	    if (!file_exists($argazkia)) {
								move_uploaded_file($_FILES['argazkia']['tmp_name'], $argazkia);
                    	    }
						}
						
						$pasahitza_hash = password_hash($pasahitza, PASSWORD_DEFAULT);

						$sql = "INSERT INTO users VALUES ('$eposta', '$mota', '$deiturak', '$pasahitza_hash', '$argazkia', 0)";
						$emaitza = mysqli_query($esteka, $sql);
			
						mysqli_close($esteka);
                
                    	if (!$emaitza) {
                    	    echo "<script>alert('Erabiltzailea ez da ondo gorde datu-basean'); history.go(-1);</script>";
                    	} else {
                        	echo "<script>alert('Erabiltzailea ondo gorde da datu-basean'); window.location.href = '../php/Layout.php'</script>".PHP_EOL;
                    	}
                    }
                }
            ?>
		</div>
	</main>
	<?php include '../html/Footer.html' ?>
</body>

</html>