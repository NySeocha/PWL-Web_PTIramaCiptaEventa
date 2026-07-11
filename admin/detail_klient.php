<?php
session_start();
include("../config/koneksi.php");

$id = $_GET['id'];
$query = mysqli_query($konek, "SELECT * FROM klien WHERE id_klien='$id'");
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Klien - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body style="font-family: 'Montserrat', sans-serif; background-color: #f4f7f6; margin: 0; display: flex;">
    
    <div class="main-content" style="padding: 40px; margin-left: 250px; width: 100%;">
        <a href="kelola_klien.php" style="display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; font-weight: 600;"><i class="fas fa-arrow-left"></i> Kembali</a>
        
        <div style="background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); max-width: 700px; border-top: 5px solid #1d419d;">
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
                <div style="font-size: 50px; color: #1d419d;"><i class="fas fa-building"></i></div>
                <div>
                    <h2 style="margin: 0; color: #111;"><?php echo $data['nama_klien']; ?></h2>
                    <span style="background: #e2e8f0; color: #1d419d; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; margin-top: 5px; display: inline-block;"><?php echo $data['jenis_kerjasama']; ?></span>
                </div>
            </div>
            
            <p style="font-size: 14px; color: #666; margin-bottom: 10px;"><strong>Kontak Utama:</strong> <?php echo $data['kontak']; ?></p>
            <p style="font-size: 14px; color: #666; margin-bottom: 10px;"><strong>ID Klien di Sistem:</strong> #<?php echo $data['id_klien']; ?></p>
            
            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px dashed #ddd;">
                <a href="edit_klien.php?id=<?php echo $data['id_klien']; ?>" style="background: #2ecc71; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-size: 13px; font-weight: bold;"><i class="fas fa-edit"></i> Edit Data Ini</a>
            </div>
        </div>
    </div>
</body>
</html>