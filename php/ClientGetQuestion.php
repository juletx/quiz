<?php include '../php/SecurityUsers.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<main class="container-fluid py-3 flex-fill">
		<div id="form">
			<form id="galderenF" name="galderenF" method="post">
				<fieldset>
					<legend>
						<h1>Galdera eskuratu</h1>
					</legend>
					<div class="form-group">
						<label for="identifikadorea">Identifikadorea(*):</label>
						<input type="number" class="form-control" id="identifikadorea" name="identifikadorea" min="1">
					</div>
					<div class="form-group">
						<input class="btn btn-success" type="submit" value="Galdera eskuratu">
						<input class="btn btn-danger" type="reset" value="Berrezarri">
					</div>
					<div class="form-group">
						<label for="eposta">Eposta:</label>
						<input type="text" class="form-control" id="eposta" name="eposta" readonly>
					</div>
					<div class="form-group">
						<label for="galdera">Galdera:</label>
						<input type="text" class="form-control" id="galdera" name="galdera" readonly>
					</div>
					<div class="form-group">
						<label for="erantzuna">Erantzuna:</label>
						<input type="text" class="form-control" id="erantzuna" name="erantzuna" readonly>
					</div>
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
	</main>
	<?php include '../html/Footer.html' ?>
</body>

</html>