<?php
include("config/koneksi.php");

$id_event = $_POST['id_event'];
$nama = $_POST['nama_pembeli'];
$email = $_POST['email_pembeli'];
$kategori = $_POST['kategori_tiket'];
$jumlah = $_POST['jumlah_tiket'];
$total = $_POST['total_bayar'];

// Membuat Kode Booking Unik Secara Otomatis
$kode_booking = "IMC-" . rand(100000, 999999);

$query = "INSERT INTO transaksi_tiket (id_event, nama_pembeli, email_pembeli, kategori_tiket, jumlah_tiket, total_bayar, kode_booking) 
          VALUES ('$id_event', '$nama', '$email', '$kategori', '$jumlah', '$total', '$kode_booking')";

$hasil = mysqli_query($konek, $query);

if ($hasil) {
    // Mendapatkan ID transaksi yang baru saja disimpan untuk ditampilkan di nota
    $id_terakhir = mysqli_insert_id($konek);
    
    // Alihkan layar ke halaman nota sukses dengan membawa ID transaksi
    header("Location: nota_pembelian.php?id=$id_terakhir");
    exit();
} else {
    echo "<script>alert('Transaksi Gagal! Terjadi kesalahan sistem.'); window.location='events.php';</script>";
}
?>