<?php
session_start();
if (empty($_SESSION['kodea']) || empty($_SESSION['eposta2'])) {
    echo "<script>alert('Ez duzu pasahitza aldatzeko eskaerarik egin.'); window.location.href = '../php/Layout.php';</script>";
    exit();
}
?>