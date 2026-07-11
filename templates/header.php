<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PT Irama Cipta Eventa</title>
    <?php
    // LOGIKA PINTAR: Mendeteksi lokasi folder saat ini
    $folder_sekarang = basename(dirname($_SERVER['PHP_SELF']));
    
    if ($folder_sekarang == 'admin' || $folder_sekarang == 'auth') {
        $prefix = "../";
    } else {
        $prefix = "";
    }
    
    $halaman_aktif = basename($_SERVER['PHP_SELF']);
    ?>
    
    <!-- Panggilan CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $prefix; ?>assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Panggilan JavaScript (File Terpisah) -->
    <script src="<?php echo $prefix; ?>assets/js/script.js" defer></script>
</head>
<body>

<header class="header-transparent">
    <div class="header-logo">
        <img src="<?php echo $prefix; ?>assets/images/logoo.png" alt="Logo Irama Cipta">
    </div>
    
    <nav class="header-nav-links">
        <a href="<?php echo $prefix; ?>index.php" class="<?php if($halaman_aktif == 'index.php') echo 'active'; ?>">Home</a>
        <a href="<?php echo $prefix; ?>visi_misi.php" class="<?php if($halaman_aktif == 'visi_misi.php') echo 'active'; ?>">About</a>
        
        <!-- Menu Upcoming Events -->
        <a href="<?php echo $prefix; ?>events.php" class="<?php if($halaman_aktif == 'events.php') echo 'active'; ?>">Upcoming</a>
        
        <!-- Menu Tambahan Past Events -->
        <a href="<?php echo $prefix; ?>past_events.php" class="<?php if($halaman_aktif == 'past_events.php') echo 'active'; ?>">Past Events</a>
        
        <a href="<?php echo $prefix; ?>qna.php" class="<?php if($halaman_aktif == 'qna.php') echo 'active'; ?>">Pusat Informasi</a>
        <a href="<?php echo $prefix; ?>form_tamu.php" class="<?php if($halaman_aktif == 'form_tamu.php') echo 'active'; ?>">Contact</a>
        <a href="<?php echo $prefix; ?>auth/login.php" style="color: #ff3366;">Login</a>
    </nav>
</header>