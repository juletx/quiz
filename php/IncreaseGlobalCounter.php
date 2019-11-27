<?php include '../php/SecurityUsers.php' ?>
<?php
	$xml = simplexml_load_file('../xml/Counter.xml');
	$xml->counter++;
	$xml->asXML('../xml/Counter.xml');
?>