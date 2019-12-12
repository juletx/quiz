<?php session_start (); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<main class="container-fluid py-3 flex-fill">
		<h1>Quiz: galderen jokoa</h1>
		<br>
		<h2>10 jokalari onenak</h2>
		<div class="table-responsive-sm" id="taula">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>POSTUA</th>
						<th>NICKA</th>
						<th>ERANTZUNAK</th>
						<th>ZUZENAK</th>
						<th>OKERRAK</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>juletx</td>
						<td>10</td>
						<td>5</td>
						<td>5</td>
					</tr>
				<tbody>
			</table>
		</div>
	</main>
	<?php include '../html/Footer.html' ?>
</body>

</html>