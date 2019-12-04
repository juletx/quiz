<?php
    session_start();
    require_once "Config.php";
    if (isset($_GET['code'])){
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $_SESSION['access_token']=$token;

    }
    $service = new Google_Service_Oauth2($client);
    $user = $service->userinfo->get();

    $_SESSION['eposta'] = $user->email;
    $_SESSION['image']= $user->picture;
    $newURL="HandlingQuizesAjax.php";
    header('Location: '.$newURL);
?>