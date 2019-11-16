<?php
require_once ('../lib/nusoap.php');
require_once ('../lib/class.wsdlcache.php');

$ns = "../php/VerifyPassWS.php?wsdl";
$server = new soap_server;
$server->configureWSDL('verify', $ns);
$server->wsdl->schemaTargetNamespace = $ns;

$server->register('verify', array('ticketa' => 'xsd:string', 'pasahitza' => 'xsd:string'), 
array('erantzuna' => 'xsd:string'), $ns);

function verify($ticketa, $pasahitza) {
	if ($ticketa != "1010") {
		return "ZERBITZURIK GABE";
	}
	$file = fopen('../txt/toppasswords.txt', 'r');
	while ($line = fgets($file)) {
		$filepass = preg_replace('/\s+/', '', $line);
		if ($filepass == $pasahitza) {
			return "BALIOGABEA";
		}
	}	
    return "BALIOZKOA";
}

if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}
$server->service($HTTP_RAW_POST_DATA);
?>