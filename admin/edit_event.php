<?php
session_start();

// Perbaikan Keamanan: Menggunakan sistem level yang baru kita buat
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses ditolak! Anda bukan admin.'); window.location='../auth/login.php';</script>";
    exit;
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

// ==========================================
// PANGGIL SIDEBAR DI SINI (Menggantikan kode HTML manual)
// ==========================================
include("sidebar.php"); 
?>

<div class="main-content">
    <a href="kelola_event.php" class="btn-kembali" style="display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; font-weight: 600;"><i class="fas fa-arrow-left"></i> Batal Edit & Kembali</a>
    
    <div class="form-container" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); max-width: 800px; border-top: 4px solid #2ecc71;">
        <h2 style="margin-bottom: 25px;"><i class="fas fa-edit" style="color: #2ecc71;"></i> Edit Data Event</h2>
        
        <form method="POST" action="">
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Nama Konser / Layanan</label>
                <input type="text" name="nama_event" required value="<?php echo htmlspecialchars($data['nama_event']); ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Kategori Acara</label>
                <select name="kategori" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="Concerts" <?php if($data['kategori'] == 'Concerts') echo 'selected'; ?>>Concerts</option>
                    <option value="Festival & Bazaar" <?php if($data['kategori'] == 'Festival & Bazaar') echo 'selected'; ?>>Festival & Bazaar</option>
                    <option value="Private Service" <?php if($data['kategori'] == 'Private Service') echo 'selected'; ?>>Private Service</option>
                </select>
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Tanggal Pelaksanaan</label>
                <input type="text" name="tanggal_event" required value="<?php echo htmlspecialchars($data['tanggal_event']); ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Lokasi (Venue)</label>
                <input type="text" name="lokasi" required value="<?php echo htmlspecialchars($data['lokasi']); ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Status</label>
                <select name="status_event" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="Upcoming" <?php if($data['status_event'] == 'Upcoming') echo 'selected'; ?>>Upcoming (Akan Datang)</option>
                    <option value="Selesai" <?php if($data['status_event'] == 'Selesai') echo 'selected'; ?>>Selesai (Past Event)</option>
                </select>
            </div>
            
            <button type="submit" name="update_event" class="btn-submit" style="background: #2ecc71; color: white; padding: 12px 20px; border: none; font-weight: bold; cursor: pointer; border-radius: 4px; width: 100%;">Simpan Perubahan</button>
        </form>
    </div>
</div>

</body>
</html>