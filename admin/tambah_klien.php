<?php
session_start();
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Klien - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header"><h3>Irama Cipta</h3><p style="font-size: 12px; color: #888;">Admin Panel</p></div>
        <ul class="sidebar-menu">
            <li><a href="admin_dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="tampil_tamu_tabel.php"><i class="fas fa-envelope"></i> Pesan Masuk</a></li>
            <li><a href="kelola_klien.php"><i class="fas fa-users"></i> Kelola Klien</a></li>
            <li><a href="kelola_event.php"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
        </ul>
    </div>

    <div class="main-content">
        <a href="kelola_klien.php" class="btn-kembali"><i class="fas fa-arrow-left"></i> Kembali ke Data Klien</a>
        <div class="form-container">
            <h2 style="margin-bottom: 25px;"><i class="fas fa-user-plus"></i> Tambah Klien Baru</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Klien / Instansi</label>
                    <input type="text" name="nama_klien" required placeholder="Contoh: PT ABC / Bapak Budi">
                </div>
                <div class="form-group">
                    <label>Kontak Email / Telp</label>
                    <input type="text" name="kontak" required placeholder="Contoh: abc@email.com / 0812...">
                </div>
                <div class="form-group">
                    <label>Jenis Kerjasama</label>
                    <select name="jenis_kerjasama">
                        <option value="Sponsor Event">Sponsor Event</option>
                        <option value="Pengisi Acara (Talent)">Pengisi Acara (Talent)</option>
                        <option value="Prospek Kerjasama Baru">Prospek Kerjasama Baru</option>
                        <option value="Vendor Spesialis">Vendor Spesialis</option>
                    </select>
                </div>
                <button type="submit" name="simpan" class="btn-submit">Simpan Data Klien</button>
            </form>
        </div>
    </div>
</body>
</html>