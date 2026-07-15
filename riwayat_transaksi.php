<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi - PT Irama Cipta Eventa</title>
    <?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Proteksi halaman
    if(!isset($_SESSION['user_id'])){
        header("Location: auth/login.php");
        exit();
    }
    
    // Panggil koneksi database
    include("config/koneksi.php");
    
    $user_id = $_SESSION['user_id'];
    $folder_sekarang = basename(dirname($_SERVER['PHP_SELF']));
    $prefix = ($folder_sekarang == 'admin' || $folder_sekarang == 'auth') ? "../" : "";
    
    // 1. AMBIL EMAIL USER YANG SEDANG LOGIN
    $query_user = mysqli_query($konek, "SELECT email FROM users WHERE id_user='$user_id'");
    $data_user = mysqli_fetch_assoc($query_user);
    $email_user = $data_user['email'];

    // 2. QUERY TRANSAKSI BERDASARKAN EMAIL PEMBELI
    // Catatan: Saya menggunakan LEFT JOIN ke tabel 'event' untuk mengambil 'nama_event'. 
    // Jika nama tabel event Anda berbeda (misal: 'events' atau 'tb_event'), silakan ubah kata 'event' setelah LEFT JOIN.
    $query_trx = mysqli_query($konek, "
        SELECT t.*, e.nama_event 
        FROM transaksi_tiket t 
        LEFT JOIN jadwal_event e ON t.id_event = e.id_event 
        WHERE t.email_pembeli = '$email_user' 
        ORDER BY t.tanggal_transaksi DESC
    ");
    ?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $prefix; ?>assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php if(file_exists('header.php')) { include 'header.php'; } ?>

    <div class="riwayat-container">
        <div class="dash-card riwayat-card">
            
            <div class="riwayat-header">
                <a href="<?php echo $prefix; ?>pengaturan_akun.php" class="btn-back-riwayat"><i class="fas fa-arrow-left"></i> Kembali</a>
                <h2>Riwayat Transaksi</h2>
            </div>

            <div class="riwayat-list">
                
                <?php
                // Mengecek apakah ada data transaksi untuk email ini
                if(mysqli_num_rows($query_trx) > 0) {
                    
                    while($row = mysqli_fetch_assoc($query_trx)) {
                        
                        // Format Tanggal
                        $tanggal = date('d F Y • H:i', strtotime($row['tanggal_transaksi']));
                        
                        // Format Harga dari kolom 'total_bayar'
                        $harga = number_format($row['total_bayar'], 0, ',', '.');
                        
                        // Jika nama event kosong/tidak ditemukan di tabel event, tampilkan fallback
                        $nama_event = !empty($row['nama_event']) ? $row['nama_event'] : "Event ID: " . $row['id_event'];
                        
                        // Menentukan Status dan Tampilan berdasarkan database Anda
                        $status_db = strtolower($row['status_pembayaran']);
                        $badge_class = '';
                        $badge_text = '';
                        $btn_html = '';
                        
                        if($status_db == 'lunas') {
                            $badge_class = 'status-success';
                            $badge_text  = 'Lunas';
                            // PERBAIKAN: Menambahkan link yang membawa parameter id_transaksi
                            $btn_html    = '<button class="btn-invoice" onclick="window.location.href=\''.$prefix.'tiket_saya.php?id='.$row['id_transaksi'].'\'">Lihat E-Tiket</button>';
                        } elseif ($status_db == 'menunggu validasi') {
                            $badge_class = 'status-pending';
                            $badge_text  = 'Menunggu Validasi';
                            // Karena sudah upload bukti bayar, tombol diarahkan untuk sekadar cek
                            $btn_html    = '<button class="btn-invoice" style="border-color:#f39c12; color:#f39c12;">Cek Status</button>';
                        } else {
                            $badge_class = 'status-failed';
                            $badge_text  = ucfirst($row['status_pembayaran']);
                        }
                ?>
                
                <div class="transaction-item">
                    <div class="trx-info">
                        <span class="trx-date"><?php echo $tanggal; ?> | <?php echo htmlspecialchars($row['kode_booking']); ?></span>
                        <h3><?php echo htmlspecialchars($nama_event); ?></h3>
                        <p><?php echo htmlspecialchars($row['jumlah_tiket']); ?>x Tiket - <?php echo htmlspecialchars($row['kategori_tiket']); ?></p>
                    </div>
                    <div class="trx-status-action">
                        <span class="badge-status <?php echo $badge_class; ?>"><?php echo $badge_text; ?></span>
                        <div class="trx-price">Rp <?php echo $harga; ?></div>
                        <?php echo $btn_html; ?>
                    </div>
                </div>

                <?php 
                    } 
                } else {
                    echo '<div style="text-align:center; padding: 40px 20px; color: #888;">
                            <i class="fas fa-ticket-alt" style="font-size: 40px; margin-bottom: 15px; color: #444;"></i>
                            <p>Belum ada riwayat transaksi tiket.</p>
                            <a href="'.$prefix.'events.php" style="color: #ff3366; text-decoration:none; font-weight:bold;">Cari Event Sekarang</a>
                          </div>';
                }
                ?>

            </div>

        </div>
    </div>

</body>
</html>