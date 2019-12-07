<?php session_start (); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<script src="../js/ClientGeolocationAjax.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div>
			<h2>Kredituak</h2>

			<h3>Deiturak: Julen Etxaniz eta Aitor Zubillaga</h3>

			<h3>Gradua: Ingeniaritza Informatikoa</h3>

			<h3>Espezialitatea: Software Ingeniaritza</h3>

			<h3>Udalerria: Azpeitia</h3>
			<figure class="credits-image">
				<img src="../images/JulenEtxaniz.jpg" alt="JulenEtxaniz">
				<figcaption>Julen Etxaniz</figcaption>
			</figure>

			<figure class="credits-image">
				<img src="../images/AitorZubillaga.png" alt="AitorZubillaga">
				<figcaption>Aitor Zubillaga</figcaption>
			</figure>
		</div>
		<div class="table-responsive-lg" id="taula">
		<h2>Bezeroaren eta zerbitzariaren datuak</h2>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th style="visibility:hidden;"></th>
						<th>IP</th>
						<th>HOSTNAME</th>
						<th>CONTINENT</th>
						<th>COUNTRY</th>
						<th>REGION</th>
						<th>CITY</th>
						<th>ZIP</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><b>CLIENT</b></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php include '../php/ClientGeolocation.php' ?>
				<tbody>
			</table>
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>