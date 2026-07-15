<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PT Irama Cipta Eventa</title>
    <?php
    // Memastikan session dimulai agar sistem bisa mengecek status login
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // LOGIKA PINTAR: Mendeteksi lokasi folder saat ini
    $folder_sekarang = basename(dirname($_SERVER['PHP_SELF']));
    
    if ($folder_sekarang == 'admin' || $folder_sekarang == 'auth') {
        $prefix = "../";
    } else {
        $prefix = "";
    }
    
    $halaman_aktif = basename($_SERVER['PHP_SELF']);
    ?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $prefix; ?>assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script src="<?php echo $prefix; ?>assets/js/script.js" defer></script>
</head>
<body>

<header class="header-transparent">
    
    <div class="header-logo">
        <a href="<?php echo $prefix; ?>index.php">
            <img src="<?php echo $prefix; ?>assets/images/logoo.png" alt="Logo Irama Cipta">
        </a>
    </div>
    
    <nav class="header-nav-links">
        <a href="<?php echo $prefix; ?>index.php" class="<?php if($halaman_aktif == 'index.php') echo 'active'; ?>">Home</a>
        <a href="<?php echo $prefix; ?>visi_misi.php" class="<?php if($halaman_aktif == 'visi_misi.php') echo 'active'; ?>">About</a>
        <a href="<?php echo $prefix; ?>events.php" class="<?php if($halaman_aktif == 'events.php') echo 'active'; ?>">Upcoming</a>
        <a href="<?php echo $prefix; ?>past_events.php" class="<?php if($halaman_aktif == 'past_events.php') echo 'active'; ?>">Past Events</a>
        <a href="<?php echo $prefix; ?>qna.php" class="<?php if($halaman_aktif == 'qna.php') echo 'active'; ?>">Pusat Informasi</a>
        <a href="<?php echo $prefix; ?>form_tamu.php" class="<?php if($halaman_aktif == 'form_tamu.php') echo 'active'; ?>">Contact</a>
        
        <?php if(isset($_SESSION['user_id'])) { ?>
            
            <div class="user-dropdown">
                <a href="#" class="profile-btn">
                    <i class="fas fa-user-circle" style="font-size: 18px;"></i> 
                    <?php echo htmlspecialchars($_SESSION['username']); ?> 
                    <i class="fas fa-caret-down" style="font-size: 12px;"></i>
                </a>
                <div class="dropdown-content">
                    
                    <?php if($_SESSION['level'] == 'admin') { ?>
                        <a href="<?php echo $prefix; ?>admin/index.php"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a>
                    <?php } else { ?>
                        <a href="<?php echo $prefix; ?>pengaturan_akun.php"><i class="fas fa-user-cog"></i> Akun Saya</a>
                        <a href="<?php echo $prefix; ?>tiket_saya.php"><i class="fas fa-ticket-alt"></i> Tiket Saya</a>
                    <?php } ?>
                    
                    <a href="<?php echo $prefix; ?>auth/logout.php" style="color: #ff3366; border-top: 1px solid #333;">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </div>
            </div>

        <?php } else { ?>
            
            <a href="<?php echo $prefix; ?>register.php" color: white; padding: 6px 18px; border-radius: 20px; font-weight: bold; border: none; margin-left: 10px;">Daftar</a>
            
        <?php } ?>
        
    </nav>
    
</header>