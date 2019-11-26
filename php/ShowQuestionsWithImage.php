<?php include '../php/SecurityUsers.php' ?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div id="taula">
            <h2>Galderak ikusi</h2>
			<br>
            <?php
            include '../php/DbConfig.php';
            $esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
            
            $sql = "SELECT * FROM questions";
            $emaitza = mysqli_query($esteka, $sql);

            echo '<table border=1> <thead> <tr> <th> ID </th> <th> EPOSTA </th> 
            <th> GALDERA </th> <th> ERANTZUNA </th> 
            <th colspan="3"> ERANTZUN OKERRAK </th> <th> ZAILTASUNA </th> 
            <th> GAIA </th> <th> ARGAZKIA </th> </tr> </thead> <tbody>';

            while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
                echo '<tr> <td>'.$row['id'].'</td> <td>'.$row['eposta'].
                '</td> <td>'.$row['galdera'].'</td> <td>'.$row['erantzuna'].
                '</td> <td>'.$row['okerra1'].'</td> <td>'.$row['okerra2'].
                '</td> <td>'.$row['okerra3'].'</td> <td>'.zailtasuna($row['zailtasuna']).
                '</td> <td>'.$row['gaia'].'</td> <td>'.argazkia($row['argazkia']).'</td> </tr>';
            }

            echo '</tbody> </table>';

            function zailtasuna($zailtasuna) {
                switch($zailtasuna) {
                case 1:
                    return "Txikia";
                case 2:
                    return "Ertaina";
                case 3:
                    return "Handia";
                }
            }

            function argazkia($helbidea) {
                return "<img src='$helbidea' alt='Ez dauka' class='argazkia'>";
            }

            mysqli_free_result($emaitza);
            mysqli_close($esteka);
            ?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>