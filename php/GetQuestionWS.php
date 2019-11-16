<?php
require_once ('../lib/nusoap.php');
require_once ('../lib/class.wsdlcache.php');

$ns = "../php/GetQuestionWS.php?wsdl";
$server = new soap_server;
$server->configureWSDL('GalderaEskuratu', $ns);
$server->wsdl->schemaTargetNamespace = $ns;

$server->wsdl->addComplexType('galderarenDatuak', 'complexType', 'struct', 'all', '', array(
    'eposta' => array(
        'name' => 'eposta',
        'type' => 'xsd:string'
    ),
    'galdera' => array(
        'name' => 'galdera',
        'type' => 'xsd:string'
	),
	'erantzuna' => array(
        'name' => 'erantzuna',
        'type' => 'xsd:string'
    )
));

$server->register('GalderaEskuratu', array('identifikadorea' => 'xsd:int'), 
array('galderarenDatuak' => 'tns:galderarenDatuak'), $ns);

function GalderaEskuratu($identifikadorea) {
	include '../php/DbConfig.php';
	$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
	
	$sql = "SELECT eposta, galdera, erantzuna FROM questions where ID='$identifikadorea'";
	$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

	$lerroKopurua = mysqli_num_rows($emaitza);
    if ($lerroKopurua == 0) {
        $eposta = '';
		$galdera = '';
		$erantzuna = '';
    } else {
		$row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC);
		$eposta = $row['eposta'];
		$galdera = $row['galdera'];
		$erantzuna = $row['erantzuna'];
	}

	mysqli_free_result($emaitza);
    mysqli_close($esteka);

	$galderarenDatuak = array('eposta' => $eposta, 'galdera' => $galdera, 'erantzuna' => $erantzuna);
	return $galderarenDatuak;
}

if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}
$server->service($HTTP_RAW_POST_DATA);
?>