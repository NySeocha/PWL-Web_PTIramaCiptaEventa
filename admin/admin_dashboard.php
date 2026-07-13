<?php
session_start();

// Cek keamanan: pastikan hanya admin yang bisa masuk
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: ../auth/login.php");
    exit();
}

include("../config/koneksi.php");

// ==========================================
// LOGIKA PINTAR: Mengambil Statistik dari Semua Tabel
// ==========================================

// 1. Total semua pesan di Buku Tamu
$query_total = mysqli_query($konek, "SELECT COUNT(*) as total FROM buku_tamu");
$row_total = mysqli_fetch_assoc($query_total);
$total_pesan =$row_total['total'];

// 2. Pesan yang belum dibalas
$query_pending = mysqli_query($konek, "SELECT COUNT(*) as pending FROM buku_tamu WHERE jawaban IS NULL OR jawaban = ''");
$row_pending = mysqli_fetch_assoc($query_pending);
$pesan_pending =$row_pending['pending'];

// 3. Menghitung total jadwal event yang terdaftar
$query_event = mysqli_query($konek, "SELECT COUNT(*) as total_event FROM jadwal_event");
$row_event = mysqli_fetch_assoc($query_event);
$total_event =$row_event['total_event'];

// 4. Menghitung total klien / mitra perusahaan
$query_klien = mysqli_query($konek, "SELECT COUNT(*) as total_klien FROM klien");
$row_klien = mysqli_fetch_assoc($query_klien);
$total_klien =$row_klien['total_klien'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - PT Irama Cipta Eventa</title>
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
            <li><a href="admin_dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="tampil_tamu_tabel.php"><i class="fas fa-envelope"></i> Pesan Masuk</a></li>
            <li><a href="kelola_klien.php"><i class="fas fa-users"></i> Kelola Klien</a></li>
            <li><a href="kelola_event.php"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <!-- <li><a href="kelola_galeri.php"><i class="fas fa-images"></i> Kelola Galeri Acara</a></li> -->
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
            <li><a href="../auth/logout.php" style="color: #e74c3c; margin-top: 20px;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header-top">
            <h2>Dashboard Admin</h2>
            <div class="admin-profile">
                <i class="fas fa-user-circle" style="font-size: 24px; color: #1d419d;"></i>
                <span>Halo, <?php echo $_SESSION['username']; ?></span>
            </div>
        </div>

        <div class="dashboard-grid">
            
            <div class="stat-card">
                <div class="stat-card-info">
                    <h3><?php echo $total_pesan; ?></h3>
                    <p>Pesan Masuk</p>
                </div>
                <div class="stat-card-icon"><i class="fas fa-envelope-open-text"></i></div>
            </div>

            <div class="stat-card warning">
                <div class="stat-card-info">
                    <h3><?php echo $pesan_pending; ?></h3>
                    <p>Menunggu Balasan</p>
                </div>
                <div class="stat-card-icon"><i class="fas fa-exclamation-circle" style="color: #f39c12; opacity: 0.5;"></i></div>
            </div>

            <div class="stat-card success">
                <div class="stat-card-info">
                    <h3><?php echo $total_event; ?></h3>
                    <p>Total Jadwal Event</