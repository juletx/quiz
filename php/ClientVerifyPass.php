<?php
//nusoap.php klasea gehitzen dugu
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
//nusoap_client motadun objektua sortzen dugu. http://www.mydomain.com/server.php
//erabiliko den SOAP zerbitzua non dagoen zehazten url horrek
$soapclient = new nusoap_client("../php/VerifyPassWS.php?wsdl", true);
//Web-Service-n inplementatu dugun funtzioari dei egiten diogu,
// eta itzultzen diguna inprimatzen dugu
if (isset($_POST['eposta'])) {
	$pasahitza = trim($_POST["pasahitza"]);
	$erantzuna = $soapclient->call('verify', array('ticketa' => "1010", 'pasahitza' => $pasahitza);
	switch ($erantzuna) {
	case "ZERBITZURIK GABE"
		echo "Zerbitzurik gabe";
		break;
	case "BALIOGABEA"
		echo "Pasahitz baliogabea";
		break;
	case "BALIOZKOA"
		echo "Pasahitz balioduna";
		break;
	}
//echo '<h2>Request</h2><pre>'.htmlspecialchars($soapclient->request, ENT_QUOTES).'</pre>';
//echo '<h2>Response</h2><pre>'.htmlspecialchars($soapclient->response,ENT_QUOTES).'</pre>';
//echo '<h2>Debug</h2>';
//echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>';
}
?>