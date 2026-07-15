<?php
session_start();
include("../config/koneksi.php");

// Proteksi Keamanan Baru
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    header("location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

// Cek status event saat ini di database
$query_cek = mysqli_query($konek, "SELECT status_event FROM jadwal_event WHERE id_event='$id'");
$data = mysqli_fetch_array($query_cek);

// Logika Toggle Pintar (Pembalikan Status)
if ($data['status_event'] == 'Upcoming') {
    $status_baru = 'Selesai';
} else {
    $status_baru = 'Upcoming';
}

// Update database secara instan
$update = mysqli_query($konek, "UPDATE jadwal_event SET status_event='$status_baru' WHERE id_event='$id'");

if ($update) {
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'kelola_event.php';
    header("Location: $referer");
} else {
    echo "<script>alert('Gagal mengubah status event!'); window.location='kelola_event.php';</script>";
}
?>