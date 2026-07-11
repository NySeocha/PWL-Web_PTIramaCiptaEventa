<?php include("templates/header.php"); ?>

<section class="hero-contact">
    <div class="hero-content">
        <h1>Connect With Us</h1>
    </div>
</section>

<section class="contact-section" style="max-width: 1000px; padding: 60px 20px;">
    
    <div class="contact-split-layout">
        
        <div class="contact-image-wrapper">
            <img src="assets/images/latar.jpg" alt="Contact PT Irama Cipta Eventa">
        </div>

        <div class="contact-form-wrapper">
            <div style="margin-bottom: 30px;">
                <h2 style="color: #ffffff; font-size: 1.8rem; text-transform: uppercase; margin-bottom: 10px;">Get In Touch</h2>
                <p style="color: #888888; font-size: 0.95rem; line-height: 1.6;">
                    Punya konsep acara impian atau ajakan kolaborasi seru? Kirimkan pesanmu di bawah ini, tim promotor kami akan segera menghubungimu!
                </p>
            </div>

            <form method="get" action="input_tamu.php" class="contact-card-form">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Masukkan nama Anda...">
                
                <label>Alamat Email</label>
                <input type="email" name="email" required placeholder="nama@email.com">
                
                <label>Kategori Keperluan</label>
                <select name="kategori">
                    <option value="Ajukan Pertanyaan">Ajukan Pertanyaan</option>
                    <option value="Ajukan Kerjasama">Ajukan Kerjasama</option>
                    <option value="Tinggalkan Pesan">Tinggalkan Pesan</option>
                </select>
                
                <label>Pesan / Ide Kreatif</label>
                <textarea name="pesan" rows="4" required placeholder="Tuliskan detail rencana atau pertanyaan Anda di sini..."></textarea>
                
                <input type="submit" name="Submit" value="Kirim Pesan Sekarang">
            </form>
        </div>
        
    </div>
    
</section>

<?php include("templates/footer.php"); ?>

</body>
</html>