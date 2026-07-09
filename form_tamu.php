<?php include("templates/header.php"); ?>

<section class="hero-contact">
    <div class="hero-content">
        <h1>Connect With Us</h1>
    </div>
</section>

<section class="contact-section">
    <div style="text-align: center; margin-bottom: 40px;">
        <p style="color: #64748b; font-size: 1.1rem; max-width: 450px; margin: 0 auto; line-height: 1.6;">
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
        <textarea name="pesan" rows="5" required placeholder="Tuliskan detail rencana atau pertanyaan Anda di sini..."></textarea>
        
        <input type="submit" name="Submit" value="Kirim Pesan Sekarang">
    </form>
</section>

<a href="https://wa.me/6281234567890" class="wa-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

</body>
</html>