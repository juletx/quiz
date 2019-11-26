<div id='page-wrap'>
    <header class='main' id='h1'>

	<?php if (empty($_SESSION["eposta"])) { ?>

		<span><a href="SignUp.php">Erregistratu</a></span>
		<span><a href="LogIn.php">Login</a></span>
		<span>Anonimoa</span>
		<img id="argazkia" src="../images/Anonimoa.png" alt="argazkia" class="argazkiaLogin">
    </header>
	<nav class='main' id='n1' role='navigation'>
        <span><a href="Layout.php">Hasiera</a></span>
		<span><a href="Credits.php">Kredituak</a></span>
	</nav>
	
	<?php } else { $eposta = $_SESSION["eposta"]; ?>

		<span><a href="LogOut.php">Logout</a></span>
        <span><?php echo $eposta ?></span>

		<?php
		include '../php/DbConfig.php';
		$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
			
		$sql = "SELECT argazkia FROM users WHERE eposta='$eposta'";
		$emaitza = mysqli_query($esteka, $sql);
		
		if (!$emaitza) {
			echo "Errorea datu basearen kontsultan".PHP_EOL;
		} else {
			$lerroKopurua = mysqli_num_rows($emaitza);
			if ($lerroKopurua == 0) {
				echo "<script>alert('Argazkirik ez eposta honentzat')</script>".PHP_EOL;
			} else {
				$row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC);
				$helbidea = $row['argazkia'];
				echo '<img id="argazkia" src="'.$helbidea.'" alt="argazkia" class="argazkiaLogin">'.PHP_EOL;
			}            
		}

		mysqli_free_result($emaitza);
		mysqli_close($esteka);
		?>
	</header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href="Layout.php">Hasiera</a></span>
		
	<?php if ($eposta == "admin@ehu.es") { ?>

		<span><a href="HandlingAccounts.php">Erabiltzaileak kudeatu</a></span>
		
	<?php } else { ?>

		<span><a href="HandlingQuizesAjax.php">Galderak kudeatu</a></span>
		<span><a href="ShowQuestionsWithImage.php">Galderak ikusi</a></span>
		<span><a href="ClientGetQuestion.php">Galderak eskuratu</a></span>

	<?php } ?>

		<span><a href="Credits.php">Kredituak</a></span>
	</nav>

	<?php } ?>
