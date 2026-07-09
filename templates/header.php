<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PT Irama Cipta Eventa</title>
    <link rel="stylesheet" type="text/css" href="/MarenaIntanFaylisa/irama_cipta/assets/css/style.css?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php
// Logika PHP untuk mendeteksi nama file halaman yang sedang aktif
$halaman_aktif = basename($_SERVER['PHP_SELF']);
?>

<!-- Header Transparan -->
<header class="header-transparent">
    <div class="header-logo">
        <img src="/MarenaIntanFaylisa/irama_cipta/assets/images/logo.jpg" alt="Logo Irama Cipta">
    </div>
    
    <nav class="header-nav-links">
        <!-- class="active" akan muncul otomatis jika nama file cocok -->
        <a href="/MarenaIntanFaylisa/irama_cipta/index.php" class="<?php if($halaman_aktif == 'index.php') echo 'active'; ?>">Home</a>
        
        <a href="/MarenaIntanFaylisa/irama_cipta/visi_misi.php" class="<?php if($halaman_aktif == 'visi_misi.php') echo 'active'; ?>">About</a>
        
        <a href="#" class="<?php if($halaman_aktif == 'events.php') echo 'active'; ?>">Events</a>
        
        <a href="/MarenaIntanFaylisa/irama_cipta/form_tamu.php" class="<?php if($halaman_aktif == 'form_tamu.php' || $halaman_aktif == 'input_tamu.php') echo 'active'; ?>">Contact</a>
        
        <a href="/MarenaIntanFaylisa/irama_cipta/auth/login.php" style="color: #1d419d;">Login</a>
    </nav>
</header>