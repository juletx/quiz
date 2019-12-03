<?php
    require_once "../google-api-php-client-2.4.0/vendor/autoload.php";
    $client = new Google_Client();
    $client->setClientId("624494175204-oa15c1j6a04re9a7a2lfes6g7bj1v2o1.apps.googleusercontent.com");
    $client->setClientSecret("Mm_QiORlTRkFYhZhYj4fWsIY");
    $client->setApplicationName("Quiz game");
    $client->setRedirectUri("http://wst03.000webhostapp.com/wst03/php/LogGoogle.php");
    $client->setScopes(array("https://www.googleapis.com/auth/plus.login","https://www.googleapis.com/auth/userinfo.email"));
?>