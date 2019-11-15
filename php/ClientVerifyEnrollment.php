<?php
//nusoap.php klasea gehitzen dugu
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
//nusoap_client motadun objektua sortzen dugu. http://www.mydomain.com/server.php
//erabiliko den SOAP zerbitzua non dagoen zehazten url horrek
$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/batuZerbitzua.php?wsdl',true);
//Web-Service-n inplementatu dugun funtzioari dei egiten diogu,
// eta itzultzen diguna inprimatzen dugu
$eposta=trim($_GET['eposta']);
if (!empty($eposta)){
    $erantzuna=$soapclient->call('egiaztatuE',array( 'x'=>$eposta));
    if($erantzuna==="BAI"){
        echo '<h1>Eposta matrikulaturik dago.</h1>';
    }else{
        echo '<h1>Eposta ez dago matrikulaturik.</h1>';
    }
}
?>
