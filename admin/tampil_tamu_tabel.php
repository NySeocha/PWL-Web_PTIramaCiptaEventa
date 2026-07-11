<?php
session_start();

// Cek keamanan: pastikan hanya admin yang bisa masuk
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}

include("../config/koneksi.php");
// PERHATIAN: include("../templates/header.php"); sengaja DIHAPUS karena admin memakai sidebar, bukan navbar publik.
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pesan Masuk - Admin Panel</title>
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
            <li><a href="tampil_tamu_tabel.php" class="active"><i class="fas fa-envelope"></i> Pesan Masuk</a></li>
            <li><a href="kelola_klien.php"><i class="fas fa-users"></i> Kelola Klien</a></li>
            <li><a href="kelola_event.php"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
            <li><a href="../auth/logout.php" style="color: #e74c3c;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header-top">
            <div>
                <h2><i class="fas fa-inbox"></i> Data Formulir Masuk</h2>
                <p style="color: #666; font-size: 14px; margin-top: 5px;">Kelola seluruh pesan dan penawaran kerja sama dari klien</p>
            </div>
        </div>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama Pengirim</th>
                        <th>Kontak Email</th>
                        <th>Kategori</th>
                        <th style="width: 35%;">Detail Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Logika Pintar: Mengurutkan pesan dari yang paling terbaru (DESC)
                    $tampil = "SELECT * FROM buku_tamu ORDER BY id_tamu DESC"; 
                    $hasil = mysqli_query($konek, $tampil);
                    
                    if(mysqli_num_rows($hasil) > 0) {
                        while ($data = mysqli_fetch_array($hasil)) {
                            echo "<tr>";
                            echo "<td><strong>" . htmlspecialchars($data['nama']) . "</strong></td>";
                            echo "<td>" . htmlspecialchars($data['email']) . "</td>";
                            echo "<td><span class='badge'>" . htmlspecialchars($data['kategori']) . "</span></td>";
                            
                            // Menampilkan isi pesan dan indikator status
                            echo "<td>";
                            echo "<div style='line-height: 1.5;'>" . nl2br(htmlspecialchars($data['pesan'])) . "</div>";
                            
                            // Cek apakah admin sudah mengisi kolom jawaban
                            if (!empty($data['jawaban'])) {
                                echo "<span class='status-dibalas'><i class='fas fa-check-double'></i> Sudah ditanggapi</span>";
                            } else {
                                echo "<span class='status-pending'><i class='fas fa-clock'></i> Menunggu tanggapan</span>";
                            }
                            echo "</td>";

                            // Tombol Aksi dengan Ikon
                            echo "<td class='action-links'>
                                    <a href=\"balas_tamu.php?id=$data[id_tamu]\" class='btn-sm btn-balas'><i class='fas fa-reply'></i> Balas</a>
                                    <a href=\"edit_tamu.php?id=$data[id_tamu]\" class='btn-sm btn-edit'><i class='fas fa-edit'></i> Edit</a>
                                    <a href=\"hapus_tamu.php?id=$data[id_tamu]\" class='btn-sm btn-hapus' onclick=\"return confirm('Apakah Anda yakin ingin menghapus pesan ini secara permanen?')\"><i class='fas fa-trash'></i> Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        // Jika database kosong
                        echo "<tr><td colspan='5' style='text-align:center; padding: 30px; color: #888;'>Belum ada data formulir masuk saat ini.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>