<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tukar Poin - PT Irama Cipta Eventa</title>
    <?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Proteksi halaman
    if(!isset($_SESSION['user_id'])){
        header("Location: auth/login.php");
        exit();
    }
    
    $folder_sekarang = basename(dirname($_SERVER['PHP_SELF']));
    $prefix = ($folder_sekarang == 'admin' || $folder_sekarang == 'auth') ? "../" : "";
    
    // Dummy Data Poin (Anda bisa mengambil ini dari database nanti jika ada)
    $poin_user = 150;
    ?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $prefix; ?>assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php if(file_exists('header.php')) { include 'header.php'; } ?>

    <div class="katalog-container">
        <div class="dash-card katalog-wrapper">
            
            <div class="riwayat-header">
                <a href="<?php echo $prefix; ?>pengaturan_akun.php" class="btn-back-riwayat"><i class="fas fa-arrow-left"></i> Kembali</a>
                <h2>Katalog Merchandise</h2>
            </div>

            <!-- Info Poin User -->
            <div class="poin-banner">
                <p>Poin Loyalitas Anda saat ini:</p>
                <h3><?php echo $poin_user; ?> <span>Pts</span></h3>
            </div>

            <!-- Daftar Merchandise -->
            <div class="katalog-grid">
                
                <!-- Item 1 -->
                <div class="merch-card">
                    <div class="merch-icon"><i class="fas fa-tshirt"></i></div>
                    <h4>T-Shirt Irama Fest</h4>
                    <p class="merch-desc">Kaos katun eksklusif edisi Irama Cipta Fest 2026.</p>
                    <div class="merch-pts">100 Pts</div>
                    <button class="btn-tukar" onclick="tukarBarang('T-Shirt Irama Fest', 100)">Tukar Poin</button>
                </div>

                <!-- Item 2 -->
                <div class="merch-card">
                    <div class="merch-icon"><i class="fas fa-mug-hot"></i></div>
                    <h4>Mug Signature</h4>
                    <p class="merch-desc">Gelas keramik tebal dengan logo artis favoritmu.</p>
                    <div class="merch-pts">50 Pts</div>
                    <button class="btn-tukar" onclick="tukarBarang('Mug Signature', 50)">Tukar Poin</button>
                </div>

                <!-- Item 3 -->
                <div class="merch-card">
                    <div class="merch-icon"><i class="fas fa-ticket-alt"></i></div>
                    <p class="merch-badge">Habis</p>
                    <h4 style="color: #666;">Voucher Diskon 20%</h4>
                    <p class="merch-desc">Potongan harga untuk pembelian tiket selanjutnya.</p>
                    <div class="merch-pts" style="color: #666;">200 Pts</div>
                    <button class="btn-tukar btn-disabled" disabled>Poin Tidak Cukup</button>
                </div>

            </div>

        </div>
    </div>

    <!-- Script Simulasi Tukar Poin -->
    <script>
        function tukarBarang(namaBarang, hargaPoin) {
            let poinSekarang = <?php echo $poin_user; ?>;
            
            if(poinSekarang >= hargaPoin) {
                let konfirmasi = confirm(`Apakah Anda yakin ingin menukarkan ${hargaPoin} Pts untuk ${namaBarang}?`);
                if(konfirmasi) {
                    alert(`🎉 Berhasil! Anda telah menukarkan ${namaBarang}. Silakan cek email Anda untuk detail pengiriman.`);
                    // Di sini nanti Anda bisa mengarahkan ke file proses PHP jika sudah menggunakan database
                }
            } else {
                alert(`Maaf, Poin Anda tidak mencukupi untuk menukarkan ${namaBarang}.`);
            }
        }
    </script>

</body>
</html>