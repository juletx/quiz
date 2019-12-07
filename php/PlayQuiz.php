<?php session_start (); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
	<script src="../js/PlayQuizAjax.js"></script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div id="jolastu">
			<h2>Jolastu</h2>

			<form id="galdera_gaia">
				<label for="gaia">Gaia:</label>
				<select class="form-control" id="gaia" name="gaia">
				<?php
					include '../php/DbConfig.php';
					$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

					$sql = "SELECT DISTINCT gaia FROM questions";
					$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");
					
					while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
						echo '<option value="'.$row['gaia'].'">'.$row['gaia'].'</option>';
					}

					mysqli_free_result($emaitza);
					mysqli_close($esteka);
				?>
				</select>
				<br>
				<input class="btn btn-success" type="submit" id="jolastu" value="Jolastu">
			</form>
			<?php
				if (isset($_GET['gaia'])){
					include '../php/DbConfig.php';
					$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

					$gaia = $_GET['gaia'];
					$sql = "SELECT * FROM questions WHERE gaia='$gaia' ORDER BY RAND()";
					$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");
					
					while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
						$erantzunak = array();
						array_push($erantzunak, $row['erantzuna']);
						array_push($erantzunak, $row['okerra1']);
						array_push($erantzunak, $row['okerra2']);
						array_push($erantzunak, $row['okerra3']);

						shuffle($erantzunak);

						echo '<form id="galdera">
								<h4>'.$row['galdera'].'</h4>
								<img src='.$row['argazkia'].' alt="Argazkia" class="argazkia">
								<br>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="erantzuna1" name="erantzuna" value="'.$erantzunak[0].'" required>
									<label for="erantzuna1" class="form-check-label">'.$erantzunak[0].'</label>
								</div>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="erantzuna2" name="erantzuna" value="'.$erantzunak[1].'" required>
									<label for="erantzuna2" class="form-check-label">'.$erantzunak[1].'</label>
								</div>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="erantzuna3" name="erantzuna" value="'.$erantzunak[2].'" required>
									<label for="erantzuna3" class="form-check-label">'.$erantzunak[2].'</label>
								</div>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="erantzuna4" name="erantzuna" value="'.$erantzunak[3].'" required>
									<label for="erantzuna4" class="form-check-label">'.$erantzunak[3].'</label>
								<br>
								<input class="btn btn-success" type="submit" id="erantzun" value="Erantzun">
								<input class="btn btn-warning" type="button" id="aldatu" value="Aldatu galdera">
								<input class="btn btn-danger" type="button" id="amaitu" value="Amaitu">
							</form>';
					}
					echo "<br>Galderak bukatu dira";
					mysqli_free_result($emaitza);
					mysqli_close($esteka);
				}
			?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>