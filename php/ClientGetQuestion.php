<?php include '../php/SecurityUsers.php' ?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div id="form">
			<form id="galderenF" name="galderenF" method="post">
				<fieldset>
					<legend>
						<h2>Galdera eskuratu</h2>
					</legend>
					<label for="identifikadorea">Identifikadorea(*):</label>
					<input type="number" id="identifikadorea" name="identifikadorea">
					<br><br>
					<input type="submit" value="Galdera eskuratu">
					<input type="reset" value="Berrezarri">
					<br><br>
					<label for="eposta">Eposta:</label>
					<input type="text" id="eposta" name="eposta" readonly>
					<br><br>
					<label for="galdera">Galdera:</label>
					<input type="text" id="galdera" name="galdera" readonly>
					<br><br>
					<label for="erantzuna">Erantzuna:</label>
					<input type="text" id="erantzuna" name="erantzuna" readonly>
				</fieldset>
			</form>

			<?php
			require_once('../lib/nusoap.php');
			require_once('../lib/class.wsdlcache.php');

			$soapclient = new nusoap_client("http://localhost/wst03/php/GetQuestionWS.php?wsdl", true);

			if (isset($_POST['identifikadorea'])) {
				$identifikadorea = trim($_POST['identifikadorea']);
				if (!empty($identifikadorea)) {
					$galderarenDatuak = $soapclient->call('GalderaEskuratu', array('identifikadorea' => $identifikadorea));
					$eposta = $galderarenDatuak['eposta'];
					$galdera = $galderarenDatuak['galdera'];
					$erantzuna = $galderarenDatuak['erantzuna'];
					if ($eposta == "") {
						echo "<script>alert('Ez dago galderarik identifikadore horrekin');</script>";
					} else {
						echo "<script>$('#identifikadorea').val('$identifikadorea'); $('#eposta').val('$eposta'); 
						$('#galdera').val('$galdera'); $('#erantzuna').val('$erantzuna');</script>";
					}
				}
			}
			?>
		</div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>