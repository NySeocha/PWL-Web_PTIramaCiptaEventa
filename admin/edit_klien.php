<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Klien - Admin Panel</title>
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
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
        </ul>
    </div>

    <div class="main-content">
        <a href="kelola_klien.php" class="btn-kembali"><i class="fas fa-arrow-left"></i> Batal Edit & Kembali</a>
        
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-user-edit" style="color: #2ecc71;"></i> Edit Data Klien</h2>
                <p style="color: #888; font-size: 13px;">Ubah informasi kontak atau status kerjasama mitra di bawah ini.</p>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Klien / Instansi</label>
                    <input type="text" name="nama_klien" required value="<?php echo htmlspecialchars($data['nama_klien']); ?>">
                </div>
                
                <div class="form-group">
                    <label>Kontak Email / Telp</label>
                    <input type="text" name="kontak" required value="<?php echo htmlspecialchars($data['kontak']); ?>">
                </div>
                
                <div class="form-group">
                    <label>Jenis Kerjasama</label>
                    <select name="jenis_kerjasama">
                        <option value="Sponsor Event" <?php if($data['jenis_kerjasama'] == 'Sponsor Event') echo 'selected'; ?>>Sponsor Event</option>
                        <option value="Pengisi Acara (Talent)" <?php if($data['jenis_kerjasama'] == 'Pengisi Acara (Talent)') echo 'selected'; ?>>Pengisi Acara (Talent)</option>
                        <option value="Prospek Kerjasama Baru" <?php if($data['jenis_kerjasama'] == 'Prospek Kerjasama Baru') echo 'selected'; ?>>Prospek Kerjasama Baru</option>
                        <option value="Vendor Spesialis" <?php if($data['jenis_kerjasama'] == 'Vendor Spesialis') echo 'selected'; ?>>Vendor Spesialis</option>
                    </select>
                </div>
                
                <button type="submit" name="update" class="btn-submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>

</body>
</html>