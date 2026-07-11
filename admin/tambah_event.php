<?php
session_start();
include("../config/koneksi.php");

// Logika untuk menyimpan data form
if (isset($_POST['simpan_event'])) {
    $nama = $_POST['nama_event'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal_event'];
    $lokasi = $_POST['lokasi'];
    $status = $_POST['status_event'];

    $query = "INSERT INTO jadwal_event (nama_event, kategori, tanggal_event, lokasi, status_event) VALUES ('$nama', '$kategori', '$tanggal', '$lokasi', '$status')";
    
    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Event baru berhasil ditambahkan ke jadwal!'); window.location='kelola_event.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan event!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Event - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Sidebar Admin -->
    <div class="sidebar">
        <div class="sidebar-header"><h3>Irama Cipta</h3><p style="font-size: 12px; color: #888;">Admin Panel</p></div>
        <ul class="sidebar-menu">
            <li><a href="admin_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="tampil_tamu_tabel.php"><i class="fas fa-envelope"></i> Pesan Masuk</a></li>
            <li><a href="kelola_klien.php"><i class="fas fa-users"></i> Kelola Klien</a></li>
            <li><a href="kelola_event.php" class="active"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
        </ul>
    </div>

    <div class="main-content">
        <a href="kelola_event.php" class="btn-kembali"><i class="fas fa-arrow-left"></i> Batal & Kembali</a>
        
        <div class="form-container">
            <h2 style="margin-bottom: 25px;"><i class="fas fa-calendar-plus"></i> Tambah Event Baru</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Konser / Festival</label>
                    <input type="text" name="nama_event" required placeholder="Contoh: Stray Kids: RUN IT World Tour">
                </div>
                <div class="form-group">
                    <label>Kategori Acara</label>
                    <select name="kategori">
                        <option value="Concerts">Concerts</option>
                        <option value="Festival & Bazaar">Festival & Bazaar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Pelaksanaan</label>
                    <input type="text" name="tanggal_event" required placeholder="Contoh: 1 Agustus 2027">
                </div>
                <div class="form-group">
                    <label>Lokasi (Venue)</label>
                    <input type="text" name="lokasi" required placeholder="Contoh: Indonesia Arena, Jakarta">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status_event">
                        <option value="Upcoming">Upcoming (Akan Datang)</option>
                        <option value="Selesai">Selesai (Past Event)</option>
                    </select>
                </div>
                <button type="submit" name="simpan_event" class="btn-submit">Simpan Event ke Database</button>
            </form>
        </div>
    </div>
</body>
</html>