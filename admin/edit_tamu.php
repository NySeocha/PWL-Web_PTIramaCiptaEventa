<?php
include("../config/koneksi.php");
include("../templates/header.php");
$id = $_GET['id'];
$edit = "select * from buku_tamu where id_tamu = '$id'";
$hasil = mysqli_query($konek, $edit);
$data = mysqli_fetch_array($hasil);
?>
<div style="margin: 20px;">
    <h3> Edit Formulir Masuk </h3>
    <form method="GET" action="update_tamu.php" style="background-color: #f9f9f9; padding: 20px; width: 350px; border: 1px solid #ddd;">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>" style="width: 100%; margin-bottom: 15px;"><br>
        <label>Alamat Email:</label><br>
        <input type="text" name="email" value="<?php echo $data['email']; ?>" style="width: 100%; margin-bottom: 15px;"><br>
        <label>Kategori Keperluan:</label><br>
        <select name="kategori" style="width: 104%; padding: 5px; margin-bottom: 15px;">
            <option value="Ajukan Pertanyaan" <?php if($data['kategori'] == 'Ajukan Pertanyaan') echo 'selected'; ?>>Ajukan Pertanyaan</option>
            <option value="Ajukan Kerjasama" <?php if($data['kategori'] == 'Ajukan Kerjasama') echo 'selected'; ?>>Ajukan Kerjasama</option>
            <option value="Tinggalkan Pesan" <?php if($data['kategori'] == 'Tinggalkan Pesan') echo 'selected'; ?>>Tinggalkan Pesan</option>
        </select><br>
        <label>Pesan / Masukan:</label><br>
        <textarea name="pesan" rows="5" style="width: 100%; margin-bottom: 15px;"><?php echo $data['pesan']; ?></textarea><br>
        <input type="submit" value="Simpan Perubahan" style="padding: 8px 15px; background-color: #2c3e50; color: white; border: none; cursor: pointer;">
    </form>
</div>
</body>
</html>