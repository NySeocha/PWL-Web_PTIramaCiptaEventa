<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ubah Profil - PT Irama Cipta Eventa</title>
    <?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Proteksi halaman
    if(!isset($_SESSION['user_id'])){
        header("Location: auth/login.php");
        exit();
    }
    
    include("config/koneksi.php"); 

    $user_id = $_SESSION['user_id'];
    $folder_sekarang = basename(dirname($_SERVER['PHP_SELF']));
    $prefix = ($folder_sekarang == 'admin' || $folder_sekarang == 'auth') ? "../" : "";

    // Logika Simpan Perubahan
    if(isset($_POST['simpan_profil'])) {
        $nama_baru  = mysqli_real_escape_string($konek, $_POST['nama']);
        $email_baru = mysqli_real_escape_string($konek, $_POST['email']);

        $query_update = "UPDATE users SET nama='$nama_baru', email='$email_baru' WHERE id_user='$user_id'";
        
        if(mysqli_query($konek, $query_update)) {
            echo "<script>alert('Profil berhasil diperbarui!'); window.location='pengaturan_akun.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui profil!');</script>";
        }
    }

    // Ambil data terbaru untuk ditaruh di dalam input form
    $query_data = mysqli_query($konek, "SELECT * FROM users WHERE id_user='$user_id'");
    $user_data = mysqli_fetch_assoc($query_data);
    $user_nama  = !empty($user_data['nama']) ? $user_data['nama'] : '';
    $user_email = !empty($user_data['email']) ? $user_data['email'] : '';
    ?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $prefix; ?>assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php if(file_exists('header.php')) { include 'header.php'; } ?>

    <!-- Container khusus untuk halaman Edit Profil -->
    <div style="max-width: 600px; margin: 120px auto 50px auto; padding: 20px; font-family: 'Arial', sans-serif;">
        <div class="dash-card">
            
            <form action="" method="POST">
                
                <!-- Container khusus untuk halaman Edit Profil -->
    <div class="edit-profile-container">
        <div class="dash-card edit-profile-card">
            
            <div class="edit-profile-header">
                <h2>Ubah Data Profil</h2>
                <a href="<?php echo $prefix; ?>pengaturan_akun.php" class="btn-cancel"><i class="fas fa-times"></i> Batal</a>
            </div>
            
            <form action="" method="POST">
                
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" disabled class="input-disabled">
                    <small>*Username adalah identitas unik dan tidak dapat diubah.</small>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="<?php echo htmlspecialchars($user_nama); ?>" required class="input-active">
                </div>

                <div class="form-group">
                    <label>Alamat Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user_email); ?>" required class="input-active">
                </div>

                <!-- Tombol sekarang menggunakan class khusus agar berwarna pink -->
                <button type="submit" name="simpan_profil" class="btn-save">Simpan Perubahan</button>
           
            </form>

        </div>
    </div>

</body>
</html>