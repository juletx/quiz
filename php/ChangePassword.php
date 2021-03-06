<?php include '../php/SecurityCode.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<script src="../js/VerifyChangePassAjax.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<main class="container-fluid py-3 flex-fill">
		<div id="form">
			<form id="galderenF" name="galderenF" action="#" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>
						<h1>Aldatu pasahitza</h1>
					</legend>
					<div class="form-group">
						<label for="eposta">Berrezarpen eposta:</label>
						<input type="email" class="form-control" id="eposta" name="eposta"
							value="<?php echo $_SESSION['eposta2']?>" readonly>
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
						<label for="kodea">Berrezarpen kodea(*):</label>
						<input type="number" class="form-control" id="kodea" name="kodea" required>
					</div>
					<div class="form-group">
						<input class="btn btn-success" type="submit" id="submit" value="Aldatu pasahitza" disabled>
						<input class="btn btn-danger" type="reset" value="Berrezarri">
					</div>
				</fieldset>
			</form>

			<?php
                
                if (isset($_POST["eposta"])&& isset($_POST["pasahitza"]) && isset($_POST["pasahitza2"]) && isset($_POST["kodea"])) {
					$eposta = trim($_POST["eposta"]);
                    $password1 = trim($_POST["pasahitza"]);
                    $password2 = trim($_POST["pasahitza2"]);
                    $kodea = trim($_POST["kodea"]);
					if (empty($password1) || empty($password2) ||empty($eposta) ||empty($kodea)) {
						echo "<script>alert('Bete eremu guztiak'); history.go(-1);</script>";
					}else if ($password1 != $password2) {
                        echo "<script>alert('Pasahitzak ez dira berdinak');</script>";}
                    else if ($kodea != $_SESSION['kodea']) {
                        echo "<script>alert('Kodea ez da zuzena');</script>";
                    }else {
                        
                        include '../php/DbConfig.php';
                        $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
                        
                        $sql = "SELECT * FROM users WHERE eposta='$eposta'";
                        $emaitza = mysqli_query($esteka, $sql);

                        if (!$emaitza) {
                            echo "<script>alert('Errorea datu basearen kontsultan');</script>";
                            die();
                        } else if (mysqli_num_rows($emaitza) == 0) {
                            echo "<script>alert('Eposta horrekin ez dago erabiltzailerik');</script>";
                            die();
                        }

                        mysqli_free_result($emaitza);
                        
                        $password_hash = password_hash($password1, PASSWORD_DEFAULT);
                        $sql = "UPDATE users SET pasahitza='$password_hash' WHERE eposta='$eposta'"; 
                        $emaitza = mysqli_query($esteka, $sql);   
                        mysqli_close($esteka);			
                        if (!$emaitza) {
                            echo "Erabiltzailea ez da ondo eguneratu datu-basean";
                        } else {
                            echo "Erabiltzailea ondo eguneratu da datu-basean".PHP_EOL;
                        }
                    }
                }
            ?>
		</div>
	</main>
	<?php include '../html/Footer.html' ?>
</body>

</html>