<!DOCTYPE html>
<html>
<head>
    <title>Buku Tamu - PT Irama Cipta Eventa</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <?php 
    require("menu.php"); 
    ?>

    <h3>Buku Tamu</h3>
    <p>Silakan tinggalkan pesan untuk layanan kami pada form di bawah ini:</p>

    <!-- Form HTML sederhana -->
    <form action="" method="POST" style="background-color: #f9f9f9; padding: 20px; width: 300px; border: 1px solid #ddd;">
        <label for="nama">Nama Lengkap:</label><br>
        <input type="text" id="nama" name="nama" required style="width: 100%; margin-bottom: 10px;"><br>
        
        <label for="email">Alamat Email:</label><br>
        <input type="email" id="email" name="email" required style="width: 100%; margin-bottom: 10px;"><br>
        
        <label for="pesan">Pesan / Masukan:</label><br>
        <textarea id="pesan" name="pesan" rows="4" required style="width: 100%; margin-bottom: 10px;"></textarea><br>
        
        <button type="submit" style="padding: 8px 15px; background-color: #2c3e50; color: white; border: none; cursor: pointer;">
            Kirim Buku Tamu
        </button>
    </form>

<?php include("templates/footer.php"); ?>

</body>
</html>