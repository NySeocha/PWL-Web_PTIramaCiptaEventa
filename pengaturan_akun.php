<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Akun - PT Irama Cipta Eventa</title>
    <?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if(!isset($_SESSION['user_id'])){
        header("Location: auth/login.php");
        exit();
    }
    
    include("config/koneksi.php"); 

    $user_id = $_SESSION['user_id'];
    $folder_sekarang = basename(dirname($_SERVER['PHP_SELF']));
    $prefix = ($folder_sekarang == 'admin' || $folder_sekarang == 'auth') ? "../" : "";

    // Mengambil data terbaru dari database
    $query_data = mysqli_query($konek, "SELECT * FROM users WHERE id_user='$user_id'");
    $user_data = mysqli_fetch_assoc($query_data);

    $user_nama   = !empty($user_data['nama']) ? $user_data['nama'] : 'Belum diatur';
    $user_email  = !empty($user_data['email']) ? $user_data['email'] : 'Belum diatur';
    $membership_status = (isset($user_data['level']) && $user_data['level'] == 'admin') ? 'ADMINISTRATOR' : 'MEMBER AKTIF';
    
    // ==========================================
    // HITUNG STATISTIK DINAMIS DARI DATABASE
    // ==========================================
    
    // 1. Hitung Tiket Aktif (Jumlah tiket dari transaksi yang statusnya 'Lunas')
    $query_tiket = mysqli_query($konek, "SELECT SUM(jumlah_tiket) AS total_tiket FROM transaksi_tiket WHERE email_pembeli='$user_email' AND status_pembayaran='Lunas'");
    $data_tiket = mysqli_fetch_assoc($query_tiket);
    $tiket_aktif = $data_tiket['total_tiket'] ? $data_tiket['total_tiket'] : 0;

    // 2. Hitung Event Diikuti (Berapa banyak ID Event unik yang pernah dibeli dan Lunas)
    $query_event = mysqli_query($konek, "SELECT COUNT(DISTINCT id_event) AS total_event FROM transaksi_tiket WHERE email_pembeli='$user_email' AND status_pembayaran='Lunas'");
    $data_event = mysqli_fetch_assoc($query_event);
    $event_diikuti = $data_event['total_event'] ? $data_event['total_event'] : 0;
    ?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $prefix; ?>assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php if(file_exists('header.php')) { include 'header.php'; } ?>

    <div class="dashboard-wrapper">
        <!-- KOLOM KIRI -->
        <aside class="dash-sidebar">
            <div class="profile-pic-wrapper" title="Ubah Foto Profil">
                <div class="profile-picture"><i class="fas fa-user"></i></div>
                <div class="profile-pic-overlay"><i class="fas fa-camera"></i></div>
            </div>
            
            <h3 class="profile-name"><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
            <span class="profile-status"><i class="fas fa-check-circle"></i> <?php echo $membership_status; ?></span>
            
            <div class="profile-contact-info">
                <div class="info-group">
                    <label>NAMA LENGKAP</label>
                    <p><?php echo htmlspecialchars($user_nama); ?></p>
                </div>
                <div class="info-group">
                    <label>EMAIL</label>
                    <p><?php echo htmlspecialchars($user_email); ?></p>
                </div>
            </div>
        </aside>

        <!-- KOLOM KANAN -->
        <main class="dash-main-content">
            <div class="dash-card welcome-banner">
                <div class="welcome-text">
                    <span class="subtitle">RUANG ANGGOTA</span>
                    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
                    <p>Kelola data profil, tiket, dan pantau riwayat acara Anda di sini.</p>
                </div>
                <a href="<?php echo $prefix; ?>auth/logout.php" class="btn-logout-dash">Keluar Sistem</a>
            </div>

            <div class="reminder-banner">
                <i class="fas fa-bell"></i>
                <span><strong>Jangan lupa!</strong> Konser Irama Cipta Fest tinggal 2 hari lagi. Siapkan tiket Anda!</span>
            </div>

            <!-- Statistik -->
            <div class="stats-grid">
                
                <div class="dash-card stat-item">
                    <span class="stat-label">TIKET AKTIF</span>
                    <!-- Menggunakan variabel $tiket_aktif -->
                    <div class="stat-value"><?php echo $tiket_aktif; ?> <span class="stat-unit">Tiket</span></div>
                    <button onclick="window.location.href='<?php echo $prefix; ?>tiket_saya.php';" class="btn-solid-dash" style="margin-top: 15px;">Lihat E-Tiket</button>
                </div>
                
                <div class="dash-card stat-item">
                    <span class="stat-label">EVENT DIIKUTI</span>
                    <!-- Menggunakan variabel $event_diikuti -->
                    <div class="stat-value"><?php echo $event_diikuti; ?> <span class="stat-unit">Acara</span></div>
                </div>
                
                <div class="dash-card stat-item">
                    <span class="stat-label">POIN LOYALITAS</span>
                    <!-- Untuk poin loyalitas sementara bisa statis atau jika ada kolomnya bisa dipanggil juga -->
                    <div class="stat-value text-accent">150 <span class="stat-unit">Pts</span></div>
                </div>
                
            </div>

            <div class="actions-header">
                <h3>AKSI CEPAT & PENGATURAN</h3>
            </div>
            <div class="actions-grid">
                <div class="dash-card action-card">
                    <h4>Data Diri & Sandi</h4>
                    <p>Perbarui informasi akun, email, atau ganti kata sandi Anda.</p>
                    <!-- Mengarahkan ke halaman edit_profil.php -->
                    <button class="btn-solid-dash" onclick="window.location.href='<?php echo $prefix; ?>edit_profil.php';">Ubah Profil</button>
                </div>
                <div class="dash-card action-card">
                    <h4>Riwayat Transaksi</h4>
                    <p>Lihat daftar pembelian tiket dan invoice dari acara sebelumnya.</p>
                    <button class="btn-solid-dash" onclick="window.location.href='<?php echo $prefix; ?>riwayat_transaksi.php';">Lihat Riwayat</button>
                </div>
                <div class="dash-card action-card">
                    <h4>Katalog Merchandise</h4>
                    <p>Tukarkan akumulasi poin Anda dengan merchandise eksklusif.</p>
                    <button class="btn-solid-dash btn-alt" onclick="window.location.href='<?php echo $prefix; ?>tukar_poin.php';">Tukar Poin</button>
                </div>
            </div>
        </main>
    </div>

</body>
</html>