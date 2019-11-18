<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl',true);

$eposta = trim($_GET['eposta']);
if (!empty($eposta)) {
	$erantzuna = $soapclient->call('egiaztatuE', array('x' => $eposta));
	if ($erantzuna == "BAI") {
		echo "Eposta WSn matrikulaturik dago";
	} else {
		echo "Eposta ez dago WSn matrikulaturik";
	}
}
?>
