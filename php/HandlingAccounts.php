<?php include '../php/SecurityAdmin.php' ?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
	<script src="../js/ChangeStateAjax.js"></script>
	<script src="../js/RemoveUserAjax.js"></script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <main class="container-fluid py-3 flex-fill">
		<h2>Erabiltzaileak kudeatu</h2>
		<div class="table-responsive-lg" id="taula">
            <?php
                include '../php/DbConfig.php';
				$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
			
				$sql = "SELECT * FROM users";
				$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

				echo '<table class="table table-bordered table-hover"> <thead> <tr> 
				<th> EPOSTA </th> <th> PASAHITZA </th> <th> MOTA </th> <th> ARGAZKIA </th> 
            	<th> EGOERA </th> <th> ALDATU </th> <th> EZABATU </th> </tr> </thead> <tbody>';
				   
				while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
					echo '<tr> <td>'.$row['eposta'].'</td> <td style="word-wrap:break-word; max-width:300px">'.$row['pasahitza'].
					'</td> <td>'.$row['mota'].'</td> <td>'.argazkia($row['argazkia']).'</td> <td>'.blokeatuta($row['blokeatuta']).
					'</td> <td>'.aldatuButton($row['eposta']).'</td> <td>'.ezabatuButton($row['eposta']).'</td> </tr>';
				}
	
				echo '</tbody> </table>';

				function blokeatuta($blokeatuta) {
					if ($blokeatuta)
						return "<span style='color:red'>Blokeatuta</span>";
					return "<span style='color:green'>Aktibatuta</span>";
				}

				function argazkia($helbidea) {
					return "<img src='$helbidea' alt='Ez dauka' class='argazkia'>";
				}

				function aldatuButton($eposta) {
					if ($eposta == "admin@ehu.es")
						return '<button class="aldatu btn btn-warning" disabled>Egoera aldatu</button>';
					return '<button class="aldatu btn btn-warning">Egoera aldatu</button>';
				}

				function ezabatuButton($eposta) {
					if ($eposta == "admin@ehu.es")
						return '<button class="ezabatu btn btn-danger" disabled>Ezabatu</button>';
					return '<button class="ezabatu btn btn-danger">Ezabatu</button>';
				}

				mysqli_free_result($emaitza);
            	mysqli_close($esteka);
            ?>
        </div>
	</main>
    <?php include '../html/Footer.html' ?>
</body>

</html>