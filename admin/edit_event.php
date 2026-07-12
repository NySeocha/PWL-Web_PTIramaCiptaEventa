<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}
include("../config/koneksi.php");

// 1. Mengambil data lama berdasarkan ID
$id = $_GET['id'];
$query_ambil = mysqli_query($konek, "SELECT * FROM jadwal_event WHERE id_event='$id'");
$data = mysqli_fetch_array($query_ambil);

// 2. Memproses form saat tombol Update ditekan
if (isset($_POST['update_event'])) {
    $nama = $_POST['nama_event'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal_event'];
    $lokasi = $_POST['lokasi'];
    $status = $_POST['status_event'];

    $query_update = "UPDATE jadwal_event SET nama_event='$nama', kategori='$kategori', tanggal_event='$tanggal', lokasi='$lokasi', status_event='$status' WHERE id_event='$id'";
    
    if (mysqli_query($konek, $query_update)) {
        echo "<script>alert('Jadwal event berhasil diperbarui!'); window.location='kelola_event.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui event!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Event - Admin Panel</title>
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
            <li><a href="kelola_event.php" class="active"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
        </ul>
    </div>

    <div class="main-content">
        <a href="kelola_event.php" class="btn-kembali"><i class="fas fa-arrow-left"></i> Batal Edit & Kembali</a>
        
        <div class="form-container">
            <h2 style="margin-bottom: 25px;"><i class="fas fa-edit" style="color: #2ecc71;"></i> Edit Data Event</h2>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Konser / Layanan</label>
                    <input type="text" name="nama_event" required value="<?php echo htmlspecialchars($data['nama_event']); ?>">
                </div>
                
                <div class="form-group">
                    <label>Kategori Acara</label>
                    <select name="kategori">
                        <option value="Concerts" <?php if($data['kategori'] == 'Concerts') echo 'selected'; ?>>Concerts</option>
                        <option value="Festival & Bazaar" <?php if($data['kategori'] == 'Festival & Bazaar') echo 'selected'; ?>>Festival & Bazaar</option>
                        <option value="Private Service" <?php if($data['kategori'] == 'Private Service') echo 'selected'; ?>>Private Service</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Tanggal Pelaksanaan</label>
                    <input type="text" name="tanggal_event" required value="<?php echo htmlspecialchars($data['tanggal_event']); ?>">
                </div>
                
                <div class="form-group">
                    <label>Lokasi (Venue)</label>
                    <input type="text" name="lokasi" required value="<?php echo htmlspecialchars($data['lokasi']); ?>">
                </div>
                
                <div class="form-group">
                    <label>Status</label>
                    <select name="status_event">
                        <option value="Upcoming" <?php if($data['status_event'] == 'Upcoming') echo 'selected'; ?>>Upcoming (Akan Datang)</option>
                        <option value="Selesai" <?php if($data['status_event'] == 'Selesai') echo 'selected'; ?>>Selesai (Past Event)</option>
                    </select>
                </div>
                
                <button type="submit" name="update_event" class="btn-submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>