<?php
include ("koneksi.php");

$id = $_GET['id'];
$nama = $_GET['nama'];
$email = $_GET['email'];
$kategori = $_GET['kategori']; // Menangkap data perubahan kategori
$pesan = $_GET['pesan'];

// Memasukkan kolom kategori ke dalam perintah set update
$update = "update buku_tamu set nama = '$nama', email = '$email', kategori = '$kategori', pesan = '$pesan' where id_tamu = '$id'";
$hasil = mysqli_query($konek, $update);

if ($hasil) {
    header("location:tampil_tamu_tabel.php");
} else {
    echo "Update data gagal disimpan.";
}
?>