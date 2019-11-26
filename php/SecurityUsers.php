<?php
session_start();
if (!isset($_SESSION['eposta']) || empty($_SESSION['eposta'] || $_SESSION['eposta'] == "admin@ehu.es")) {
    echo "<script>alert('Ikasle eta irakasleak bakarrik sar daitezke hemen.'); window.location.href = '../php/Layout.php';</script>";
    exit();
}
?>