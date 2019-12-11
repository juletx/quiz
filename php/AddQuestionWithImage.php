<?php include '../php/SecurityUsers.php' ?>
<?php
	$eposta = trim($_POST['eposta']);
	$galdera = trim($_POST['galdera']);
	$erantzuna = trim($_POST['erantzuna']);
	$okerra1 = trim($_POST['okerra1']);
	$okerra2 = trim($_POST['okerra2']);
	$okerra3 = trim($_POST['okerra3']);
	$zailtasuna = $_POST['zailtasuna'];
	$gaia = trim($_POST['gaia']);

	if (empty($eposta) || empty($galdera) || empty($erantzuna) || empty($okerra1) || 
		empty($okerra2) || empty($okerra3) || empty($zailtasuna) || empty($gaia)) {
		echo "<script>alert('Bete eremu guztiak');</script>";
	}
	else if (!(preg_match('/[a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s/', $eposta) || 
		preg_match('/[a-z]+\.?[a-z]{2,}@ehu\.eu?s/', $eposta))) {
		echo "<script>alert('Posta elektronikoa ez da zuzena');</script>";
	}
	else if (strlen($galdera) < 10) {
		echo "<script>alert('Galderak gutxienez 10 karaktere izan behar ditu');</script>";
	}
	else if ($zailtasuna != 1 && $zailtasuna != 2 && $zailtasuna != 3) {
		echo "<script>alert('Zailtasunak txikia, ertaina edo handia izan behar du');</script>";
	}
	else {
		include '../php/DbConfig.php';
		$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
		
		$direktorioa = '../images/';
		$argazkia = $direktorioa.'Galdera.png';
		
		if ($_FILES['argazkia']['size'] != 0) {
			$argazkia = $direktorioa.basename($_FILES['argazkia']['name']);
				
			if (!file_exists($argazkia)) {
				move_uploaded_file($_FILES['argazkia']['tmp_name'], $argazkia);
			}
		}
		
		$sql = "INSERT INTO questions VALUES (NULL, '$eposta', '$galdera' , '$erantzuna', 
			'$okerra1', '$okerra2', '$okerra3', $zailtasuna, '$gaia', '$argazkia')";
			
		$db_ondo = mysqli_query($esteka, $sql);
		
		mysqli_close($esteka);
		
		$xml = simplexml_load_file('../xml/Questions.xml');

		$assessmentItem = $xml->addChild('assessmentItem');
		$assessmentItem->addAttribute('author', $eposta);
		$assessmentItem->addAttribute('subject', $gaia);
		function zailtasuna($zailtasuna) {
			switch($zailtasuna) {
			case 1:
				return "Txikia";
			case 2:
				return "Ertaina";
			case 3:
				return "Handia";
			}
		}
		$assessmentItem->addAttribute('difficulty', zailtasuna($zailtasuna));

		$itemBody = $assessmentItem->addChild('itemBody');
		$itemBody->addChild('p', $galdera);

		$correctResponse = $assessmentItem->addChild('correctResponse');
		$correctResponse->addChild('value', $erantzuna);

		$incorrectResponses = $assessmentItem->addChild('incorrectResponses');
		$incorrectResponses->addChild('value', $okerra1);
		$incorrectResponses->addChild('value', $okerra2);
		$incorrectResponses->addChild('value', $okerra3);

		$xml_ondo = $xml->asXML('../xml/Questions.xml');

		if ($db_ondo && $xml_ondo) {
			echo "<script>alert('Galdera ondo gorde da datu-basean eta xml-an');</script>";
		} else if (!$db_ondo && $xml_ondo) {
			echo "<script>alert('Galdera gaizki gorde da datu-basean eta ondo xml-an');</script>";
		} else if ($db_ondo && !$xml_ondo) {
			echo "<script>alert('Galdera ondo gorde da datu-basean eta gaizki xml-an');</script>";
		} else {
			echo "<script>alert('Galdera gaizki gorde da datu-basean eta xml-an');</script>";
		}
	}	
?>