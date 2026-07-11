<?php 
// Panggil header yang sudah pintar dan otomatis mendeteksi path
include("templates/header.php"); 
// Panggil koneksi database
include("config/koneksi.php"); 
?>

<!-- Banner Atas -->
<section class="hero-about" style="height: 40vh;">
    <div class="hero-content">
        <h1>Public Q&A</h1>
    </div>
</section>

<!-- Area Daftar Pertanyaan & Tanggapan -->
<section class="qna-section">
    <div class="qna-header">
        <h2>Tanggapan Promotor</h2>
        <p>Transparansi adalah kunci kami. Berikut adalah tanggapan dari tim Irama Cipta Eventa atas pertanyaan dan ide kolaborasi terpilih dari pengunjung.</p>
    </div>

    <?php
    // Logika Pintar: Hanya ambil data yang kolom 'jawaban'-nya sudah diisi oleh admin, urutkan dari yang terbaru
    $query = "SELECT * FROM buku_tamu WHERE jawaban IS NOT NULL AND jawaban != '' ORDER BY id_tamu DESC";
    $hasil = mysqli_query($konek, $query);

    // Cek apakah ada data yang sudah dibalas
    if(mysqli_num_rows($hasil) > 0) {
        while($data = mysqli_fetch_array($hasil)) {
    ?>
            <div class="qna-card">
                <!-- Bagian Pertanyaan User -->
                <div class="qna-question">
                    <div class="qna-question-meta">
                        <span><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($data['nama']); ?></span>
                        <span class="qna-badge"><?php echo htmlspecialchars($data['kategori']); ?></span>
                    </div>
                    <div class="qna-question-text">
                        "<?php echo nl2br(htmlspecialchars($data['pesan'])); ?>"
                    </div>
                </div>
                
                <!-- Bagian Jawaban Admin -->
                <div class="qna-answer">
                    <div class="qna-answer-meta">
                        <i class="fas fa-check-circle"></i> Tim Irama Cipta Menjawab:
                    </div>
                    <div class="qna-answer-text">
                        <?php echo nl2br(htmlspecialchars($data['jawaban'])); ?>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        // Jika belum ada satupun pesan yang dibalas admin
        echo "<div style='text-align:center; padding: 40px; background: #f8fafc; border-radius: 12px; color: #64748b;'>Belum ada diskusi publik saat ini. Jadilah yang pertama mengirim pesan!</div>";
    }
    ?>
</section>

<!-- Tombol WhatsApp Mengambang -->
<a href="https://wa.me/6281234567890" class="wa-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<?php include("templates/footer.php"); ?>

</body>
</html>