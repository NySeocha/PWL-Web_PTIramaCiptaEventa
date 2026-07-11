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

        <!-- Past Event 3 -->
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

        <!-- Past Event 4 -->
        <div class="event-card">
            <div class="event-img" style="background-image: url('assets/images/peg13.jpeg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>AESPA Parallelline World Tour</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 15 April 2026</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> Beach City, Pantai Indah Kapuk</p>
                <a href="past_eg4.php" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

        <!-- Past Event 5 -->
        <div class="event-card">
            <!-- Tambahan filter grayscale agar foto terlihat bergaya memori/past event -->
            <div class="event-img" style="background-image: url('assets/images/peg17.jpeg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>Enhypen World Tour Fate+</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 17 Agustus 2024</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> Ice BSD, Tangerang</p>
                <a href="past_eg5.php" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

        <!-- Past Event 6 -->
        <div class="event-card">
            <div class="event-img" style="background-image: url('assets/images/peg21.jpeg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>ATEEZ In Your Fantasy World Tour in Jakarta</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 31 Januari 2026</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> ICE BSD, Tangerang</p>
                <a href="past_eg6.php" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
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
            <div class="event-img" style="background-image: url('assets/images/peg25.jpg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>KOPLING - Koplo Keliling</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 15 November 2024</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> Gambir Expo Kemayoran, Jakarta</p>
                <a href="past_eg7.php" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

        <!-- Past Festival 2 -->
        <div class="event-card">
            <div class="event-img" style="background-image: url('assets/images/peg29.jpg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>PESTAPORA - Indonesia</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 20 Oktober 2025</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> Jiexpo Hall C, Jakarta</p>
                <a href="past_eg8.php" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

         <!-- Past Festival 3 -->
        <div class="event-card">
            <div class="event-img" style="background-image: url('assets/images/peg33.jpeg'); filter: grayscale(40%);"></div>
            <div class="event-info">
                <span class="event-badge selesai">Selesai</span>
                <h3>Jakarta Fair Music Concert</h3>
                <p class="event-detail"><i class="far fa-calendar-alt"></i> 15 November 2026</p>
                <p class="event-detail"><i class="fas fa-map-marker-alt"></i> Jiexpo Kemayoran, Jakarta</p>
                <a href="past_eg9.php" class="btn-event" style="border-color: #666; color: #888;">Lihat Galeri</a>
            </div>
        </div>

    </div>
</section>

<?php include("templates/footer.php"); ?>

</body>
</html>