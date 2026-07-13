<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}
include("../config/koneksi.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Klien - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Irama Cipta</h3>
            <p style="font-size: 12px; color: #888; margin-top: 5px;">Admin Panel</p>
        </div>
        <ul class="sidebar-menu">
            <li><a href="admin_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="tampil_tamu_tabel.php"><i class="fas fa-envelope"></i> Pesan Masuk</a></li>
            <li><a href="kelola_klien.php" class="active"><i class="fas fa-users"></i> Kelola Klien</a></li>
            <li><a href="kelola_event.php"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <!-- <li><a href="kelola_galeri.php"><i class="fas fa-images"></i> Kelola Galeri Acara</a></li> -->
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
            <li><a href="../auth/logout.php" style="color: #e74c3c;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header-top">
            <h2><i class="fas fa-users"></i> Data Klien / Mitra</h2>
            <a href="tambah_klien.php" class="btn-tambah"><i class="fas fa-plus"></i> Tambah Klien Baru</a>
        </div>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama / Instansi</th>
                        <th>Kontak</th>
                        <th>Jenis Kerjasama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Pastikan query ini menyesuaikan nama kolom di databasemu
                    $query = "SELECT * FROM klien ORDER BY id_klien DESC";
                    $hasil = mysqli_query($konek, $query);
                    if(mysqli_num_rows($hasil) > 0) {
                        while ($data = mysqli_fetch_array($hasil)) {
                            echo "<tr>";
                            echo "<td>#" . $data['id_klien'] . "</td>";
                            // Ganti 'nama_klien' dll sesuai dengan field tabel 'klien' kamu
                            echo "<td><strong>" . (isset($data['nama_klien']) ? $data['nama_klien'] : 'Data Klien') . "</strong></td>";
                            echo "<td>" . (isset($data['kontak']) ? $data['kontak'] : '-') . "</td>";
                            echo "<td>" . (isset($data['jenis_kerjasama']) ? $data['jenis_kerjasama'] : 'Sponsor') . "</td>";
                            echo "<td class='action-links'>
                                <a href='detail_klien.php?id=" . $data['id_klien'] . "' class='btn-sm' style='background: #3498db; color: white; border:none;'><i class='fas fa-info-circle'></i> Detail</a>
                                <a href='edit_klien.php?id=" . $data['id_klien'] . "' class='btn-sm btn-edit'><i class='fas fa-edit'></i> Edit</a>
                                <a href='hapus_klien.php?id=" . $data['id_klien'] . "' class='btn-sm btn-hapus' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data klien ini?')\"><i class='fas fa-trash'></i> Hapus</a>
                            </td>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>Belum ada data klien terdaftar.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>