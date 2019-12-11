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
			<h1>Kredituak</h1>

			<h4><b>Deiturak:</b> Julen Etxaniz eta Aitor Zubillaga</h4>
			<h4><b>Gradua:</b> Ingeniaritza Informatikoa</h4>
			<h4><b>Espezialitatea:</b> Software Ingeniaritza</h4>
			<h4><b>Ikasgaiak:</b> Web Sistemak eta <br> Pertsona eta Konputagailuen arteko Elkarrekintza</h4>
			<h4><b>Udalerria:</b> Azpeitia</h4>

			<figure class="credits-image">
				<img src="../images/JulenEtxaniz.jpg" alt="JulenEtxaniz">
				<figcaption>
					<h6>Julen Etxaniz</h6>
				</figcaption>
			</figure>

			<figure class="credits-image">
				<img src="../images/AitorZubillaga.png" alt="AitorZubillaga">
				<figcaption>
					<h6>Aitor Zubillaga</h6>
				</figcaption>
			</figure>
		</div>
		<h2>Bezeroaren eta zerbitzariaren datuak</h2>
		<div class="table-responsive-lg" id="taula">
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