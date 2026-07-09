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
            // PERBAIKAN DI SINI: Mengarah ke nama file yang benar
            header("location: ../admin/tampil_tamu_tabel.php"); 
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
</head>
<body style="font-family: Arial, sans-serif; background-color: #ecf0f1; text-align: center; padding-top: 100px;">
    <div style="background: white; width: 300px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2>Login Sistem</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required style="width: 90%; padding: 10px; margin-bottom: 15px;"><br>
            <input type="password" name="password" placeholder="Password" required style="width: 90%; padding: 10px; margin-bottom: 15px;"><br>
            <button type="submit" name="login" style="width: 95%; padding: 10px; background-color: #2c3e50; color: white; border: none; cursor: pointer;">Masuk</button>
        </form>
    </div>
</body>
</html>