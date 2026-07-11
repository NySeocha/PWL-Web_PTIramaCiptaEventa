<?php
include("config/koneksi.php");

// Menangkap data dari form URL (GET)
$nama = $_GET['nama'];
$email = $_GET['email'];
$kategori = $_GET['kategori']; 
$pesan = $_GET['pesan'];

// 1. Simpan ke Buku Tamu (Inbox Umum Admin)
$input_tamu = "INSERT INTO buku_tamu (nama, email, kategori, pesan) VALUES ('$nama', '$email', '$kategori', '$pesan')";
$hasil_tamu = mysqli_query($konek, $input_tamu);

// 2. LOGIKA PINTAR: Cabang Otomatisasi untuk Tabel Klien
if ($kategori == 'Ajukan Kerjasama') {
    $input_klien = "INSERT INTO klien (nama_klien, kontak, jenis_kerjasama) VALUES ('$nama', '$email', 'Prospek Kerjasama Baru')";
    
    // Mengeksekusi query tambahan ke tabel klien
    mysqli_query($konek, $input_klien);
}

// 3. Mengembalikan status ke form publik beserta notifikasi JavaScript
if ($hasil_tamu) {
    header("Location: form_tamu.php?status=success");
    exit();
} else {
    header("Location: form_tamu.php?status=error");
    exit();
}
?>