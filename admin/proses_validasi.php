<?php
// Hubungkan dengan database
include("../config/koneksi.php");

// Tangkap ID transaksi dan status baru dari URL
$id_transaksi = $_GET['id'];
$status_baru  = $_GET['status'];

// Update status di database
$query_update = "UPDATE transaksi_tiket SET status_pembayaran = '$status_baru' WHERE id_transaksi = '$id_transaksi'";
$update = mysqli_query($konek, $query_update);

if ($update) {
    // Jika berhasil, kembalikan ke halaman tabel transaksi
    echo "<script>
            alert('Status pembayaran berhasil diperbarui menjadi LUNAS!');
            window.location='kelola_transaksi.php';
          </script>";
} else {
    echo "<script>alert('Gagal memperbarui status!'); window.location='kelola_transaksi.php';</script>";
}
?>