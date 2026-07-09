<?php
include("../config/koneksi.php");

$id = $_GET['id'];
$hapus = "delete from buku_tamu where id_tamu = '$id'";
$hasil = mysqli_query($konek, $hapus);

if ($hasil) {
    header("location:tampil_tamu_tabel.php");
} else {
    echo "Data gagal dihapus.";
}
?>