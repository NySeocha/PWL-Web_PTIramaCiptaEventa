<?php
// 1. KONEKSI & LOGIKA PHP
include("../config/koneksi.php");

if (isset($_POST['upload_galeri'])) {
    $id_event = $_POST['id_event'];
    $jumlah_file = count($_FILES['foto_kegiatan']['name']);
    $foto_berhasil = 0;

    for ($i = 0; $i < $jumlah_file; $i++) {
        $nama_file = $_FILES['foto_kegiatan']['name'][$i];
        $tmp_name  = $_FILES['foto_kegiatan']['tmp_name'][$i];
        
        if ($nama_file != "") {
            $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
            $nama_baru = "galeri_" . $id_event . "_" . time() . "_" . $i . "." . $ext;
            $path = "../assets/uploads/" . $nama_baru;
            
            if (move_uploaded_file($tmp_name, $path)) {
                mysqli_query($konek, "INSERT INTO galeri_event (id_event, nama_foto) VALUES ('$id_event', '$nama_baru')");
                $foto_berhasil++;
            }
        }
    }
    echo "<script>
        alert('Berhasil mengunggah $foto_berhasil foto dokumentasi!'); 
        window.location = window.location.href;
      </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Klien - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin_style.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Irama Cipta</h3>
            <p style="font-size: 12px; color: #888; margin-top: 5px;">Admin Panel</p>
        </div>
        <ul class="sidebar-menu">
            <li><a href="admin_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="tampil_tamu_tabel.php"><i class="fas fa-envelope"></i> Pesan Masuk</a></li>
            <li><a href="kelola_klien.php" ><i class="fas fa-users"></i> Kelola Klien</a></li>
            <li><a href="kelola_event.php"><i class="fas fa-calendar-alt"></i> Kelola Event</a></li>
            <li><a href="kelola_galeri.php" class="active"><i class="fas fa-images"></i> Kelola Galeri Acara</a></li>
            <li><a href="kelola_transaksi.php"><i class="fas fa-ticket-alt"></i> Penjualan Tiket</a></li>
            <li><a href="../auth/logout.php" style="color: #e74c3c;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content" style="padding: 30px; width: 100%;">
    <div style="margin-bottom: 30px;">
            <h2 style="font-family: 'Arial', sans-serif; font-weight: 800; color: #111;">Kelola Galeri Acara</h2>
            <p style="color: #666;">Upload dokumentasi untuk acara yang sudah selesai agar tampil di halaman pengunjung.</p>
        </div>

        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid #3b5998; max-width: 800px;">
            
            <form action="" method="POST" enctype="multipart/form-data">
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 10px; color: #333;">Pilih Acara Selesai:</label>
                    <select name="id_event" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; background: #f8f9fa;">
                        <?php
                        // Logika Dinamis: Mengambil nama acara dari database
                        $query_event = mysqli_query($konek, "SELECT id_event, nama_event FROM jadwal_event ORDER BY id_event DESC");
                        while($row_event = mysqli_fetch_array($query_event)){
                            echo "<option value='" . $row_event['id_event'] . "'>" . htmlspecialchars($row_event['nama_event']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 10px; color: #333;">Pilih Foto Dokumentasi:</label>
                    <div style="border: 2px dashed #ccc; padding: 25px; border-radius: 4px; text-align: center; background: #f8f9fa;">
                        <input type="file" name="foto_kegiatan[]" accept="image/*" multiple required style="width: 100%; cursor: pointer;">
                        <small style="color: #f39c12; display: block; margin-top: 15px; font-weight: bold;">
                            <i class="fas fa-info-circle"></i> Tahan tombol CTRL di keyboard untuk memilih banyak foto sekaligus.
                        </small>
                    </div>
                </div>

                <button type="submit" name="upload_galeri" style="background: #3b5998; color: white; border: none; padding: 12px 25px; font-weight: bold; border-radius: 4px; cursor: pointer; transition: 0.3s;">
                    Upload ke Galeri
                </button>
                
            </form>
        </div>

    </div>
</body>
</html>