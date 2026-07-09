<?php
session_start();

// Cek apakah pengguna sudah login dan apakah rolenya admin
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    // Jika bukan admin atau belum login, tendang kembali ke halaman login!
    header("location: ../auth/login.php");
    exit(); // Hentikan eksekusi script selanjutnya
}

include("../config/koneksi.php");
include("../templates/header.php");
?>

<div style="margin: 20px;">
    <h3>Data Formulir Masuk - PT Irama Cipta Eventa</h3>
    <table border="1" cellpadding="8" cellspacing="0" style="width: 80%; border-collapse: collapse;">
        <tr>
            <th bgcolor='#2c3e50' style='color:white;'>Nama</th>
            <th bgcolor='#2c3e50' style='color:white;'>Email</th>
            <th bgcolor='#2c3e50' style='color:white;'>Kategori Keperluan</th>
            <th bgcolor='#2c3e50' style='color:white;'>Pesan</th>
            <th bgcolor='#2c3e50' style='color:white;'>Action</th>
        </tr>
        <?php
        $tampil = "select * from buku_tamu order by id_tamu";
        $hasil = mysqli_query($konek, $tampil);
        while ($data = mysqli_fetch_array($hasil)) {
            echo "<tr>";
            echo "<td>$data[nama]</td>";
            echo "<td>$data[email]</td>";
            echo "<td style='font-weight: bold; color: #2980b9;'>$data[kategori]</td>";
            echo "<td>$data[pesan]</td>";
            echo "<td>
                    <a href=\"edit_tamu.php?id=$data[id_tamu]\" style='color:green;'>Edit</a> | 
                    <a href=\"hapus_tamu.php?id=$data[id_tamu]\" style='color:red;' onclick=\"return confirm('Hapus pesan ini?')\">Hapus</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
</body>
</html>