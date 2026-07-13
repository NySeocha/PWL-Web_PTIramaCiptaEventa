<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}
include("../config/koneksi.php");

// 1. Menangkap dua jenis filter dari URL
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'Semua';

// 2. Trik Logika Pintar: Menggunakan WHERE 1=1 agar filter bisa digabung
$query = "SELECT * FROM jadwal_event WHERE 1=1";

// Filter berdasarkan kategori
if ($filter_kategori == 'Concerts') {
    $query .= " AND kategori='Concerts'";
} elseif ($filter_kategori == 'Festival') {
    $query .= " AND kategori='Festival & Bazaar'";
} elseif ($filter_kategori == 'Private') {
    $query .= " AND kategori='Private Service'";
}

// Filter berdasarkan status dari combobox
if ($filter_status == 'Upcoming') {
    $query .= " AND status_event='Upcoming'";
} elseif ($filter_status == 'Selesai') {
    $query .= " AND status_event='Selesai'";
}

$query .= " ORDER BY id_event DESC";
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
        .filter-wrapper { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px; }
        .filter-kategori { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn-filter { padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; text-decoration: none; border: 2px solid #1d419d; color: #1d419d; transition: 0.3s; }
        .btn-filter:hover, .btn-filter.active { background: #1d419d; color: #fff; }
        .btn-private { border-color: #9b59b6; color: #9b59b6; }
        
        /* Desain cantik untuk combobox / dropdown */
        .combo-box-status { 
            padding: 10px 15px; border-radius: 6px; border: 2px solid #ddd; 
            font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 600; 
            color: #333; outline: none; cursor: pointer; transition: 0.3s;
            background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .combo-box-status:focus { border-color: #1d419d; }
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
            <!-- <li><a href="kelola_galeri.php"><i class="fas fa-images"></i> Kelola Galeri Acara</a></li> -->
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
            <li><a href="../auth/logout.php" style="color: #e74c3c; margin-top: 20px;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header-top">
            <h2><i class="fas fa-calendar-alt"></i> Data Jadwal Event</h2>
            <a href="tambah_event.php" class="btn-tambah"><i class="fas fa-plus"></i> Tambah Event Baru</a>
        </div>

        <div class="filter-wrapper">
            
            <div class="filter-kategori">
                <a href="kelola_event.php?kategori=Semua&status=<?php echo $filter_status; ?>" class="btn-filter <?php echo ($filter_kategori == 'Semua') ? 'active' : ''; ?>">Semua Kategori</a>
                <a href="kelola_event.php?kategori=Concerts&status=<?php echo $filter_status; ?>" class="btn-filter <?php echo ($filter_kategori == 'Concerts') ? 'active' : ''; ?>"><i class="fas fa-microphone-alt"></i> Concerts</a>
                <a href="kelola_event.php?kategori=Festival&status=<?php echo $filter_status; ?>" class="btn-filter <?php echo ($filter_kategori == 'Festival') ? 'active' : ''; ?>"><i class="fas fa-store"></i> Festival & Bazaar</a>
                <a href="kelola_event.php?kategori=Private&status=<?php echo $filter_status; ?>" class="btn-filter <?php echo ($filter_kategori == 'Private') ? 'active' : ''; ?>" style="border-color: #9b59b6; color: <?php echo ($filter_kategori == 'Private') ? '#fff' : '#9b59b6'; ?>; background-color: <?php echo ($filter_kategori == 'Private') ? '#9b59b6' : 'transparent'; ?>;"><i class="fas fa-glass-cheers"></i> Private Service</a>
            </div>

            <div>
                <form method="GET" action="kelola_event.php">
                    <input type="hidden" name="kategori" value="<?php echo $filter_kategori; ?>">
                    
                    <select name="status" class="combo-box-status" onchange="this.form.submit()">
                        <option value="Semua" <?php if($filter_status == 'Semua') echo 'selected'; ?>>Semua Data</option>
                        <option value="Upcoming" <?php if($filter_status == 'Upcoming') echo 'selected'; ?>>Upcoming Event</option>
                        <option value="Selesai" <?php if($filter_status == 'Selesai') echo 'selected'; ?>>Past Event (Selesai)</option>
                    </select>
                </form>
            </div>
            
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
                            
                            if ($data['kategori'] == 'Concerts') {
                                $kategori_warna = 'background: #e74c3c; color: white;';
                            } elseif ($data['kategori'] == 'Festival & Bazaar') {
                                $kategori_warna = 'background: #f39c12; color: white;';
                            } else {
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
                                    <a href='ubah_status_event.php?id=" . $data['id_event'] . "' class='btn-sm' style='background: #f39c12; color: white; border: none;' title='Ubah Status (Upcoming / Selesai)'>
                                        <i class='fas fa-exchange-alt'></i>
                                    </a>
                                    <a href='edit_event.php?id=" . $data['id_event'] . "' class='btn-sm btn-edit' title='Edit Data'><i class='fas fa-edit'></i></a>
                                    <a href='hapus_event.php?id=" . $data['id_event'] . "' class='btn-sm btn-hapus' title='Hapus Event' onclick=\"return confirm('Apakah Anda yakin ingin menghapus jadwal acara ini?')\"><i class='fas fa-trash'></i></a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center; padding: 20px;'>Data jadwal event untuk kategori dan status ini tidak ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>