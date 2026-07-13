<?php 
include("templates/header.php"); 
include("config/koneksi.php");

// 1. Cek keamanan: Apakah ada ID di URL? Jika tidak, tendang kembali ke index
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Halaman tidak valid atau ID tidak ditemukan!'); window.location='index.php';</script>";
    exit; // Menghentikan eksekusi layar error di bawahnya
}

$id = $_GET['id'];

// 2. Eksekusi pencarian data
$query = mysqli_query($konek, "SELECT transaksi_tiket.*, jadwal_event.nama_event FROM transaksi_tiket 
                               LEFT JOIN jadwal_event ON transaksi_tiket.id_event = jadwal_event.id_event 
                               WHERE transaksi_tiket.id_transaksi='$id'");
$data = mysqli_fetch_assoc($query);

// 3. Cek keamanan: Apakah datanya benar-benar ada di database?
if (!$data) {
    echo "<script>alert('Data transaksi tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// Fallback jika nama event null
$event_name = $data['nama_event'] ? $data['nama_event'] : "Hiphop Fest: Changbin & Friends";
?>

<section class="event-detail-container" style="max-width: 650px; margin: 120px auto 80px;">
    
    <div class="event-detail-layout" style="display: block; padding: 40px; background: #141414; border-top: 5px solid #ff3366;">
        
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="font-size: 50px; color: #2ecc71; margin-bottom: 10px;"><i class="fas fa-check-circle"></i></div>
            <h2 style="color: #fff; text-transform: uppercase; letter-spacing: 1px;">Payment Successful</h2>
            <p style="color: #666; font-size: 13px; margin-top: 5px;">Terima kasih, e-ticket Anda telah terkonfirmasi secara resmi.</p>
        </div>

        <div style="background: #0a0a0a; padding: 25px; border-radius: 6px; border: 1px solid #222; margin-bottom: 30px;">
            <h3 style="color: #fff; border-bottom: 1px solid #222; padding-bottom: 10px; margin-bottom: 15px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Booking Details</h3>
            
            <table style="width: 100%; color: #aaa; font-size: 14px; line-height: 2;">
                <tr>
                    <td style="width: 40%;">Kode Booking</td>
                    <td style="color: #ff3366; font-weight: 800; font-size: 16px;">: <?php echo $data['kode_booking']; ?></td>
                </tr>
                <tr>
                    <td>Nama Acara</td>
                    <td style="color: #fff;">: <?php echo htmlspecialchars($event_name); ?></td>
                </tr>
                <tr>
                    <td>Nama Pembeli</td>
                    <td>: <?php echo htmlspecialchars($data['nama_pembeli']); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: <?php echo htmlspecialchars($data['email_pembeli']); ?></td>
                </tr>
                <tr>
                    <td>Kategori Tiket</td>
                    <td>: <?php echo $data['kategori_tiket']; ?></td>
                </tr>
                <tr>
                    <td>Jumlah Tiket</td>
                    <td>: <?php echo $data['jumlah_tiket']; ?> Tiket</td>
                </tr>
                <tr style="border-top: 1px dashed #333;">
                    <td style="color: #fff; font-weight: bold; padding-top: 10px;">Total Bayar</td>
                    <td style="color: #2ecc71; font-weight: 800; font-size: 16px; padding-top: 10px;">: Rp <?php echo number_format($data['total_bayar'], 0, ',', '.'); ?></td>
                </tr>
            </table>
        </div>

       <div style="display: flex; gap: 15px;" class="action-buttons-print"> <button onclick="window.print()" class="btn-pill print-hide" style="flex: 1; text-align: center; border: none; cursor: pointer; background: #333; color: white;">
                <i class="fas fa-print"></i> Cetak / Simpan PDF
            </button>
            <a href="index.php" class="btn-pill print-hide" style="flex: 1; text-align: center; text-decoration: none; background: #ff3366;">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

</body>
</html>