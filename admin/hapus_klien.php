<?php
session_start();
include("../config/koneksi.php");

$id = $_GET['id'];

// Mengeksekusi query hapus berdasarkan ID yang diklik
$hapus = "DELETE FROM klien WHERE id_klien = '$id'";
$hasil = mysqli_query($konek, $hapus);

if ($hasil) {
    header("location:kelola_klien.php");
} else {
    echo "<script>alert('Gagal menghapus data.'); window.location='kelola_klien.php';</script>";
}
?>