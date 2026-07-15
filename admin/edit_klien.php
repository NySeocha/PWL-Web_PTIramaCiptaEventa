<?php
session_start();

// Perbaikan Keamanan
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses ditolak! Anda bukan admin.'); window.location='../auth/login.php';</script>";
    exit;
}

include("../config/koneksi.php");

// Menangkap ID klien
$id = $_GET['id'];
$query_ambil = mysqli_query($konek, "SELECT * FROM klien WHERE id_klien='$id'");
$data = mysqli_fetch_array($query_ambil);

// Logika Pemrosesan Update Data
if (isset($_POST['update'])) {
    $nama = $_POST['nama_klien'];
    $kontak = $_POST['kontak'];
    $jenis = $_POST['jenis_kerjasama'];

    $query_update = "UPDATE klien SET nama_klien='$nama', kontak='$kontak', jenis_kerjasama='$jenis' WHERE id_klien='$id'";
    if (mysqli_query($konek, $query_update)) {
        echo "<script>alert('Data klien berhasil diperbarui!'); window.location='kelola_klien.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}

// ==========================================
// PANGGIL SIDEBAR DI SINI
// ==========================================
include("sidebar.php"); 
?>

<div class="main-content">
    <a href="kelola_klien.php" class="btn-kembali" style="display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; font-weight: 600;"><i class="fas fa-arrow-left"></i> Batal Edit & Kembali</a>
    
    <div class="form-container" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); max-width: 800px; border-top: 4px solid #2ecc71;">
        <div class="form-header" style="margin-bottom: 25px;">
            <h2><i class="fas fa-user-edit" style="color: #2ecc71;"></i> Edit Data Klien</h2>
            <p style="color: #888; font-size: 13px;">Ubah informasi kontak atau status kerjasama mitra di bawah ini.</p>
        </div>

        <form method="POST" action="">
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Nama Klien / Instansi</label>
                <input type="text" name="nama_klien" required value="<?php echo htmlspecialchars($data['nama_klien']); ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Kontak Email / Telp</label>
                <input type="text" name="kontak" required value="<?php echo htmlspecialchars($data['kontak']); ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Jenis Kerjasama</label>
                <select name="jenis_kerjasama" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="Sponsor Event" <?php if($data['jenis_kerjasama'] == 'Sponsor Event') echo 'selected'; ?>>Sponsor Event</option>
                    <option value="Pengisi Acara (Talent)" <?php if($data['jenis_kerjasama'] == 'Pengisi Acara (Talent)') echo 'selected'; ?>>Pengisi Acara (Talent)</option>
                    <option value="Prospek Kerjasama Baru" <?php if($data['jenis_kerjasama'] == 'Prospek Kerjasama Baru') echo 'selected'; ?>>Prospek Kerjasama Baru</option>
                    <option value="Vendor Spesialis" <?php if($data['jenis_kerjasama'] == 'Vendor Spesialis') echo 'selected'; ?>>Vendor Spesialis</option>
                </select>
            </div>
            
            <button type="submit" name="update" class="btn-submit" style="background: #2ecc71; color: white; padding: 12px 20px; border: none; font-weight: bold; cursor: pointer; border-radius: 4px; width: 100%;">Simpan Perubahan</button>
        </form>
    </div>
</div>

</body>
</html>