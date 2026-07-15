<?php
session_start();
// Proteksi Keamanan Baru
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    header("location: ../auth/login.php");
    exit();
}

include("../config/koneksi.php");

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = mysqli_real_escape_string($konek, $_GET['id']);
    $status = mysqli_real_escape_string($konek, $_GET['status']); // 'Lunas' atau 'Ditolak'
    
    mysqli_query($konek, "UPDATE transaksi_tiket SET status_pembayaran='$status' WHERE id_transaksi='$id'");
    
    echo "<script>alert('Status transaksi berhasil diubah!'); window.location='kelola_transaksi.php';</script>";
}
?>