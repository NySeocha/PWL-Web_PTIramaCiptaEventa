<?php
session_start();
include("../config/koneksi.php");

// Cek keamanan
if (!isset($_SESSION['status']) || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}

// 1. Mengatur header file agar terbaca sebagai Excel oleh browser
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan_Tiket.xls");

// 2. Mengambil data dari database
$query = "SELECT transaksi_tiket.*, jadwal_event.nama_event 
          FROM transaksi_tiket 
          LEFT JOIN jadwal_event ON transaksi_tiket.id_event = jadwal_event.id_event 
          ORDER BY transaksi_tiket.id_transaksi DESC";
$hasil = mysqli_query($konek, $query);
?>

<table border="1">
    <thead>
        <tr style="background-color: #1d419d; color: white;">
            <th>Kode Booking</th>
            <th>Nama Pembeli</th>
            <th>Email</th>
            <th>Nama Acara</th>
            <th>Kategori</th>
            <th>Jumlah Tiket</th>
            <th>Total Bayar (Rp)</th>
            <th>Waktu Transaksi</th>
            <th>Status Pembayaran</th>
            <th>Bukti Transfer</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data = mysqli_fetch_array($hasil)) {
            echo "<tr>";
            echo "<td>" . $data['kode_booking'] . "</td>";
            echo "<td>" . $data['nama_pembeli'] . "</td>";
            echo "<td>" . $data['email_pembeli'] . "</td>";
            echo "<td>" . $data['nama_event'] . "</td>";
            echo "<td>" . $data['kategori_tiket'] . "</td>";
            echo "<td>" . $data['jumlah_tiket'] . "</td>";
            echo "<td>" . $data['total_bayar'] . "</td>";
            echo "<td>" . $data['tanggal_transaksi'] . "</td>";
            
            // Tambahkan 2 baris ini untuk Excel
            echo "<td>" . $data['status_pembayaran'] . "</td>";
            
            // Untuk bukti, kita cetak nama filenya. Jika kosong, tulis "Belum Upload"
            if (!empty($data['bukti_bayar'])) {
                echo "<td>" . $data['bukti_bayar'] . "</td>";
            } else {
                echo "<td>Belum Upload</td>";
            }
            
            echo "</tr>";
        }
        ?>
    </tbody>
</table>