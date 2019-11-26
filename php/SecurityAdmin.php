<?php
//sesio hasiera
session_start();
// ERABILTZAILEA KAUTOTURIK DAGOELA EGIAZTATU
if ($_SESSION["eposta"] != "admin@ehu.es") {
// existitzen ez bada, berriro kautotzera bidaltzen dut
echo "<script>alert('Administratzailea bakarrik sar daiteke hemen.'); window.location.href = '../php/Layout.php'</script>".PHP_EOL;
//gainera, script-atik irtetzen gara
exit();
}
?> 