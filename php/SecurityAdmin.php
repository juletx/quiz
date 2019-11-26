<?php
session_start();
if (!isset($_SESSION['eposta']) || empty($_SESSION['eposta']) || $_SESSION["eposta"] != "admin@ehu.es") {
	echo "<script>alert('Administratzailea bakarrik sar daiteke hemen.'); window.location.href = '../php/Layout.php';</script>";
	exit();
}
?> 