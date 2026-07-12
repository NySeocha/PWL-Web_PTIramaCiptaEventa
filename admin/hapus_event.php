<?php
session_start();
include("../config/koneksi.php");

if (!isset($_SESSION['status']) || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];
$hapus = mysqli_query($konek, "DELETE FROM jadwal_event WHERE id_event = '$id'");

if ($hapus) {
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'kelola_event.php';
    header("Location: $referer");
} else {
    echo "<script>alert('Gagal menghapus data.'); window.location='kelola_event.php';</script>";
}
?>