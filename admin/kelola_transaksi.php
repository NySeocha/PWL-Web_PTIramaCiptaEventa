<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}
include("../config/koneksi.php");

// Query JOIN untuk mengambil data transaksi sekaligus nama event-nya
$query = "SELECT transaksi_tiket.*, jadwal_event.nama_event 
          FROM transaksi_tiket 
          LEFT JOIN jadwal_event ON transaksi_tiket.id_event = jadwal_event.id_event 
          ORDER BY transaksi_tiket.id_transaksi DESC";
$hasil = mysqli_query($konek, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Penjualan Tiket - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Irama Cipta</h3><p style="font-size: 12px; color: #888; margin-top: 5px;">Admin Panel</p>
        </div>
        <ul class="sidebar-menu">
            <li><a href="admin_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="tampil_tamu_tabel.php"><i class="fas fa-envelope"></i> Pesan Masuk</a></li>
            <li><a href="kelola_klien.php"><i class="fas fa-users"></i> Kelola Klien</a></li>
            <li><a href="kelola_event.php"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <li><a href="kelola_transaksi.php" class="active"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
            <li><a href="../auth/logout.php" style="color: #e74c3c; margin-top: 20px;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
       <div class="header-top">
            <h2><i class="fas fa-ticket-alt"></i> Data Penjualan Tiket</h2>
            <a href="export_tiket.php" class="btn-tambah" style="background: #2ecc71;">
                <i class="fas fa-file-excel"></i> Export ke Excel
            </a>
        </div>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Kode Booking</th>
                        <th>Nama Pembeli</th>
                        <th style="width: 25%;">Nama Acara</th>
                        <th>Kategori</th>
                        <th>Qty</th>
                        <th>Total Bayar</th>
                        <th>Waktu Beli</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(mysqli_num_rows($hasil) > 0) {
                        while ($data = mysqli_fetch_array($hasil)) {
                            // Menangani jika nama event sudah dihapus tapi datanya masih ada
                            $nama_acara = $data['nama_event'] ? $data['nama_event'] : "Acara Telah Dihapus";
                            
                            echo "<tr>";
                            echo "<td><strong style='color: #ff3366;'>" . $data['kode_booking'] . "</strong></td>";
                            echo "<td><strong>" . htmlspecialchars($data['nama_pembeli']) . "</strong><br><span style='font-size: 11px; color: #888;'>" . htmlspecialchars($data['email_pembeli']) . "</span></td>";
                            echo "<td>" . htmlspecialchars($nama_acara) . "</td>";
                            echo "<td><span style='background: #e2e8f0; color: #1d419d; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold;'>" . $data['kategori_tiket'] . "</span></td>";
                            echo "<td style='text-align: center; font-weight: bold;'>" . $data['jumlah_tiket'] . "</td>";
                            // Format Rupiah
                            echo "<td style='color: #2ecc71; font-weight: bold;'>Rp " . number_format($data['total_bayar'], 0, ',', '.') . "</td>";
                            echo "<td style='font-size: 12px; color: #666;'>" . $data['tanggal_transaksi'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align:center; padding: 30px; color: #888;'>Belum ada transaksi pembelian tiket yang masuk.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>