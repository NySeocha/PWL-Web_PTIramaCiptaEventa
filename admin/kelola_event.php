<?php
session_start();

// Cek keamanan admin
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}

// INI ADALAH BARIS KRUSIAL YANG HILANG ATAU TERHAPUS:
include("../config/koneksi.php");

// Logika Pintar: Menangkap kategori filter dari URL
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';

// Menyesuaikan Query Database berdasarkan Filter yang dipilih
if ($filter_kategori == 'Concerts') {
    $query = "SELECT * FROM jadwal_event WHERE kategori='Concerts' ORDER BY id_event DESC";
} elseif ($filter_kategori == 'Festival') {
    $query = "SELECT * FROM jadwal_event WHERE kategori='Festival & Bazaar' ORDER BY id_event DESC";
} elseif ($filter_kategori == 'Private') {
    $query = "SELECT * FROM jadwal_event WHERE kategori='Private Service' ORDER BY id_event DESC";
} else {
    $query = "SELECT * FROM jadwal_event ORDER BY id_event DESC";
}

// Sekarang variabel $konek sudah dikenali dari file koneksi.php
$hasil = mysqli_query($konek, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Event - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin_style.css?v=<?php echo time(); ?>">
    <style>
        /* Gaya khusus untuk tombol filter di halaman ini */
        .filter-container { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
        .btn-filter { padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; text-decoration: none; border: 2px solid #1d419d; color: #1d419d; transition: 0.3s; }
        .btn-filter:hover, .btn-filter.active { background: #1d419d; color: #fff; }
        .btn-private { border-color: #9b59b6; color: #9b59b6; }
        .btn-private:hover { background: #9b59b6; color: #fff; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Irama Cipta</h3><p style="font-size: 12px; color: #888; margin-top: 5px;">Admin Panel</p>
        </div>
        <ul class="sidebar-menu">
            <li><a href="admin_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="tampil_tamu_tabel.php"><i class="fas fa-envelope"></i> Pesan Masuk</a></li>
            <li><a href="kelola_klien.php"><i class="fas fa-users"></i> Kelola Klien</a></li>
            <li><a href="kelola_event.php" class="active"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
            <li><a href="../auth/logout.php" style="color: #e74c3c;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header-top">
            <h2><i class="fas fa-calendar-alt"></i> Data Jadwal Event</h2>
            <a href="tambah_event.php" class="btn-tambah"><i class="fas fa-plus"></i> Tambah Event Baru</a>
        </div>

        <!-- Tombol Filter Kategori -->
        <div class="filter-container">
            <a href="kelola_event.php?kategori=Semua" class="btn-filter <?php echo ($filter_kategori == 'Semua') ? 'active' : ''; ?>">Semua Data</a>
            <a href="kelola_event.php?kategori=Concerts" class="btn-filter <?php echo ($filter_kategori == 'Concerts') ? 'active' : ''; ?>"><i class="fas fa-microphone-alt"></i> Concerts</a>
            <a href="kelola_event.php?kategori=Festival" class="btn-filter <?php echo ($filter_kategori == 'Festival') ? 'active' : ''; ?>"><i class="fas fa-store"></i> Festival & Bazaar</a>
            
            <a href="kelola_event.php?kategori=Private" class="btn-filter <?php echo ($filter_kategori == 'Private') ? 'active' : ''; ?>" style="border-color: #9b59b6; color: <?php echo ($filter_kategori == 'Private') ? '#fff' : '#9b59b6'; ?>; background-color: <?php echo ($filter_kategori == 'Private') ? '#9b59b6' : 'transparent'; ?>;"><i class="fas fa-glass-cheers"></i> Private Service</a>
        </div>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama Event / Layanan</th>
                        <th>Kategori</th>
                        <th>Jadwal Pelaksanaan</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(mysqli_num_rows($hasil) > 0) {
                        while ($data = mysqli_fetch_array($hasil)) {
                            echo "<tr>";
                            echo "<td><strong>" . htmlspecialchars($data['nama_event']) . "</strong></td>";
                            
                            // Logika Pewarnaan Kategori yang Disempurnakan
                            if ($data['kategori'] == 'Concerts') {
                                $kategori_warna = 'background: #e74c3c; color: white;';
                            } elseif ($data['kategori'] == 'Festival & Bazaar') {
                                $kategori_warna = 'background: #f39c12; color: white;';
                            } else {
                                // Warna ungu khusus Private Service
                                $kategori_warna = 'background: #9b59b6; color: white;'; 
                            }
                            
                            echo "<td><span style='padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; $kategori_warna'>" . htmlspecialchars($data['kategori']) . "</span></td>";
                            
                            echo "<td>" . htmlspecialchars($data['tanggal_event']) . "</td>";
                            echo "<td>" . htmlspecialchars($data['lokasi']) . "</td>";
                            
                            if($data['status_event'] == 'Upcoming') {
                                echo "<td><span style='background-color: #ff3366; color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold;'>UPCOMING</span></td>";
                            } else {
                                echo "<td><span style='background-color: #333; color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold;'>SELESAI</span></td>";
                            }

                            echo "<td class='action-links'>
                                    <a href='#' class='btn-sm btn-edit'><i class='fas fa-edit'></i></a>
                                    <a href='#' class='btn-sm btn-hapus'><i class='fas fa-trash'></i></a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center; padding: 20px;'>Data jadwal event untuk kategori ini belum tersedia.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>