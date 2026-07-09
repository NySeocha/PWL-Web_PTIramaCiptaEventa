<?php
session_start();
session_destroy(); // Menghapus semua sesi yang aktif
header("location: ../index.php"); // Mengembalikan pengguna ke halaman utama publik
?>