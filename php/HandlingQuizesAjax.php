<?php include '../php/SecurityUsers.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<script src="../js/ValidateFieldsQuestion.js"></script>
	<script src="../js/ShowImageInForm.js"></script>
	<script src="../js/AddQuestionAjax.js"></script>
	<script src="../js/ShowQuestionsAjax.js"></script>
	<script src="../js/ShowQuestionCountAjax.js"></script>
	<script src="../js/ShowUserCountAjax.js"></script>
</head>

<body>
	<?php include '../php/Menus.php'?>
	<section class="main" id="s1">
		<div id="erabiltzaileKop">
		</div>
		<div id="galderaKop">
		</div>
		<br>
		<div id="form">
			<form id="galderenF" name="galderenF">
				<fieldset>
					<legend>
						<h2>Galdera gehitu</h2>
					</legend>
					<label for="eposta">Ehuko eposta(*):</label>
					<input type="text" id="eposta" name="eposta" value="<?php echo $_SESSION['eposta']?>" readonly>
					<br><br>
					<label for="galdera">Galdera(*):</label>
					<input type="text" id="galdera" name="galdera">
					<br><br>
					<label for="erantzuna">Erantzun zuzena(*):</label>
					<input type="text" id="erantzuna" name="erantzuna">
					<br><br>
					<label for="okerra1">Erantzun okerra 1(*):</label>
					<input type="text" id="okerra1" name="okerra1">
					<br><br>
					<label for="okerra2">Erantzun okerra 2(*):</label>
					<input type="text" id="okerra2" name="okerra2">
					<br><br>
					<label for="okerra3">Erantzun okerra 3(*):</label>
					<input type="text" id="okerra3" name="okerra3">
					<br><br>
					<label>Zailtasuna(*):</label>
					<input type="radio" id="txikia" name="zailtasuna" value="1">
					<label for="txikia">Txikia</label>
					<input type="radio" id="ertaina" name="zailtasuna" value="2" checked>
					<label for="ertaina">Ertaina</label>
					<input type="radio" id="handia" name="zailtasuna" value="3">
					<label for="handia">Handia</label>
					<br><br>
					<label for="gaia">Gaia(*):</label>
					<input type="text" id="gaia" name="gaia">
					<br><br>
					<label for="argazki">Argazkia:</label>
					<img id="argazki" alt="Aukeratu argazkia" class="argazkia" src="#" />
					<br><br>
					<input type="file" id="argazkiaa" name="argazkia" accept="image/*">
					<br><br>
					<input type="button" id="gehitu" value="Galdera gehitu">
					<input type="reset" value="Berrezarri">
					<br><br>
					<input type="button" id="ikusi" value="Galderak ikusi/ezkutatu" onClick="showQuestions()">
				</fieldset>
			</form>
		</div>
		<br>
		<div id="feedback" style="display:none">
		</div>
		<br>
		<div id="taula" style="display:none">
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>