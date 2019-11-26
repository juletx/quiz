<?php
session_start();
if (!isset($_SESSION['eposta']) || empty($_SESSION['eposta'])) {
    echo "<script>alert('Erabiltzaile kautotuak bakarrik sar daitezke hemen.'); window.location.href = '../php/Layout.php';</script>";
    exit();
}
?>