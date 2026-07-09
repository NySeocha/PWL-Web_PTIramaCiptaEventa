<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PT Irama Cipta Eventa</title>
    <?php
    // LOGIKA PINTAR: Mendeteksi lokasi folder saat ini
    $folder_sekarang = basename(dirname($_SERVER['PHP_SELF']));
    
    // Jika file dibuka dari dalam folder admin atau auth, tambahkan prefix '../' untuk mundur
    if ($folder_sekarang == 'admin' || $folder_sekarang == 'auth') {
        $prefix = "../";
    } else {
        $prefix = "";
    }
    
    $halaman_aktif = basename($_SERVER['PHP_SELF']);
    ?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $prefix; ?>assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header class="header-transparent">
    <div class="header-logo">
        <img src="<?php echo $prefix; ?>assets/images/logo.png" alt="Logo Irama Cipta">
    </div>
    
    <nav class="header-nav-links">
        <a href="<?php echo $prefix; ?>index.php" class="<?php if($halaman_aktif == 'index.php') echo 'active'; ?>">Home</a>
        <a href="<?php echo $prefix; ?>visi_misi.php" class="<?php if($halaman_aktif == 'visi_misi.php') echo 'active'; ?>">About</a>
        <a href="<?php echo $prefix; ?>events.php" class="<?php if($halaman_aktif == 'events.php') echo 'active'; ?>">Events</a>
        <a href="<?php echo $prefix; ?>qna.php" class="<?php if($halaman_aktif == 'qna.php') echo 'active'; ?>">Pusat Informasi</a>
        <a href="<?php echo $prefix; ?>form_tamu.php" class="<?php if($halaman_aktif == 'form_tamu.php') echo 'active'; ?>">Contact</a>
        <a href="<?php echo $prefix; ?>auth/login.php" style="color: #1d419d;">Login</a>
    </nav>
</header>