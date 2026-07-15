<?php
session_start();

// Mencegah akses jika sudah login
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['level'] == 'admin') {
        header("location: ../admin/index.php");
    } else {
        header("location: ../index.php");
    }
    exit;
}

// 1. Panggil koneksi dari luar folder
include("../config/koneksi.php");

// 2. Logika proses login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($konek, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($konek, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if ($data && (password_verify($password, $data['password']) || $password == $data['password'])) {
        
        $_SESSION['user_id']   = $data['id_user'];
        $_SESSION['username']  = $data['username'];
        $_SESSION['nama']      = $data['nama_lengkap'];
        $_SESSION['level']     = $data['level'];

        if ($data['level'] == 'admin') {
            echo "<script>alert('Selamat datang, Admin!'); window.location='../admin/index.php';</script>";
        } else {
            echo "<script>alert('Login berhasil!'); window.location='../index.php';</script>";
        }
    } else {
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}

// 3. PANGGIL HEADER DI SINI
include("../templates/header.php"); 
?>
<section class="hero-fullscreen">
    <div class="hero-content">
        <div class="auth-container">
            <div class="auth-box">
                <h2 style="text-align: center; margin-bottom: 20px; color: white;">Login</h2>
                <form action="" method="POST">
                    <label style="color: #ccc;">Username</label>
                    <input type="text" name="username" required>
                    
                    <label style="color: #ccc;">Password</label>
                    <input type="password" name="password" required>
                    
                    <button type="submit" name="login">Masuk</button>
                </form>
                <p style="text-align: center; margin-top: 20px; font-size: 14px; color: #888;">Belum punya akun? <a href="../register.php">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</section>
</body>
</html>