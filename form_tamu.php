<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hubungi Kami - PT Irama Cipta Eventa</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px;">
    
    <?php 
    // Memanggil menu navigasi
    include("menu.php"); 
    ?>

    <h3>Form Hubungi PT Irama Cipta Eventa</h3>
    
    <form method="get" action="input_tamu.php" style="background-color: #f9f9f9; padding: 20px; width: 350px; border: 1px solid #ddd;">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" required style="width: 100%; margin-bottom: 15px;"><br>
        
        <label>Alamat Email:</label><br>
        <input type="email" name="email" required style="width: 100%; margin-bottom: 15px;"><br>
        
        <label>Keperluan / Kategori:</label><br>
        <select name="kategori" style="width: 104%; padding: 5px; margin-bottom: 15px;">
            <option value="Ajukan Pertanyaan">Ajukan Pertanyaan</option>
            <option value="Ajukan Kerjasama">Ajukan Kerjasama</option>
            <option value="Tinggalkan Pesan">Tinggalkan Pesan</option>
        </select><br>
        
        <label>Pesan / Masukan:</label><br>
        <textarea name="pesan" rows="5" required style="width: 100%; margin-bottom: 15px;"></textarea><br>
        
        <input type="submit" name="Submit" value="Kirim Komunikasi" style="padding: 8px 15px; background-color: #2c3e50; color: white; border: none; cursor: pointer;">
    </form>
</body>
</html>