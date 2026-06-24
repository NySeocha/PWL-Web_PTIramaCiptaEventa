<?php
// Menghubungkan ke database db_irama_cipta (sesuai database pertemuan 10)
$konek = mysqli_connect("localhost", "root", "", "db_irama_cipta");

// Cek koneksi (Opsional, untuk memastikan berhasil)
if (!$konek) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>