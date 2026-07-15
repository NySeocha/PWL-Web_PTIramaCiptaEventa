<?php
session_start();

// Proteksi: Hanya admin yang boleh masuk!
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses ditolak! Anda bukan admin.'); window.location='../auth/login.php';</script>";
    exit;
}

include("../config/koneksi.php");

// ==========================================
// LOGIKA PINTAR: Mengambil Statistik dari Semua Tabel
// ==========================================

// 1. Total semua pesan di Buku Tamu
$query_total = mysqli_query($konek, "SELECT COUNT(*) as total FROM buku_tamu");
$row_total = mysqli_fetch_assoc($query_total);
$total_pesan = $row_total['total'];

// 2. Pesan yang belum dibalas
$query_pending = mysqli_query($konek, "SELECT COUNT(*) as pending FROM buku_tamu WHERE jawaban IS NULL OR jawaban = ''");
$row_pending = mysqli_fetch_assoc($query_pending);
$pesan_pending = $row_pending['pending'];

// 3. Menghitung total jadwal event yang terdaftar
$query_event = mysqli_query($konek, "SELECT COUNT(*) as total_event FROM jadwal_event");
$row_event = mysqli_fetch_assoc($query_event);
$total_event = $row_event['total_event'];

// 4. Menghitung total klien / mitra perusahaan
$query_klien = mysqli_query($konek, "SELECT COUNT(*) as total_klien FROM klien");
$row_klien = mysqli_fetch_assoc($query_klien);
$total_klien = $row_klien['total_klien'];

// ==========================================
// PANGGIL SIDEBAR (Mewakili <head> dan Navigasi Kiri)
// ==========================================
include("../admin/sidebar.php"); 
?>

<div class="main-content">
    
    <div class="header-top" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #ddd; padding-bottom: 15px;">
        <div>
            <h2 style="color: #111; margin-bottom: 5px;">Dashboard Admin</h2>
            <p style="color: #666; font-size: 14px;">Selamat datang kembali, <strong><?php echo $_SESSION['nama']; ?></strong>! Berikut adalah ringkasan data sistem hari ini.</p>
        </div>
        <div class="admin-profile" style="display: flex; align-items: center; gap: 10px; background: #fff; padding: 10px 20px; border-radius: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
            <i class="fas fa-user-circle" style="font-size: 24px; color: #1d419d;"></i>
            <span style="font-weight: 600; color: #333;"><?php echo $_SESSION['username']; ?></span>
        </div>
    </div>

    <div class="dashboard-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
        
        <div class="stat-card" style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; border-left: 5px solid #1d419d;">
            <div class="stat-card-info">
                <h3 style="font-size: 28px; margin-bottom: 5px; color: #111;"><?php echo $total_pesan; ?></h3>
                <p style="color: #666; font-size: 14px; font-weight: 600;">Pesan Masuk</p>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-envelope-open-text" style="font-size: 35px; color: #1d419d; opacity: 0.2;"></i>
            </div>
        </div>

        <div class="stat-card warning" style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; border-left: 5px solid #f39c12;">
            <div class="stat-card-info">
                <h3 style="font-size: 28px; margin-bottom: 5px; color: #111;"><?php echo $pesan_pending; ?></h3>
                <p style="color: #666; font-size: 14px; font-weight: 600;">Menunggu Balasan</p>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-exclamation-circle" style="font-size: 35px; color: #f39c12; opacity: 0.2;"></i>
            </div>
        </div>

        <div class="stat-card success" style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; border-left: 5px solid #2ecc71;">
            <div class="stat-card-info">
                <h3 style="font-size: 28px; margin-bottom: 5px; color: #111;"><?php echo $total_event; ?></h3>
                <p style="color: #666; font-size: 14px; font-weight: 600;">Total Jadwal Event</p>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-calendar-alt" style="font-size: 35px; color: #2ecc71; opacity: 0.2;"></i>
            </div>
        </div>

        <div class="stat-card primary" style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; border-left: 5px solid #9b59b6;">
            <div class="stat-card-info">
                <h3 style="font-size: 28px; margin-bottom: 5px; color: #111;"><?php echo $total_klien; ?></h3>
                <p style="color: #666; font-size: 14px; font-weight: 600;">Total Klien/Mitra</p>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-users" style="font-size: 35px; color: #9b59b6; opacity: 0.2;"></i>
            </div>
        </div>

    </div>
    
</div>

</body>
</html>