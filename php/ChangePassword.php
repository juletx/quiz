<?php include '../php/SecurityCode.php' ?>
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
						<h2>Aldatu pasahitza</h2>
					</legend>
					<label for="eposta">Pasahitza berrezartzeko eposta:*</label>
					<input type="email" id="eposta" name="eposta" value="<?php echo $_SESSION['eposta']?>" readonly>
					<br>
                    <label for="pasahitza">Pasahitza(*):</label>
					<input type="password" id="pasahitza" name="pasahitza" required>
					<span id="baliozkoa"></span>
					<br><br>
					<label for="pasahitza2">Pasahitza errepikatu(*):</label>
					<input type="password" id="pasahitza2" name="pasahitza2" required>
					<br><br>
                    <input type="number" id="kodea" name="kodea" required>
                    <br><br>
                    <input class="btn btn-success" type="submit" id="submit" value="Bidali">
					<input class="btn btn-danger" type="reset" value="Berrezarri">
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
                        
                        $sql = "SELECT * FROM users WHERE email='$eposta'";
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
                        $sql = "UPDATE users SET password='$password_hash' WHERE email='$email'"; 
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
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>