<?php
session_start();
include("../config/koneksi.php"); // Memanggil koneksi database

// Jika tombol login ditekan
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek kecocokan data di database
    $cek = mysqli_query($konek, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($cek) > 0) {
        $data = mysqli_fetch_array($cek);
        
        // Menyimpan sesi
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['status'] = "login";
        
        // Arahkan ke halaman berdasarkan role
        if ($data['role'] == 'admin') {
            // UBAH BARIS INI: Mengarah ke beranda admin yang baru
            header("location: ../admin/admin_dashboard.php"); 
        } else {
            header("location: ../user/user_home.php");
        }
    } else {
        echo "<script>alert('Username atau Password salah!'); window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - PT Irama Cipta Eventa</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body class="login-body">
    
    <a href="../index.php" class="back-home-btn"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>

    <div class="login-container">
        <div class="login-header">
            <img src="../assets/images/logoo.png" alt="Logo Irama Cipta" class="login-logo">
            <h2>System Login</h2>
            <p>Silakan masuk untuk mengelola portal PT Irama Cipta Eventa.</p>
        </div>
        
        <form method="POST" action="" class="login-form">
            <div class="input-group">
                <label>Username</label>
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Masukkan username..." required>
                </div>
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Masukkan password..." required>
                </div>
            </div>
            
            <button type="submit" name="login" class="btn-login">Masuk Sekarang</button>
        </form>
    </div>

</body>
</html>