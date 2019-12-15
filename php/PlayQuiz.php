<?php session_start (); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<script src="../js/PlayQuizAjax.js"></script>
    <script src="../js/ChangeQuestion.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<main class="container-fluid py-3 flex-fill">
		<div id="jolastua">
			<div id="form">
				<form id="galdera_gaia">
					<fieldset <?php if (isset($_GET['nick']) && isset($_GET['gaia'])) echo 'disabled'?>>
                    <legend>
                        <h1>Jolastu</h1>
                    </legend>
                    <div class="form-row">
						<div class="form-group col-sm-6">
							<label for="nick">Nicka:</label>
							<input type="text" class="form-control" id="nick" name="nick"
								value="<?php if (isset($_SESSION['nick'])) echo $_SESSION['nick']?>" required>
						</div>
						<div class="form-group col-sm-6">
							<label for="gaia">Gaia:</label>
							<select class="form-control" id="gaia" name="gaia" required>
								<?php
								include '../php/DbConfig.php';
								$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

								$sql = "SELECT DISTINCT gaia FROM questions";
								$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");
								
								while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
                                    if (isset($_GET['gaia'])){
                                        if ($row['gaia']=$_GET['gaia']){
                                            echo '<option value="'.$row['gaia'].'" selected>'.$row['gaia'].'</option>';
                                        }else{
                                            echo '<option value="'.$row['gaia'].'">'.$row['gaia'].'</option>';
                                        }
                                    }else{
                                        echo '<option value="'.$row['gaia'].'">'.$row['gaia'].'</option>';
                                    }
                                    
								}

								mysqli_free_result($emaitza);
								mysqli_close($esteka);
								?>
							</select>
						</div>
						<div class="col text-center">
							<input class="btn btn-success" type="submit" id="jolastu" value="Jolastu">
						</div>
					</div>
				</form>
			</div>
			<?php
				if (isset($_GET['gaia'])){
					include '../php/DbConfig.php';
					$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

					$gaia = $_GET['gaia'];
                    $_SESSION['nick']=$_GET['nick'];
                    $sql = "SELECT * FROM questions WHERE gaia='$gaia' ORDER BY RAND()";
					$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");
                    $galderaKop=mysqli_num_rows($emaitza);
                    $count =-1;
                    echo'<div id="galderak">';
                    while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
						$erantzunak = array();
						array_push($erantzunak, $row['erantzuna']);
						array_push($erantzunak, $row['okerra1']);
						array_push($erantzunak, $row['okerra2']);
						array_push($erantzunak, $row['okerra3']);

						shuffle($erantzunak);
                        $count = $count +1;
                        if($galderaKop==1){
                            echo '<div id="galde'.$count.'"><form id="galdera'.$count.'">
                                        <h4>'.$row['galdera'].'</h4>
                                        <img src='.$row['argazkia'].' alt="Argazkia" class="argazkia">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna1'.$count.'" name="erantzuna" value="'.$erantzunak[0].'" required>
                                                <label for="erantzuna1" class="form-check-label">'.$erantzunak[0].'</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna2'.$count.'" name="erantzuna" value="'.$erantzunak[1].'" required>
                                                <label for="erantzuna2" class="form-check-label">'.$erantzunak[1].'</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna3'.$count.'" name="erantzuna" value="'.$erantzunak[2].'" required>
                                                <label for="erantzuna3" class="form-check-label">'.$erantzunak[2].'</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna4'.$count.'" name="erantzuna" value="'.$erantzunak[3].'" required>
                                                <label for="erantzuna4" class="form-check-label">'.$erantzunak[3].'</label>
                                            </div>
                                        </div>
                                        <input class="btn btn-success" type="submit" id="erantzun'.$count.'" value="Erantzun">
                                        <input class="btn btn-danger" type="button" id="amaitu'.$count.'" value="Amaitu">
                                    </form></div>';
                                    echo "<br>Galdera bakarra dago kategoria honetan";
                        }else{
                            if($count==0){
                                echo '<div id="galde'.$count.'"><form id="galdera'.$count.'">
                                        <h4>'.$row['galdera'].'</h4>
                                        <img src='.$row['argazkia'].' alt="Argazkia" class="argazkia">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna1'.$count.'" name="erantzuna" value="'.$erantzunak[0].'" required>
                                                <label for="erantzuna1" class="form-check-label">'.$erantzunak[0].'</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna2'.$count.'" name="erantzuna" value="'.$erantzunak[1].'" required>
                                                <label for="erantzuna2" class="form-check-label">'.$erantzunak[1].'</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna3'.$count.'" name="erantzuna" value="'.$erantzunak[2].'" required>
                                                <label for="erantzuna3" class="form-check-label">'.$erantzunak[2].'</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna4'.$count.'" name="erantzuna" value="'.$erantzunak[3].'" required>
                                                <label for="erantzuna4" class="form-check-label">'.$erantzunak[3].'</label>
                                            </div>
                                        </div>
                                        <input class="btn btn-success" type="submit" id="erantzun'.$count.'" value="Erantzun">
                                        <input class="btn btn-warning" type="button" id="aldatu'.$count.'" value="Aldatu galdera" onclick="next()">
                                        <input class="btn btn-danger" type="button" id="amaitu'.$count.'" value="Amaitu">
                                    </form></div>';
                            }else if ($galderaKop==$count+1){
                                echo '<div id="galde'.$count.'" style="display: none;"><form id="galdera'.$count.'">
                                        <h4>'.$row['galdera'].'</h4>
                                        <img src='.$row['argazkia'].' alt="Argazkia" class="argazkia">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna1'.$count.'" name="erantzuna" value="'.$erantzunak[0].'" required>
                                                <label for="erantzuna1" class="form-check-label">'.$erantzunak[0].'</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna2'.$count.'" name="erantzuna" value="'.$erantzunak[1].'" required>
                                                <label for="erantzuna2" class="form-check-label">'.$erantzunak[1].'</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna3'.$count.'" name="erantzuna" value="'.$erantzunak[2].'" required>
                                                <label for="erantzuna3" class="form-check-label">'.$erantzunak[2].'</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="erantzuna4'.$count.'" name="erantzuna" value="'.$erantzunak[3].'" required>
                                                <label for="erantzuna4" class="form-check-label">'.$erantzunak[3].'</label>
                                            </div>
                                        </div>
                                        <input class="btn btn-success" type="submit" id="erantzun'.$count.'" value="Erantzun">
                                        <input class="btn btn-warning" type="button" id="aldatu'.$count.'" value="Aldatu galdera" onclick="next()">
                                        <input class="btn btn-danger" type="button" id="amaitu'.$count.'" value="Amaitu">
                                        echo "<br>Galderak bukatu dira";
                                    </form></div>';   
                                    
                            }else{
                                echo '<div id="galde'.$count.'" style="display: none;"><form id="galdera'.$count.'">
                                            <h4>'.$row['galdera'].'</h4>
                                            <img src='.$row['argazkia'].' alt="Argazkia" class="argazkia">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="erantzuna1'.$count.'" name="erantzuna" value="'.$erantzunak[0].'" required>
                                                    <label for="erantzuna1" class="form-check-label">'.$erantzunak[0].'</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="erantzuna2'.$count.'" name="erantzuna" value="'.$erantzunak[1].'" required>
                                                    <label for="erantzuna2" class="form-check-label">'.$erantzunak[1].'</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="erantzuna3'.$count.'" name="erantzuna" value="'.$erantzunak[2].'" required>
                                                    <label for="erantzuna3" class="form-check-label">'.$erantzunak[2].'</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="erantzuna4'.$count.'" name="erantzuna" value="'.$erantzunak[3].'" required>
                                                    <label for="erantzuna4" class="form-check-label">'.$erantzunak[3].'</label>
                                                </div>
                                            </div>
                                            <input class="btn btn-success" type="submit" id="erantzun'.$count.'" value="Erantzun">
                                            <input class="btn btn-warning" type="button" id="aldatu'.$count.'" value="Aldatu galdera" onclick="next()">
                                            <input class="btn btn-danger" type="button" id="amaitu'.$count.'" value="Amaitu">
                                        </form></div>';
                            }
                    
                        }    
                    }echo'</div>';
                    mysqli_free_result($emaitza);
					mysqli_close($esteka);
				}
			?>
		</div>
	</main>
	<?php include '../html/Footer.html' ?>
</body>

</html>