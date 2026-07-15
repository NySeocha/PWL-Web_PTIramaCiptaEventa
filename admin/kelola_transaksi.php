<?php
session_start();
// Proteksi Keamanan Baru
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses ditolak! Anda bukan admin.'); window.location='../auth/login.php';</script>";
    exit;
}
include("../config/koneksi.php");

$query = "SELECT transaksi_tiket.*, jadwal_event.nama_event 
          FROM transaksi_tiket 
          LEFT JOIN jadwal_event ON transaksi_tiket.id_event = jadwal_event.id_event 
          ORDER BY transaksi_tiket.id_transaksi DESC";
$hasil = mysqli_query($konek, $query);

// ==========================================
// PANGGIL SIDEBAR
// ==========================================
include("sidebar.php"); 
?>

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
                    <th>Status Pembayaran</th>
                    <th>Bukti & Validasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($hasil) > 0) {
                    while ($data = mysqli_fetch_array($hasil)) {
                        $nama_acara = $data['nama_event'] ? $data['nama_event'] : "Acara Telah Dihapus";
                        
                        echo "<tr>";
                        echo "<td><strong style='color: #ff3366;'>" . $data['kode_booking'] . "</strong></td>";
                        echo "<td><strong>" . htmlspecialchars($data['nama_pembeli']) . "</strong><br><span style='font-size: 11px; color: #888;'>" . htmlspecialchars($data['email_pembeli']) . "</span></td>";
                        echo "<td>" . htmlspecialchars($nama_acara) . "</td>";
                        echo "<td><span style='background: #e2e8f0; color: #1d419d; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold;'>" . $data['kategori_tiket'] . "</span></td>";
                        echo "<td style='text-align: center; font-weight: bold;'>" . $data['jumlah_tiket'] . "</td>";
                        echo "<td style='color: #2ecc71; font-weight: bold;'>Rp " . number_format($data['total_bayar'], 0, ',', '.') . "</td>";
                        
                        // -- LOGIKA WARNA STATUS --
                        if ($data['status_pembayaran'] == 'Menunggu Validasi') {
                            $warna = "#f39c12"; 
                        } elseif ($data['status_pembayaran'] == 'Lunas') {
                            $warna = "#2ecc71"; 
                        } else {
                            $warna = "#e74c3c"; 
                        }
                        
                        echo "<td><span style='background: $warna; color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold;'>" . htmlspecialchars($data['status_pembayaran']) . "</span></td>";
                        
                        // CETAK TOMBOL AKSI (BUG FIX: Disatukan dalam satu <td>)
                        echo "<td style='display: flex; gap: 5px; flex-wrap: wrap;'>
                                <a href='../assets/uploads/" . $data['bukti_bayar'] . "' target='_blank' class='btn-sm' style='background: #3498db; color: white; border: none; padding: 5px 10px; text-decoration: none;' title='Lihat Struk'><i class='fas fa-image'></i></a>
                                
                                <a href='proses_validasi.php?id=" . $data['id_transaksi'] . "&status=Lunas' class='btn-sm' style='background: #2ecc71; color: white; border: none; padding: 5px 10px; text-decoration: none;' onclick=\"return confirm('Terima pembayaran?')\">Terima</a>
                                
                                <a href='proses_validasi.php?id=" . $data['id_transaksi'] . "&status=Ditolak' class='btn-sm' style='background: #e74c3c; color: white; border: none; padding: 5px 10px; text-decoration: none;' onclick=\"return confirm('Tolak pembayaran?')\">Tolak</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align:center; padding: 30px; color: #888;'>Belum ada transaksi pembelian tiket yang masuk.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>