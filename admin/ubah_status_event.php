<?php
session_start();
include("../config/koneksi.php");

// Cek keamanan
if (!isset($_SESSION['status']) || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

// 1. Cek status event saat ini di database
$query_cek = mysqli_query($konek, "SELECT status_event FROM jadwal_event WHERE id_event='$id'");
$data = mysqli_fetch_array($query_cek);

// 2. Logika Toggle Pintar (Pembalikan Status)
if ($data['status_event'] == 'Upcoming') {
    $status_baru = 'Selesai';
} else {
    $status_baru = 'Upcoming';
}

// 3. Update database secara instan
$update = mysqli_query($konek, "UPDATE jadwal_event SET status_event='$status_baru' WHERE id_event='$id'");

if ($update) {
    // Kembalikan ke halaman sebelumnya tanpa pesan (seamless)
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'kelola_event.php';
    header("Location: $referer");
} else {
    echo "<script>alert('Gagal mengubah status event!'); window.location='kelola_event.php';</script>";
}
?>