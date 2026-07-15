<?php
session_start();
session_unset();  // Mengosongkan data session
session_destroy(); // Menghancurkan session sepenuhnya

echo "<script>alert('Anda telah berhasil keluar dari sistem.'); window.location='login.php';</script>";
?>