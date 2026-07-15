<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: auth/login.php");
    exit;
}

include("templates/header.php");
include("config/koneksi.php");

// Menangkap ID transaksi dari halaman sebelumnya
$id_transaksi = isset($_GET['id']) ? $_GET['id'] : 0;

// Logika ketika foto struk diunggah
if (isset($_POST['submit_bayar'])) {
    $id_trx = $_POST['id_transaksi'];
    $kode   = $_POST['kode_booking'];

    $nama_file = $_FILES['foto_bukti']['name'];
    $tmp_name  = $_FILES['foto_bukti']['tmp_name'];
    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
    $nama_file_baru = $kode . "_struk." . $ext; 
    
    $path = "assets/uploads/" . $nama_file_baru;

    if (move_uploaded_file($tmp_name, $path)) {
        // Update database: Masukkan nama file dan ubah status menjadi Menunggu Validasi
        $query_update = "UPDATE transaksi_tiket SET bukti_bayar='$nama_file_baru', status_pembayaran='Menunggu Validasi' WHERE id_transaksi='$id_trx'";
        mysqli_query($konek, $query_update);
        
        echo "<script>alert('Pembayaran berhasil diunggah! Menunggu validasi admin.'); window.location='nota_pembelian.php?id=" . $id_trx . "';</script>";
    } else {
        echo "<script>alert('Gagal mengunggah foto!');</script>";
    }
}

// Menarik detail pesanan dari database
$query = mysqli_query($konek, "SELECT t.*, e.nama_event FROM transaksi_tiket t LEFT JOIN jadwal_event e ON t.id_event = e.id_event WHERE t.id_transaksi='$id_transaksi'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Pesanan tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Tiket - Irama Cipta</title>
</head>
<body>

<section class="hero-events" style="height: 150px; background: #0a0a0a; border-bottom: 1px solid #222;">
    <div class="hero-content" style="margin-top: 50px;">
        <h1 style="font-size: 1.8rem; text-transform: uppercase;">Selesaikan Pembayaran</h1>
    </div>
</section>

<section class="event-detail-container" style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; background: #141414; padding: 40px; border-radius: 8px; border: 1px solid #222; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
        
        <div style="border-right: 1px dashed #333; padding-right: 30px;">
            <h3 style="color: #ff3366; margin-bottom: 20px; font-size: 16px;"><i class="fas fa-file-invoice"></i> RINCIAN PESANAN</h3>
            
            <div style="margin-bottom: 15px;">
                <p style="font-size: 11px; color: #888; margin-bottom: 3px;">KODE BOOKING</p>
                <p style="font-size: 18px; font-weight: bold; color: #fff; font-family: monospace; letter-spacing: 2px;"><?php echo $data['kode_booking']; ?></p>
            </div>
            
            <div style="margin-bottom: 15px;">
                <p style="font-size: 11px; color: #888; margin-bottom: 3px;">NAMA ACARA</p>
                <p style="font-size: 14px; color: #fff;"><?php echo $data['nama_event']; ?></p>
            </div>
            
            <div style="margin-bottom: 15px;">
                <p style="font-size: 11px; color: #888; margin-bottom: 3px;">INFORMASI PEMBELI</p>
                <p style="font-size: 14px; color: #fff; margin-bottom: 2px;"><?php echo $data['nama_pembeli']; ?></p>
                <p style="font-size: 13px; color: #aaa;"><?php echo $data['email_pembeli']; ?></p>
            </div>
            
            <div style="margin-bottom: 15px;">
                <p style="font-size: 11px; color: #888; margin-bottom: 3px;">KATEGORI & JUMLAH</p>
                <p style="font-size: 14px; color: #fff;"><?php echo $data['kategori_tiket']; ?> <span style="color: #ff3366;">(x<?php echo $data['jumlah_tiket']; ?>)</span></p>
            </div>
            
            <div style="background: #0a0a0a; padding: 15px; border-radius: 4px; margin-top: 25px; text-align: center; border: 1px solid #333;">
                <p style="font-size: 11px; color: #888; margin-bottom: 5px;">TOTAL YANG HARUS DIBAYAR</p>
                <h2 style="color: #2ecc71;">Rp <?php echo number_format($data['total_bayar'], 0, ',', '.'); ?></h2>
            </div>
        </div>

        <div style="padding-left: 10px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
            
            <h3 style="color: #fff; margin-bottom: 10px; font-size: 15px;">Scan QRIS Untuk Membayar</h3>
            <p style="font-size: 12px; color: #aaa; margin-bottom: 20px;">Gunakan aplikasi M-Banking atau E-Wallet kesayangan Anda.</p>
            
            <div style="background: white; padding: 15px; border-radius: 8px; margin-bottom: 25px;">
                <i class="fas fa-qrcode" style="font-size: 120px; color: #111;"></i>
            </div>
            
            <form method="POST" action="" enctype="multipart/form-data" style="width: 100%; text-align: left;">
                <input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
                <input type="hidden" name="kode_booking" value="<?php echo $data['kode_booking']; ?>">
                
                <label style="color: #ff3366; font-size: 12px; font-weight: bold; display: block; margin-bottom: 8px;">UPLOAD BUKTI TRANSFER</label>
                <input type="file" name="foto_bukti" accept="image/jpeg, image/png, image/jpg" required style="width: 100%; padding: 10px; background: #111; border: 1px dashed #555; color: white; border-radius: 4px; margin-bottom: 5px;">
                <p style="font-size: 11px; color: #888; margin-bottom: 20px;">* Format: JPG, JPEG, PNG. Max 2MB.</p>
                
                <button type="submit" name="submit_bayar" class="btn-pill" style="width: 100%; background: #2ecc71; color: white; padding: 12px; border: none; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer;">
                    <i class="fas fa-upload"></i> Kirim Bukti Pembayaran
                </button>
            </form>
            
        </div>
        
    </div>
</section>

</body>
</html>