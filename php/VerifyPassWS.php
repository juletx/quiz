<?php
//nusoap.php klasea gehitzen dugu
require_once ('../lib/nusoap.php');
require_once ('../lib/class.wsdlcache.php');
//soap_server motako objektua sortzen dugu
$ns = "../php/VerifyPassWS.php?wsdl";
$server = new soap_server;
$server->configureWSDL('verify', $ns);
$server->wsdl->schemaTargetNamespace = $ns;
//inplementatu nahi dugun funtzioa erregistratzen dugu
//funtzio bat baino gehiago erregistra liteke …
$server->register('verify', array('ticketa' => 'xsd:string', 'pasahitza' => 'xsd:string'), 
array('erantzuna' => 'xsd:string'), $ns);
//funtzioa inplementatzen da
function verify($ticketa, $pasahitza) {
	if ($ticketa != "1010") {
		return "ZERBITZURIK GABE";
	}
	$fh = fopen('../txt/toppasswords.txt', 'r');
	while ($line = fgets($fh)) {
		if ($line == $pasahitza) {
			return "BALIOGABEA";
		}
	}	
    return "BALIOZKOA";
}
//nusoap klaseko service metodoari dei egiten diogu, behin parametroak
// prestatuta daudela
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}
$server->service($HTTP_RAW_POST_DATA);
?>