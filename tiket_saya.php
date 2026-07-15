<?php
session_start();

// Validasi: Harus login
if (!isset($_SESSION['user_id'])) {
    header("location: auth/login.php");
    exit;
}

include("config/koneksi.php");
include("templates/header.php");

// 1. Ambil email user yang sedang login dari database
$user_id = $_SESSION['user_id'];
$query_user = mysqli_query($konek, "SELECT email FROM users WHERE id_user='$user_id'");
$data_user = mysqli_fetch_assoc($query_user);
$email_aktif = $data_user['email'];

// 2. Ambil data tiket milik user ini (Berdasarkan Email) beserta data event-nya
$query_tiket = "SELECT t.*, e.nama_event, e.tanggal_event, e.lokasi 
                FROM transaksi_tiket t 
                JOIN jadwal_event e ON t.id_event = e.id_event 
                WHERE t.email_pembeli = '$email_aktif' 
                ORDER BY t.id_transaksi DESC";
$hasil_tiket = mysqli_query($konek, $query_tiket);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket Saya - Irama Cipta</title>
</head>
<body>

<div class="e-tiket-container">
    <h2 class="page-title">E-Tiket Saya</h2>

    <?php
    if (mysqli_num_rows($hasil_tiket) > 0) {
        while ($tiket = mysqli_fetch_assoc($hasil_tiket)) {
            
            // ==========================================
            // LOGIKA STATUS PEMBAYARAN & TOMBOL
            // ==========================================
            $status = $tiket['status_pembayaran'];
            
            if ($status == 'Lunas') {
                $badge_color = "#2ecc71"; // Hijau
                $teks_status = "LUNAS - APPROVED";
                // Tombol aktif bisa diklik
                $tombol_aksi = "<a href='cetak_tiket.php?id=" . $tiket['id_transaksi'] . "' class='btn-cetak' style='text-decoration: none;'><i class='fas fa-print'></i> Cetak Tiket</a>";
            } 
            elseif ($status == 'Menunggu Validasi') {
                $badge_color = "#f39c12"; // Oranye
                $teks_status = "MENUNGGU APPROVAL ADMIN";
                // Tombol mati (disabled)
                $tombol_aksi = "<button class='btn-cetak' style='border-color: #555; color: #555; cursor: not-allowed;' disabled><i class='fas fa-hourglass-half'></i> Sedang Diproses</button>";
            } 
            elseif ($status == 'Ditolak') {
                $badge_color = "#e74c3c"; // Merah
                $teks_status = "PEMBAYARAN DITOLAK";
                // Arahkan kembali ke halaman pembayaran untuk upload ulang
                $tombol_aksi = "<a href='pembayaran.php?id=" . $tiket['id_transaksi'] . "' class='btn-cetak' style='text-decoration: none; border-color: #e74c3c; color: #e74c3c;'><i class='fas fa-upload'></i> Upload Ulang Bukti</a>";
            } 
            else {
                // Status Belum Dibayar
                $badge_color = "#888888"; // Abu-abu
                $teks_status = "BELUM DIBAYAR";
                $tombol_aksi = "<a href='pembayaran.php?id=" . $tiket['id_transaksi'] . "' class='btn-cetak' style='text-decoration: none;'><i class='fas fa-money-bill-wave'></i> Bayar Sekarang</a>";
            }
            ?>

            <div class="ticket-card">
                <div class="ticket-left">
                    <span class="badge-upcoming" style="background-color: <?php echo $badge_color; ?>;">
                        <?php echo $teks_status; ?>
                    </span>
                    
                    <h3 class="ticket-title"><?php echo htmlspecialchars($tiket['nama_event']); ?></h3>
                    <p class="ticket-meta"><?php echo htmlspecialchars($tiket['tanggal_event']); ?> | <?php echo htmlspecialchars($tiket['lokasi']); ?></p>
                    
                    <table class="ticket-details">
                        <tr>
                            <td class="label">Nama Pemesan</td>
                            <td class="value">: <?php echo htmlspecialchars($tiket['nama_pembeli']); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Kategori Tiket</td>
                            <td class="value highlight">: <?php echo htmlspecialchars($tiket['kategori_tiket']); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Jumlah</td>
                            <td class="value">: <?php echo $tiket['jumlah_tiket']; ?> Tiket</td>
                        </tr>
                    </table>
                </div>
                
                <div class="ticket-right">
                    <div class="ticket-code">
                        <?php echo implode(' ', str_split($tiket['kode_booking'])); ?>
                    </div>
                    
                    <a href="cetak_tiket.php?id=<?php echo $tiket['id_transaksi']; ?>" class="btn-cetak" target="_blank">
                        <i class="fas fa-print"></i> Cetak Tiket
                    </a>
                </div>
            </div>

            <?php
        } // Penutup While
    } else {
        // Tampilan jika user belum pernah membeli tiket
        echo "<div style='text-align: center; padding: 50px; background: #141414; border-radius: 8px; border: 1px dashed #333;'>
                <i class='fas fa-ticket-alt' style='font-size: 50px; color: #444; margin-bottom: 20px;'></i>
                <h3 style='color: #fff;'>Belum Ada Tiket</h3>
                <p style='color: #888; margin-bottom: 20px;'>Anda belum memiliki riwayat pemesanan tiket acara.</p>
                <a href='events.php' class='btn-pill' style='text-decoration: none;'>Cari Acara Sekarang</a>
              </div>";
    }
    ?>

</div>

</body>
</html>