<?php
session_start();
// Proteksi Keamanan Baru
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses ditolak! Anda bukan admin.'); window.location='../auth/login.php';</script>";
    exit;
}
include("../config/koneksi.php");

// ==========================================
// PANGGIL SIDEBAR
// ==========================================
include("sidebar.php"); 
?>

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
                $query = "SELECT * FROM klien ORDER BY id_klien DESC";
                $hasil = mysqli_query($konek, $query);
                if(mysqli_num_rows($hasil) > 0) {
                    while ($data = mysqli_fetch_array($hasil)) {
                        echo "<tr>";
                        echo "<td>#" . $data['id_klien'] . "</td>";
                        echo "<td><strong>" . (isset($data['nama_klien']) ? $data['nama_klien'] : 'Data Klien') . "</strong></td>";
                        echo "<td>" . (isset($data['kontak']) ? $data['kontak'] : '-') . "</td>";
                        echo "<td>" . (isset($data['jenis_kerjasama']) ? $data['jenis_kerjasama'] : 'Sponsor') . "</td>";
                        echo "<td class='action-links'>
                            <a href='detail_klien.php?id=" . $data['id_klien'] . "' class='btn-sm' style='background: #3498db; color: white; border:none;'><i class='fas fa-info-circle'></i> Detail</a>
                            <a href='edit_klien.php?id=" . $data['id_klien'] . "' class='btn-sm btn-edit'><i class='fas fa-edit'></i> Edit</a>
                            <a href='hapus_klien.php?id=" . $data['id_klien'] . "' class='btn-sm btn-hapus' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data klien ini?')\"><i class='fas fa-trash'></i> Hapus</a>
                        </td>";
                        echo "</tr>";
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