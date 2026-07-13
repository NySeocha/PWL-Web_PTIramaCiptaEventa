<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Irama Cipta</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h2 style="font-size: 24px; margin-bottom: 5px;">Irama Cipta</h2>
            <p style="font-size: 12px; color: #888;">Admin Panel</p>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="pesan_masuk.php" class="active"><i class="fas fa-envelope"></i> Pesan Masuk</a></li>
            <li><a href="kelola_klien.php"><i class="fas fa-users"></i> Kelola Klien</a></li>
            <li><a href="kelola_event.php"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <!-- <li><a href="kelola_galeri.php"><i class="fas fa-images"></i> Kelola Galeri Acara</a></li> -->
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
            <li><a href="logout.php" style="color: #e74c3c; margin-top: 20px;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>