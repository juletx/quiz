<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="loggedOut"><a href="SignUp.php">Erregistratu</a></span>
        <span class="loggedOut"><a href="LogIn.php">Login</a></span>
        <span class="loggedIn"><a href="<?php if (isset($_GET['eposta'])) echo 'LogOut.php?eposta='.$_GET['eposta']?>">Logout</a></span>
        <span><?php echo (isset($_GET['eposta'])) ? $_GET['eposta'] : 'Anonimoa'?></span>        
        <img id="argazkia" src="" alt="argazkia" class="argazkiaLogin"> 
    </header>
    <nav class='main' id='n1' role='navigation'>
        <span><a href="<?php echo (isset($_GET['eposta'])) ? 'Layout.php?eposta='.$_GET['eposta'] : 'Layout.php'?>">Hasiera</a></span>
        <!--span class="loggedIn"><a href="<?php if (isset($_GET['eposta'])) echo 'QuestionFormWithImage.php?eposta='.$_GET['eposta']?>">Galdera gehitu</a></span-->
        <span class="loggedIn"><a href="<?php if (isset($_GET['eposta'])) echo 'ShowQuestionsWithImage.php?eposta='.$_GET['eposta']?>">Galderak ikusi</a></span>
        <!--span class="loggedIn"><a href="<?php if (isset($_GET['eposta'])) echo 'ShowXmlQuestions.php?eposta='.$_GET['eposta']?>">XML Galderak ikusi</a></span-->
		<span class="loggedIn"><a href="<?php if (isset($_GET['eposta'])) echo 'HandlingQuizesAjax.php?eposta='.$_GET['eposta']?>">Galderak kudeatu</a></span>
		<span class="loggedIn"><a href="<?php if (isset($_GET['eposta'])) echo 'ClientGetQuestion.php?eposta='.$_GET['eposta']?>">Galdera eskuratu</a></span>
		<span><a href="<?php echo (isset($_GET['eposta'])) ? 'Credits.php?eposta='.$_GET['eposta'] : 'Credits.php'?>">Kredituak</a></span>
    </nav>

    <?php
        if (isset($_GET["eposta"])) {
            echo "<script>$('.loggedOut').hide()</script>".PHP_EOL;

            include '../php/DbConfig.php';
            $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

            $eposta = $_GET['eposta'];
                
            $sql = "SELECT argazkia FROM users WHERE eposta='$eposta'";
            $emaitza = mysqli_query($esteka, $sql);
            
            if (!$emaitza) {
                echo "Errorea datu basearen kontsultan".PHP_EOL;
            } else {
                $lerroKopurua = mysqli_num_rows($emaitza);
                if ($lerroKopurua == 0) {
                    echo "<script>alert('Argazkirik ez eposta honentzat')</script>".PHP_EOL;
                } else {
                    $row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC);
                    $helbidea = $row['argazkia'];
                    echo "<script>$('#argazkia').attr('src', '".$helbidea."')</script>".PHP_EOL;   
                }            
            }

            mysqli_free_result($emaitza);
            mysqli_close($esteka);
        } else {
            echo "<script>$('.loggedIn').hide();</script>".PHP_EOL;
            echo "<script>$('#argazkia').attr('src', '../images/Anonimoa.png')</script>".PHP_EOL; 
        }
    ?>