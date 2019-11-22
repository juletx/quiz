<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
	<script src="../js/ChangeStateAjax.js"></script>
	<script src="../js/RemoveUserAjax.js"></script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div>
            <?php
                include '../php/DbConfig.php';
				$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
			
				$sql = "SELECT * FROM users";
				$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

				echo '<table> <thead> <tr> <th> EPOSTA </th> 
            	<th> PASAHITZA </th> <th> ARGAZKIA </th> 
            	<th> EGOERA </th> <th> BLOKEATU </th> 
				<th> EZABATU </th> </tr> </thead> <tbody>';
				   
				while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
					echo '<tr> <td>'.$row['eposta'].'</td> <td>'.$row['pasahitza'].
					'</td> <td>'.argazkia($row['argazkia']).'</td> <td>'.blokeatuta($row['blokeatuta']).
					'</td> <td> <button>Egoera aldatu</button> </td> <td> <button>Ezabatu</button> </td> </tr>';
				}
	
				echo '</tbody> </table>';

				function blokeatuta($blokeatuta) {
					if ($blokeatuta)
						return "Blokeatuta";
					return "Aktibo";
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