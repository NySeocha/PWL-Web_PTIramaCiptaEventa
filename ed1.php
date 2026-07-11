<?php 
include("templates/header.php"); 
?>

<!-- Banner Header Detail (Lebih kecil dari Home) -->
<section class="hero-events" style="height: 30vh; background: linear-gradient(to bottom, rgba(10,10,10,0.8), #0a0a0a), url('assets/images/latar.jpg') no-repeat center center/cover;">
    <div class="hero-content">
        <h1 style="font-size: 2.5rem; margin-top: 30px;">Event Details</h1>
    </div>
</section>

<!-- Konten Detail Acara -->
<section class="event-detail-container">
    <div class="event-detail-layout">
        
        <!-- Bagian Kiri: Poster Acara -->
        <div class="event-poster-wrapper">
            <img src="assets/images/ed1.jpeg" alt="Poster Stray Kids" class="event-poster">
        </div>

        <!-- Bagian Kanan: Informasi Lengkap -->
        <div class="event-info-wrapper">
            <span class="event-badge" style="position: relative; top: 0; right: 0; display: inline-block; margin-bottom: 15px;">Upcoming</span>
            
            <h2 class="event-title-large">Stray Kids: RUN IT World Tour Jakarta</h2>
            
            <div class="event-meta-box">
                <p><i class="far fa-calendar-alt"></i> <strong>Tanggal:</strong> 1 Agustus 2027</p>
                <p><i class="far fa-clock"></i> <strong>Waktu:</strong> 19:00 WIB - Selesai</p>
                <p><i class="fas fa-map-marker-alt"></i> <strong>Lokasi:</strong> Indonesia Arena, Gelora Bung Karno, Jakarta</p>
            </div>

            <div class="event-description">
                <h3>About The Event</h3>
                <p>Bersiaplah untuk malam yang penuh energi dan rima tajam! Stray Kids: RUN IT World Tour Jakarta tahun ini membawa penampilan spesial dari Stray Kids. Dilengkapi dengan tata panggung spektakuler, pencahayaan imersif, dan *sound system* kelas dunia yang dirancang khusus oleh PT Irama Cipta Eventa.</p>
            </div>

            <div class="ticket-info">
                <h3>Ticket Categories</h3>
                <ul class="ticket-list">
                    <li><span class="ticket-cat vip">VIP Standing</span> <span class="ticket-price">Rp 3.500.000</span></li>
                    <li><span class="ticket-cat cat1">CAT 1 (Seating)</span> <span class="ticket-price">Rp 2.800.000</span></li>
                    <li><span class="ticket-cat cat2">CAT 2 (Seating)</span> <span class="ticket-price">Rp 1.500.000</span></li>
                </ul>
            </div>

            <!-- Tombol Beli / Hubungi -->
            <div class="action-buttons" style="margin-top: 30px;">
                <a href="#" class="btn-pill" style="width: 100%; text-align: center; display: block; font-size: 16px;">Buy Tickets Now</a>
            </div>

        </div>
    </div>
</section>


</body>
</html>