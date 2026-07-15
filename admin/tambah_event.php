<?php
session_start();
// Proteksi Keamanan Baru (Agar tidak ada orang iseng yang bisa menambah event)
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses ditolak! Anda bukan admin.'); window.location='../auth/login.php';</script>";
    exit;
}
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

// ==========================================
// PANGGIL SIDEBAR
// ==========================================
include("sidebar.php"); 
?>

<div class="main-content">
    <a href="kelola_event.php" class="btn-kembali" style="display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; font-weight: 600;"><i class="fas fa-arrow-left"></i> Batal & Kembali</a>
    
    <div class="form-container" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); max-width: 800px; border-top: 4px solid #1d419d;">
        <h2 style="margin-bottom: 25px;"><i class="fas fa-calendar-plus" style="color: #1d419d;"></i> Tambah Event Baru</h2>
        <form method="POST" action="">
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Nama Konser / Festival</label>
                <input type="text" name="nama_event" required placeholder="Contoh: Stray Kids: RUN IT World Tour" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Kategori Acara</label>
                <select name="kategori" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="Concerts">Concerts</option>
                    <option value="Festival & Bazaar">Festival & Bazaar</option>
                    <option value="Private Service">Private Service</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Tanggal Pelaksanaan</label>
                <input type="text" name="tanggal_event" required placeholder="Contoh: 1 Agustus 2027" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Lokasi (Venue)</label>
                <input type="text" name="lokasi" required placeholder="Contoh: Indonesia Arena, Jakarta" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Status</label>
                <select name="status_event" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="Upcoming">Upcoming (Akan Datang)</option>
                    <option value="Selesai">Selesai (Past Event)</option>
                </select>
            </div>
            <button type="submit" name="simpan_event" class="btn-submit" style="background: #1d419d; color: white; padding: 12px 20px; border: none; font-weight: bold; cursor: pointer; border-radius: 4px; width: 100%;">Simpan Event ke Database</button>
        </form>
    </div>
</div>
</body>
</html>