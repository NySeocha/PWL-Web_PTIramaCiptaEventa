<?php 
// Memanggil header
include("templates/header.php"); 
?>

<!-- Banner Atas -->
<section class="hero-events" style="height: 45vh; background: linear-gradient(to bottom, rgba(10,10,10,0.6), #0a0a0a), url('assets/images/latar.jpg') no-repeat center center/cover;">
    <div class="hero-content">
        <h1>Past Events</h1>
        <p>Momen-momen spektakuler dan tak terlupakan yang telah sukses kami selenggarakan.</p>
    </div>
</section>

<!-- KATEGORI 1: PAST CONCERTS -->
<section class="event-category-section">
    <div class="category-header">
        <h2><i class="fas fa-history"></i> Memorable Concerts</h2>
        <p>Galeri portofolio tata panggung dan manajemen konser yang telah menjadi sejarah.</p>
    </div>
    
    <div class="event-grid">
        
        <!-- Past Event 1 -->
        <div class="event-card">
            <!-- Tambahan filter grayscale agar foto terlihat bergaya memori/past event -->
            <div class="event-img" style="background-image: url('assets/images/peg1.jpg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>Stray Kids: DominATE in Jakarta</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 21 Desember 2024</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i>Indonesia Arena, Jakarta</p>
                <a href="past_eg1.php" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

        <!-- Past Event 2 -->
        <div class="event-card">
            <div class="event-img" style="background-image: url('assets/images/peg5.jpeg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>ITZY Checkmate World Tour</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 10 Januari 2025</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> ICE BSD, Tangerang</p>
                <a href="past_eg2.php" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

        <!-- Past Event 1 -->
        <div class="event-card">
            <!-- Tambahan filter grayscale agar foto terlihat bergaya memori/past event -->
            <div class="event-img" style="background-image: url('assets/images/peg9.jpeg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>Seventeen Right Here World Tour in Jakarta</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 10 Maret 2025</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> Jakarta International Stadium, Jakarta</p>
                <a href="past_eg3.php" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

        <!-- Past Event 2 -->
        <div class="event-card">
            <div class="event-img" style="background-image: url('assets/images/latar.jpg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>Stray Kids - Special Fanmeeting & Photoism</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 10 April 2026</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> ICE BSD, Tangerang</p>
                <a href="#" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

        <!-- Past Event 1 -->
        <div class="event-card">
            <!-- Tambahan filter grayscale agar foto terlihat bergaya memori/past event -->
            <div class="event-img" style="background-image: url('assets/images/latar.jpg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>K-Pop World Tour: SEOUL TO JAKARTA</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 24 Juni 2026</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> GBK Senayan, Jakarta</p>
                <a href="past_events_gallery1.php" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

        <!-- Past Event 2 -->
        <div class="event-card">
            <div class="event-img" style="background-image: url('assets/images/latar.jpg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>Stray Kids - Special Fanmeeting & Photoism</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 10 April 2026</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> ICE BSD, Tangerang</p>
                <a href="#" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

    </div>
</section>

<!-- KATEGORI 2: PAST FESTIVAL & BAZAAR -->
<section class="event-category-section" style="border-bottom: none;">
    <div class="category-header">
        <h2><i class="fas fa-store-alt"></i> Past Festival & Bazaar</h2>
        <p>Pekan raya, eksibisi, dan festival kuliner yang telah sukses mendatangkan ribuan pengunjung.</p>
    </div>
    
    <div class="event-grid">
        
        <!-- Past Festival 1 -->
        <div class="event-card">
            <div class="event-img" style="background-image: url('assets/images/latar.jpg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>Bazaar Kewirausahaan: Go-Katsu Launch</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 15 November 2025</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> Kampus UNINDRA, Jakarta</p>
                <a href="#" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

        <!-- Past Festival 2 -->
        <div class="event-card">
            <div class="event-img" style="background-image: url('assets/images/latar.jpg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>Kuantumika FinTech Expo</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 20 Oktober 2025</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> JCC Senayan, Jakarta</p>
                <a href="#" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

         <!-- Past Festival 1 -->
        <div class="event-card">
            <div class="event-img" style="background-image: url('assets/images/latar.jpg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>Bazaar Kewirausahaan: Go-Katsu Launch</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 15 November 2025</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> Kampus UNINDRA, Jakarta</p>
                <a href="#" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

    </div>
</section>


</body>
</html>