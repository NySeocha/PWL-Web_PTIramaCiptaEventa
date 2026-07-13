<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}
include("../config/koneksi.php");

// Menangkap ID klien dari URL
$id = $_GET['id'];
$query = mysqli_query($konek, "SELECT * FROM klien WHERE id_klien='$id'");
$data = mysqli_fetch_array($query);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data klien tidak ditemukan!'); window.location='kelola_klien.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Klien - Admin Panel</title>
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
            <li><a href="kelola_klien.php" class="active"><i class="fas fa-users"></i> Kelola Klien</a></li>
            <li><a href="kelola_event.php"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <!-- <li><a href="kelola_galeri.php"><i class="fas fa-images"></i> Kelola Galeri Acara</a></li> -->
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
        </ul>
    </div>

    <div class="main-content">
        <a href="kelola_klien.php" class="btn-kembali"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Klien</a>
        
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-icon"><i class="fas fa-building"></i></div>
                <div class="profile-title">
                    <h2><?php echo htmlspecialchars($data['nama_klien']); ?></h2>
                    <span class="badge"><?php echo htmlspecialchars($data['jenis_kerjasama']); ?></span>
                </div>
            </div>
            
            <div class="info-group">
                <label>ID Registrasi Sistem</label>
                <p>#<?php echo $data['id_klien']; ?></p>
            </div>
            
            <div class="info-group">
                <label>Kontak Utama (Email / Telepon)</label>
                <p><i class="fas fa-address-book" style="color: #888; margin-right: 5px;"></i> <?php echo htmlspecialchars($data['kontak']); ?></p>
            </div>
            
            <div class="action-footer">
                <a href="edit_klien.php?id=<?php echo $data['id_klien']; ?>" class="btn-action btn-edit"><i class="fas fa-edit"></i> Edit Data</a>
                <a href="hapus_klien.php?id=<?php echo $data['id_klien']; ?>" class="btn-action btn-hapus" onclick="return confirm('Yakin ingin menghapus klien ini?')"><i class="fas fa-trash"></i> Hapus Klien</a>
            </div>
        </div>
    </div>

</body>
</html>