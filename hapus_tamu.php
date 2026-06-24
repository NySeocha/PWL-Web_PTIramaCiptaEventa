<?php
include ("koneksi.php");

// Menangkap ID dari URL
$id = $_GET['id'];

// Perintah SQL untuk menghapus data berdasarkan ID
$hapus = "delete from buku_tamu where id_tamu = '$id'";
$hasil = mysqli_query($konek, $hapus);

// Mengecek apakah hapus berhasil
if ($hasil) {
    // Jika berhasil, kembalikan ke halaman tabel
    header("location:tampil_tamu_tabel.php");
} else {
    echo "Data gagal di hapus"; // Diperbaiki agar tidak memunculkan echo jika sukses [cite: 523-526]
}
?>