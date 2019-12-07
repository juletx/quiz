<?php include '../php/SecurityUsers.php' ?>
<!--DOCTYPE html>
<html>

<head>
	<?php //include '../html/Head.html'?>
</head>

<body>
	<?php //include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div id="taula">
			<h2> XML galderak ikusi</h2> 
			<br-->
			<?php
			$questions = simplexml_load_file('../xml/Questions.xml');
			
			$irteera = "<table class='table table-bordered table-hover'> <thead> <tr> <th> EPOSTA </th> 
			<th> GALDERA </th> <th> ERANTZUNA </th> </tr> </thead> <tbody>";

            foreach($questions->xpath('//assessmentItem') as $galdera) {
                $irteera .= "<tr>";
                $irteera .= "<td>";
                $irteera .= $galdera['author'];                
                $irteera .= "</td>";
                $irteera .= "<td>";
                $irteera .= $galdera->itemBody->p;               
                $irteera .= "</td>";
                $irteera .= "<td>";
                $irteera .= $galdera->correctResponse->value;
                $irteera .= "</td>";
                $irteera .= "</tr>";
			}
			
			$irteera .= "</tbody></table>";
            echo($irteera);
            ?>
		<!--/div>
	</section>
	<?php //include '../html/Footer.html' ?>
</body>

</html-->