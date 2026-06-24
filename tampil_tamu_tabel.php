<?php
include ("koneksi.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Komunikasi - PT Irama Cipta Eventa</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px;">
    
    <?php 
    // Memanggil menu navigasi. Pastikan koneksi.php juga dipanggil di sini.
    include("menu.php"); 
    include("koneksi.php");
    ?>

    <h3> Data Formulir Masuk - PT Irama Cipta Eventa </h3>
    
    <table border="1" cellpadding="8" cellspacing="0" style="width: 80%; border-collapse: collapse;">
        <tr>
            <th bgcolor='#2c3e50' style='color:white;'>Nama</th>
            <th bgcolor='#2c3e50' style='color:white;'>Email</th>
            <th bgcolor='#2c3e50' style='color:white;'>Kategori Keperluan</th> <th bgcolor='#2c3e50' style='color:white;'>Pesan</th>
            <th bgcolor='#2c3e50' style='color:white;'>Action</th>
        </tr>
        
        <?php
        $tampil = "select * from buku_tamu order by id_tamu";
        $hasil = mysqli_query($konek, $tampil);
        
        while ($data = mysqli_fetch_array($hasil)) {
            echo "<tr>";
            echo "<td>$data[nama]</td>";
            echo "<td>$data[email]</td>";
            echo "<td style='font-weight: bold; color: #2980b9;'>$data[kategori]</td>"; // Menampilkan Kategori
            echo "<td>$data[pesan]</td>";
            echo "<td>
                    <a href=\"edit_tamu.php?id=$data[id_tamu]\" style='text-decoration:none; color:green;'>Edit</a> | 
                    <a href=\"hapus_tamu.php?id=$data[id_tamu]\" style='text-decoration:none; color:red;' onclick=\"return confirm('Hapus pesan ini?')\">Hapus</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <a href="form_tamu.php" style="text-decoration: none; padding: 8px 12px; background-color: #2c3e50; color: white;">Tambah Pesan/Pengajuan Baru</a>
</body>
</html>