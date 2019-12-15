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
					<input type="radio" id="erantzuna1" name="erantzuna" value="'.$erantzunak[0].'" required>
					<label for="erantzuna1">'.$erantzunak[0].'</label>
					<br>
					<input type="radio" id="erantzuna2" name="erantzuna" value="'.$erantzunak[1].'" required>
					<label for="erantzuna2">'.$erantzunak[1].'</label>
					<br>
					<input type="radio" id="erantzuna3" name="erantzuna" value="'.$erantzunak[2].'" required>
					<label for="erantzuna3">'.$erantzunak[2].'</label>
					<br>
					<input type="radio" id="erantzuna4" name="erantzuna" value="'.$erantzunak[3].'" required>
					<label for="erantzuna4">'.$erantzunak[3].'</label>
					<br>
					<input class="btn btn-success" type="submit" id="erantzun" value="Erantzun">
					<input class="btn btn-warning" type="button" id="aldatu" value="Aldatu galdera">
					<input class="btn btn-danger" type="button" id="amaitu" value="Amaitu">
				</form>';
		}
		echo "Galderak bukatu dira";
		mysqli_free_result($emaitza);
		mysqli_close($esteka);
	}
?>