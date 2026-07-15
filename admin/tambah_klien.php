<?php
session_start();
// Proteksi Keamanan Baru (Wajib ada agar tidak bisa disusupi)
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses ditolak! Anda bukan admin.'); window.location='../auth/login.php';</script>";
    exit;
}
include("../config/koneksi.php");

// Logika Pintar: Memproses form di file yang sama
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_klien'];
    $kontak = $_POST['kontak'];
    $jenis = $_POST['jenis_kerjasama'];

    $query = "INSERT INTO klien (nama_klien, kontak, jenis_kerjasama) VALUES ('$nama', '$kontak', '$jenis')";
    if (mysqli_query($konek, $query)) {
        echo "<script>alert('Data klien baru berhasil ditambahkan!'); window.location='kelola_klien.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data!');</script>";
    }
}

// Panggil Sidebar Terpusat
include("sidebar.php"); 
?>

<div class="main-content">
    <a href="kelola_klien.php" class="btn-kembali" style="display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; font-weight: 600;"><i class="fas fa-arrow-left"></i> Kembali ke Data Klien</a>
    
    <div class="form-container" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); max-width: 800px; border-top: 4px solid #1d419d;">
        <h2 style="margin-bottom: 25px;"><i class="fas fa-user-plus" style="color: #1d419d;"></i> Tambah Klien Baru</h2>
        
        <form method="POST" action="">
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Nama Klien / Instansi</label>
                <input type="text" name="nama_klien" required placeholder="Contoh: PT ABC / Bapak Budi" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Kontak Email / Telp</label>
                <input type="text" name="kontak" required placeholder="Contoh: abc@email.com / 0812..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Jenis Kerjasama</label>
                <select name="jenis_kerjasama" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="Sponsor Event">Sponsor Event</option>
                    <option value="Pengisi Acara (Talent)">Pengisi Acara (Talent)</option>
                    <option value="Prospek Kerjasama Baru">Prospek Kerjasama Baru</option>
                    <option value="Vendor Spesialis">Vendor Spesialis</option>
                </select>
            </div>
            <button type="submit" name="simpan" class="btn-submit" style="background: #1d419d; color: white; padding: 12px 20px; border: none; font-weight: bold; cursor: pointer; border-radius: 4px; width: 100%;">Simpan Data Klien</button>
        </form>
    </div>
</div>
</body>
</html>