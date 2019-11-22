<?php
    $eposta = trim($_POST["eposta"]);
    if (empty($eposta) {
        echo "<script>alert('Epostarik ez dago'); history.go(-1);</script>";
    }
        include '../php/DbConfig.php';
        $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
        
        $sql = "SELECT blokeatuta FROM users WHERE eposta='$eposta'";
        $emaitza = mysqli_query($esteka, $sql);

        if (!$emaitza) {
            echo "<script>alert('Errorea datu basearen kontsultan'); history.go(-1);</script>";
            die();
        } else {
            $balioa = mysqli_fetch_array($emaitza, MYSQLI_ASSOC);
        }
        mysqli_free_result($emaitza);
        if($balioa==0)
            $balioa=1;
        else $balioa=0;

        $sql = "UPDATE users SET blokeaututa = '$balioa' WHERE eposta='$eposta'";
        $emaitza = mysqli_query($esteka, $sql);
        mysqli_free_result($emaitza);
        mysqli_close($esteka);       
    }
?>