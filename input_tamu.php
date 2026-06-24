<?php
include ("koneksi.php");

// Menangkap data baru termasuk kategori dropdown
$nama = $_GET['nama'];
$email = $_GET['email'];
$kategori = $_GET['kategori']; 
$pesan = $_GET['pesan'];

// Memasukkan data ke dalam tabel dengan tambahan kolom kategori
$input = "insert into buku_tamu (nama, email, kategori, pesan) values ('$nama', '$email', '$kategori', '$pesan')";

$hasil = mysqli_query($konek, $input);

if ($hasil) {
    header("location:tampil_tamu_tabel.php");
} else {
    echo 'Data tidak berhasil disimpan ke sistem.';
}
?>