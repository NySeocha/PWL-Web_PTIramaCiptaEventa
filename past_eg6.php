<?php 
// Memanggil header
include("templates/header.php"); 
?>

<section class="hero-events" style="height: 30vh; background: linear-gradient(to bottom, rgba(10,10,10,0.8), #0a0a0a), url('assets/images/latar.jpg') no-repeat center center/cover;">
    <div class="hero-content">
        <h1 style="font-size: 2.5rem; margin-top: 30px;">Past Event Gallery</h1>
    </div>
</section>

<section class="event-detail-container">
    
    <div class="event-detail-layout" style="margin-bottom: 50px;">
        
        <div class="event-poster-wrapper">
            <img src="assets/images/peg21.jpeg" alt="Poster Acara" class="event-poster" style="filter: grayscale(20%);">
        </div>

        <div class="event-info-wrapper">
            <span class="event-badge selesai" style="position: relative; top: 0; right: 0; display: inline-block; margin-bottom: 15px; background: #333; color: #888;">Post-Event</span>
            
            <h2 class="event-title-large">ATEEZ In Your Fantasy World Tour in Jakarta</h2>
            
            <div class="event-meta-box" style="border-left-color: #666;">
                <p><i class="far fa-calendar-alt" style="color: #666;"></i> <strong>Tanggal:</strong> 10 April 2026</p>
                <p><i class="fas fa-map-marker-alt" style="color: #666;"></i> <strong>Lokasi:</strong> ICE BSD, Tangerang</p>
            </div>

            <div class="event-description">
                <h3 style="border-bottom-color: #333; color: #ccc;">Event Recap</h3>
                <p>Konser spektakuler ini sukses mengguncang Beach City dan menghadirkan pengalaman tak terlupakan bagi ribuan penonton yang memadati lokasi acara. Tim PT Irama Cipta Eventa dengan bangga memastikan seluruh rangkaian konser berjalan lancar, mulai dari tata panggung yang megah, sistem pencahayaan dan tata suara yang memukau, hingga pengelolaan alur masuk dan keluar penonton yang tertib. Setiap detail dipersiapkan secara maksimal demi menghadirkan pertunjukan yang aman, nyaman, dan berkesan dari awal hingga penampilan penutup.
</p>
            </div>
        </div>
    </div>

    <div style="background: #141414; padding: 40px; border-radius: 8px; border: 1px solid #222; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
        
        <h3 class="gallery-title" style="text-align: left; border-bottom: 1px solid #333; padding-bottom: 15px; margin-bottom: 30px;">
            <i class="fas fa-camera-retro" style="color: #666; margin-right: 10px;"></i> Event Documentation
        </h3>
        
        <div class="gallery-grid">
            <div class="gallery-item"><img src="assets/images/peg21.jpeg" alt="Keseruan Acara 1"></div>
            <div class="gallery-item"><img src="assets/images/peg22.jpg" alt="Keseruan Acara 2"></div>
            <div class="gallery-item"><img src="assets/images/peg23.jpeg" alt="Keseruan Acara 3"></div>
        </div>
    </div>

</section>


</body>
</html>