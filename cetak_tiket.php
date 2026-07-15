<?php
session_start();

// Validasi: Hanya user yang sudah login yang bisa mengakses halaman ini
if (!isset($_SESSION['user_id'])) {
    header("location: auth/login.php");
    exit;
}

include("config/koneksi.php");

// Menangkap ID Transaksi
$id_transaksi = isset($_GET['id']) ? $_GET['id'] : 0;
$user_id = $_SESSION['user_id'];

// Query mengambil data tiket beserta data event
$query = "SELECT t.*, e.nama_event, e.tanggal_event, e.lokasi 
          FROM transaksi_tiket t 
          JOIN jadwal_event e ON t.id_event = e.id_event 
          WHERE t.id_transaksi = '$id_transaksi'";
$hasil = mysqli_query($konek, $query);
$tiket = mysqli_fetch_assoc($hasil);

// Validasi Keamanan
if (!$tiket) {
    echo "<script>alert('Data tiket tidak ditemukan!'); window.location='tiket_saya.php';</script>";
    exit;
}
if ($tiket['status_pembayaran'] != 'Lunas') {
    echo "<script>alert('Tiket belum lunas atau masih divalidasi!'); window.location='tiket_saya.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Tiket: <?php echo $tiket['kode_booking']; ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body class="print-body">

    <div class="ticket-wrapper">
        
        <div class="ticket-main">
            <div class="brand-header">
                <div>
                    <img src="assets/images/logoo.png" alt="Irama Cipta">
                </div>
                <div style="text-align: right;">
                    <span style="background: #2ecc71; color: white; padding: 5px 12px; border-radius: 4px; font-size: 11px; font-weight: bold; letter-spacing: 1px;">PAID / LUNAS</span>
                </div>
            </div>

            <div class="event-title"><?php echo htmlspecialchars($tiket['nama_event']); ?></div>
            <div class="event-meta">
                <i class="far fa-calendar-alt"></i> <?php echo htmlspecialchars($tiket['tanggal_event']); ?> &nbsp; | &nbsp; 
                <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($tiket['lokasi']); ?>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <label>Nama Pemegang Tiket</label>
                    <p><?php echo htmlspecialchars($tiket['nama_pembeli']); ?></p>
                </div>
                <div class="info-item">
                    <label>Email Terdaftar</label>
                    <p><?php echo htmlspecialchars($tiket['email_pembeli']); ?></p>
                </div>
                <div class="info-item">
                    <label>Kategori Tiket</label>
                    <p style="color: #ff3366;"><?php echo htmlspecialchars($tiket['kategori_tiket']); ?></p>
                </div>
                <div class="info-item">
                    <label>Jumlah Tiket</label>
                    <p><?php echo $tiket['jumlah_tiket']; ?> Orang (Pax)</p>
                </div>
            </div>

            <div style="margin-top: 30px; font-size: 11px; color: #888; border-top: 1px solid #eee; padding-top: 15px;">
                <strong>SYARAT & KETENTUAN:</strong><br>
                Harap membawa E-Tiket ini (dicetak atau ditunjukkan dari HP) beserta Kartu Identitas (KTP/SIM/Paspor) asli yang sesuai dengan nama pemesan saat penukaran gelang di lokasi acara.
            </div>
        </div>

        <div class="ticket-side">
            <p style="font-size: 11px; font-weight: 700; color: #888; margin-top: 0; margin-bottom: 20px; letter-spacing: 1px;">SCAN AT GATE</p>
            
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo $tiket['kode_booking']; ?>" alt="QR Code" class="qr-code">
            
            <p style="font-size: 10px; color: #888; margin-bottom: 5px; margin-top: 10px;">KODE BOOKING</p>
            <div class="booking-code"><?php echo $tiket['kode_booking']; ?></div>
        </div>
        
    </div>

    </div>

    <div class="action-buttons">
        
        <button onclick="window.print()" class="btn btn-print">
            <i class="fas fa-print"></i> Cetak ke PDF / Printer
        </button>
    </div>

</body>
</html>