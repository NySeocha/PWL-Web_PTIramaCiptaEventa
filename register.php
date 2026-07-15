<?php
session_start();

// 1. Panggil koneksi sejajar
include("config/koneksi.php");

// 2. Logika proses pendaftaran
if (isset($_POST['daftar'])) {
    $nama     = mysqli_real_escape_string($konek, $_POST['nama']);
    $email    = mysqli_real_escape_string($konek, $_POST['email']);
    $username = mysqli_real_escape_string($konek, $_POST['username']);
    $password = mysqli_real_escape_string($konek, $_POST['password']);
    
    $cek_user = mysqli_query($konek, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah terdaftar! Pilih username lain.');</script>";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        // PERBAIKAN: Kolom 'nama_lengkap' diubah menjadi 'nama' menyesuaikan database
        $query = "INSERT INTO users (nama, email, username, password, level) 
                  VALUES ('$nama', '$email', '$username', '$password_hash', 'user')";
                  
        if (mysqli_query($konek, $query)) {
            echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='auth/login.php';</script>";
        } else {
            echo "<script>alert('Gagal registrasi!');</script>";
        }
    }
}

// 3. PANGGIL HEADER DI SINI
include("templates/header.php"); 
?>

<section class="hero-fullscreen">
    <div class="hero-content">
        <div class="auth-container">
            <div class="auth-box">
                <h2 style="text-align: center; margin-bottom: 20px; color: white;">Buat Akun Baru</h2>
                <form action="" method="POST">
                    <label style="color: #ccc;">Nama Lengkap</label>
                    <input type="text" name="nama" required>
                    
                    <label style="color: #ccc;">Email</label>
                    <input type="email" name="email" required>
                    
                    <label style="color: #ccc;">Username</label>
                    <input type="text" name="username" required>
                    
                    <label style="color: #ccc;">Password</label>
                    <input type="password" name="password" required>
                    
                    <button type="submit" name="daftar">Daftar Sekarang</button>
                </form>
                <p style="text-align: center; margin-top: 20px; font-size: 14px; color: #888;">Sudah punya akun? <a href="auth/login.php">Login di sini</a></p>
            </div>
        </div>
    </div>
</section>
</body>
</html>