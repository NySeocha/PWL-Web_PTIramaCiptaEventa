<?php
session_start();

// Jika belum login ATAU bukan admin, tendang ke luar!
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses ditolak! Hanya admin yang diizinkan.'); window.location='../login.php';</script>";
    exit;
}

include("../config/koneksi.php");
include("../templates/header.php");

$id = $_GET['id'];
$query = "SELECT * FROM buku_tamu WHERE id_tamu = '$id'";
$hasil = mysqli_query($konek, $query);
$data = mysqli_fetch_array($hasil);
?>

<div style="max-width: 800px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
    <h2 style="color: #1d419d; margin-bottom: 20px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">Balas Pesan Pengunjung</h2>
    
    <div style="background: #f8fafc; padding: 20px; border-left: 4px solid #1d419d; border-radius: 4px; margin-bottom: 25px;">
        <p style="margin-bottom: 5px;"><strong>Dari:</strong> <?php echo $data['nama']; ?> (<?php echo $data['email']; ?>)</p>
        <p style="margin-bottom: 5px;"><strong>Kategori:</strong> <span style="background: #1d419d; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 12px;"><?php echo $data['kategori']; ?></span></p>
        <p style="margin-top: 15px; color: #444; font-style: italic;">"<?php echo $data['pesan']; ?>"</p>
    </div>

    <form method="POST" action="simpan_balasan.php">
        <input type="hidden" name="id_tamu" value="<?php echo $data['id_tamu']; ?>">
        
        <label style="font-weight: bold; color: #333; display: block; margin-bottom: 10px;">Tanggapan Admin:</label>
        <textarea name="jawaban" rows="6" required placeholder="Ketik balasan Anda di sini..." style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; margin-bottom: 20px;"><?php echo $data['jawaban']; ?></textarea>
        
        <div style="display: flex; gap: 15px;">
            <button type="submit" style="background: #1d419d; color: #fff; padding: 10px 25px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">Kirim Balasan</button>
            <a href="tampil_tamu_tabel.php" style="background: #e2e8f0; color: #333; padding: 10px 25px; text-decoration: none; border-radius: 6px; font-weight: bold;">Batal</a>
        </div>
    </form>
</div>
</body>
</html>