<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

$soapclient = new nusoap_client("http://localhost/wst03/php/VerifyPassWS.php?wsdl", true);

$pasahitza = trim($_GET['pasahitza']);
if (!empty($pasahitza)) {
	$erantzuna = $soapclient->call('verify', array('ticketa' => "1010", 'pasahitza' => $pasahitza));
	switch ($erantzuna) {
	case "ZERBITZURIK GABE":
		echo "Zerbitzurik gabe";
		break;
	case "BALIOGABEA":
		echo "Pasahitz baliogabea";
		break;
	case "BALIOZKOA":
		echo "Pasahitz balioduna";
		break;
	}
}
?>