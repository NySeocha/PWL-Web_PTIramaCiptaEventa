<?php
session_start();

// Proteksi Keamanan Baru
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
    echo "<script>alert('Akses ditolak! Anda bukan admin.'); window.location='../auth/login.php';</script>";
    exit;
}

include("../config/koneksi.php");
include("sidebar.php"); 
?>

<div class="main-content">
    <div class="header-top">
        <div>
            <h2><i class="fas fa-inbox"></i> Data Formulir Masuk</h2>
            <p style="color: #666; font-size: 14px; margin-top: 5px;">Kelola seluruh pesan dan penawaran kerja sama dari klien</p>
        </div>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Pengirim</th>
                    <th>Kontak Email</th>
                    <th>Kategori</th>
                    <th style="width: 35%;">Detail Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tampil = "SELECT * FROM buku_tamu ORDER BY id_tamu DESC"; 
                $hasil = mysqli_query($konek, $tampil);
                
                if(mysqli_num_rows($hasil) > 0) {
                    while ($data = mysqli_fetch_array($hasil)) {
                        echo "<tr>";
                        echo "<td><strong>" . htmlspecialchars($data['nama']) . "</strong></td>";
                        echo "<td>" . htmlspecialchars($data['email']) . "</td>";
                        echo "<td><span style='background: #e2e8f0; color: #333; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold;'>" . htmlspecialchars($data['kategori']) . "</span></td>";
                        
                        echo "<td>";
                        echo "<div style='line-height: 1.5; margin-bottom: 8px;'>" . nl2br(htmlspecialchars($data['pesan'])) . "</div>";
                        
                        if (!empty($data['jawaban'])) {
                            echo "<span style='color: #2ecc71; font-size: 12px; font-weight: bold;'><i class='fas fa-check-double'></i> Sudah ditanggapi</span>";
                        } else {
                            echo "<span style='color: #f39c12; font-size: 12px; font-weight: bold;'><i class='fas fa-clock'></i> Menunggu tanggapan</span>";
                        }
                        echo "</td>";

                        echo "<td class='action-links' style='display: flex; gap: 5px; flex-wrap: wrap;'>
                                <a href=\"balas_tamu.php?id=$data[id_tamu]\" class='btn-sm' style='background: #3498db; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none;'><i class='fas fa-reply'></i> Balas</a>
                                <a href=\"edit_tamu.php?id=$data[id_tamu]\" class='btn-sm' style='background: #f39c12; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none;'><i class='fas fa-edit'></i> Edit</a>
                                <a href=\"hapus_tamu.php?id=$data[id_tamu]\" class='btn-sm' style='background: #e74c3c; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none;' onclick=\"return confirm('Apakah Anda yakin ingin menghapus pesan ini secara permanen?')\"><i class='fas fa-trash'></i> Hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center; padding: 30px; color: #888;'>Belum ada data formulir masuk saat ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>