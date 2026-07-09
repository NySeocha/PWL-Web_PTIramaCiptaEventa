<?php
session_start();
include("../config/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_tamu'];
    $jawaban = $_POST['jawaban'];
    
    // Menyimpan jawaban admin ke dalam database
    $update = "UPDATE buku_tamu SET jawaban = '$jawaban' WHERE id_tamu = '$id'";
    $hasil = mysqli_query($konek, $update);
    
    if ($hasil) {
        // Jika sukses, kembali ke tabel admin dengan pesan sukses
        echo "<script>alert('Balasan berhasil disimpan!'); window.location='tampil_tamu_tabel.php';</script>";
    } else {
        echo "Gagal menyimpan balasan.";
    }
}
?>