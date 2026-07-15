<?php
session_start();
// Proteksi Keamanan Baru
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    header("location: ../auth/login.php");
    exit();
}

include("../config/koneksi.php");

// Mengamankan data yang masuk
$id = mysqli_real_escape_string($konek, $_GET['id']);
$nama = mysqli_real_escape_string($konek, $_GET['nama']);
$email = mysqli_real_escape_string($konek, $_GET['email']);
$kategori = mysqli_real_escape_string($konek, $_GET['kategori']);
$pesan = mysqli_real_escape_string($konek, $_GET['pesan']);

$update = "update buku_tamu set nama = '$nama', email = '$email', kategori = '$kategori', pesan = '$pesan' where id_tamu = '$id'";
$hasil = mysqli_query($konek, $update);

if ($hasil) {
    header("location:tampil_tamu_tabel.php");
} else {
    echo "Update data gagal disimpan.";
}
?>