<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
	<a class="navbar-brand" href="Layout.php">Quiz</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup1"
		aria-controls="navbarNavAltMarkup1" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup1">
		<div class="navbar-nav mr-auto">
			<a class="nav-item nav-link" href="Layout.php">Hasiera</a>
			<a class="nav-item nav-link" href="PlayQuiz.php">Jolastu</a>

		<?php if (empty($_SESSION["eposta"])) { ?>

			<a class="nav-item nav-link" href="Credits.php">Kredituak</a>
		</div>
		<div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="SendPasswordEmail.php">Pasahitza berreskuratu</a>
            <a class="nav-item nav-link" href="SignUp.php">Erregistratu</a>
			<?php include 'LogIn.php'; ?>
		</div>

		<?php } else { 
			include '../php/DbConfig.php';
			$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

			$eposta = $_SESSION["eposta"];
				
			$sql = "SELECT argazkia FROM users WHERE eposta='$eposta'";
			$emaitza = mysqli_query($esteka, $sql);
			
			if (!$emaitza) {
				echo "Errorea datu basearen kontsultan".PHP_EOL;
			} else {
				$lerroKopurua = mysqli_num_rows($emaitza);
				if ($lerroKopurua != 0){
					$row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC);
					$helbidea = $row['argazkia'];
				}            
			}
            if (!empty($_SESSION["image"])){
                $helbidea=$_SESSION["image"];
            }
			mysqli_free_result($emaitza);
			mysqli_close($esteka);
		
			if ($eposta == "admin@ehu.es") { 
			?>
			<a class="nav-item nav-link" href="HandlingAccounts.php">Erabiltzaileak kudeatu</a>

		<?php } else { ?>

			<a class="nav-item nav-link" href="ShowQuestionsWithImage.php">Galderak ikusi</a>
			<a class="nav-item nav-link" href="HandlingQuizesAjax.php">Galderak kudeatu</a>
			<a class="nav-item nav-link" href="ClientGetQuestion.php">Galdera eskuratu</a>
		
		<?php } ?>

			<a class="nav-item nav-link" href="Credits.php">Kredituak</a></span>
		</div>
		
		<div class="navbar-nav ml-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					<?php 
						echo $eposta;
						echo '<img id="argazkia" src="'.$helbidea.'" alt="argazkia" class="argazkiaLogin">'.PHP_EOL;
					?>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item"
						onclick="if (confirm('Ziur al zaude?')) location.href='LogOut.php'">Logout</a>
				</div>
			</li>
		</div>
		<?php } ?>
	</div>
</nav>