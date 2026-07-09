<?php
session_start();

// Mengecek apakah ada sesi login. Jika tidak ada, tendang kembali ke halaman login!
if ($_SESSION['status'] != "login") {
    header("location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Portal Klien - PT Irama Cipta Eventa</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    
    <div style="background-color: #34495e; color: white; padding: 15px; border-radius: 5px;">
        <h2>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Ini adalah portal khusus klien PT Irama Cipta Eventa.</p>
    </div>

    <div style="margin-top: 20px;">
        <h3>Menu Klien</h3>
        <ul>
            <li><a href="../form_tamu.php">Ajukan Proposal Kerjasama Baru</a></li>
            <li><a href="#">Lihat Status Acara Anda (Segera Hadir)</a></li>
        </ul>
        <br>
        <a href="../auth/logout.php" style="padding: 10px 15px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 4px;">Keluar Sistem</a>
    </div>

</body>
</html>