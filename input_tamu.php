<?php
include("config/koneksi.php");

$nama = $_GET['nama'];
$email = $_GET['email'];
$kategori = $_GET['kategori']; 
$pesan = $_GET['pesan'];

$input = "insert into buku_tamu (nama, email, kategori, pesan) values ('$nama', '$email', '$kategori', '$pesan')";
$hasil = mysqli_query($konek, $input);

if ($hasil) {
    // Redirect kembali ke form dengan membawa parameter sukses
    header("Location: form_tamu.php?status=success");
    exit(); // Selalu gunakan exit setelah header location
} else {
    // Redirect kembali ke form dengan membawa parameter error
    header("Location: form_tamu.php?status=error");
    exit();
}
?>