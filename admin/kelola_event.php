<?php
session_start();
// Proteksi Keamanan Baru
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses ditolak! Anda bukan admin.'); window.location='../auth/login.php';</script>";
    exit;
}
include("../config/koneksi.php");

// 1. Menangkap dua jenis filter dari URL
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'Semua';

// 2. Trik Logika Pintar: Menggunakan WHERE 1=1 agar filter bisa digabung
$query = "SELECT * FROM jadwal_event WHERE 1=1";

if ($filter_kategori == 'Concerts') {
    $query .= " AND kategori='Concerts'";
} elseif ($filter_kategori == 'Festival') {
    $query .= " AND kategori='Festival & Bazaar'";
} elseif ($filter_kategori == 'Private') {
    $query .= " AND kategori='Private Service'";
}

if ($filter_status == 'Upcoming') {
    $query .= " AND status_event='Upcoming'";
} elseif ($filter_status == 'Selesai') {
    $query .= " AND status_event='Selesai'";
}

$query .= " ORDER BY id_event DESC";
$hasil = mysqli_query($konek, $query);

// ==========================================
// PANGGIL SIDEBAR
// ==========================================
include("sidebar.php"); 
?>

<div class="main-content">
    <div class="header-top">
        <h2><i class="fas fa-calendar-alt"></i> Data Jadwal Event</h2>
        <a href="tambah_event.php" class="btn-tambah"><i class="fas fa-plus"></i> Tambah Event Baru</a>
    </div>

    <div class="filter-wrapper" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        
        <div class="filter-kategori" style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="kelola_event.php?kategori=Semua&status=<?php echo $filter_status; ?>" class="btn-filter <?php echo ($filter_kategori == 'Semua') ? 'active' : ''; ?>" style="padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; text-decoration: none; border: 2px solid #1d419d; color: <?php echo ($filter_kategori == 'Semua') ? '#fff' : '#1d419d'; ?>; background: <?php echo ($filter_kategori == 'Semua') ? '#1d419d' : 'transparent'; ?>;">Semua Kategori</a>
            
            <a href="kelola_event.php?kategori=Concerts&status=<?php echo $filter_status; ?>" class="btn-filter <?php echo ($filter_kategori == 'Concerts') ? 'active' : ''; ?>" style="padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; text-decoration: none; border: 2px solid #1d419d; color: <?php echo ($filter_kategori == 'Concerts') ? '#fff' : '#1d419d'; ?>; background: <?php echo ($filter_kategori == 'Concerts') ? '#1d419d' : 'transparent'; ?>;"><i class="fas fa-microphone-alt"></i> Concerts</a>
            
            <a href="kelola_event.php?kategori=Festival&status=<?php echo $filter_status; ?>" class="btn-filter <?php echo ($filter_kategori == 'Festival') ? 'active' : ''; ?>" style="padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; text-decoration: none; border: 2px solid #1d419d; color: <?php echo ($filter_kategori == 'Festival') ? '#fff' : '#1d419d'; ?>; background: <?php echo ($filter_kategori == 'Festival') ? '#1d419d' : 'transparent'; ?>;"><i class="fas fa-store"></i> Festival & Bazaar</a>
            
            <a href="kelola_event.php?kategori=Private&status=<?php echo $filter_status; ?>" class="btn-filter <?php echo ($filter_kategori == 'Private') ? 'active' : ''; ?>" style="padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; text-decoration: none; border: 2px solid #1d419d; color: <?php echo ($filter_kategori == 'Private') ? '#fff' : '#1d419d'; ?>; background: <?php echo ($filter_kategori == 'Private') ? '#1d419d' : 'transparent'; ?>;"><i class="fas fa-glass-cheers"></i> Private Service</a>
        </div>

        <div>
            <form method="GET" action="kelola_event.php">
                <input type="hidden" name="kategori" value="<?php echo $filter_kategori; ?>">
                <select name="status" onchange="this.form.submit()" style="padding: 10px 15px; border-radius: 6px; border: 2px solid #ddd; font-family: 'Montserrat', sans-serif; font-size: 13px; font-weight: 600; color: #333; outline: none; cursor: pointer; background-color: #fff;">
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