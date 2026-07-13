<?php 
include("templates/header.php"); 
include("config/koneksi.php");

// Proses PHP diletakkan di file yang sama
if (isset($_POST['submit_beli'])) {
    // 1. Tangkap semua data dari form HTML
    $id_event       = $_POST['id_event'];
    $nama_pembeli   = $_POST['nama_pembeli'];
    $email_pembeli  = $_POST['email_pembeli'];
    $kategori_tiket = $_POST['kategori_tiket'];
    $jumlah_tiket   = $_POST['jumlah_tiket'];
    $total_bayar    = $_POST['total_bayar'];
    
    // Membuat kode unik
    $kode_booking = "TIKET-" . time(); 
    
    // 2. PROSES UPLOAD FOTO STRUK
    $nama_file = $_FILES['foto_bukti']['name'];
    $tmp_name  = $_FILES['foto_bukti']['tmp_name'];
    
    // Ganti nama file agar tidak ada yang sama
    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
    $nama_file_baru = $kode_booking . "_struk." . $ext; 
    
    // Lokasi penyimpanan folder uploads
    $path = "assets/uploads/" . $nama_file_baru;
    
    // 3. Eksekusi pemindahan file
    if (move_uploaded_file($tmp_name, $path)) {
        
        // PROSES SIMPAN KE DATABASE (Pastikan semua kolom dimasukkan)
        $query_insert = "INSERT INTO transaksi_tiket 
                         (kode_booking, id_event, nama_pembeli, email_pembeli, kategori_tiket, jumlah_tiket, total_bayar, bukti_bayar, status_pembayaran) 
                         VALUES 
                         ('$kode_booking', '$id_event', '$nama_pembeli', '$email_pembeli', '$kategori_tiket', '$jumlah_tiket', '$total_bayar', '$nama_file_baru', 'Menunggu Validasi')";
                         
        $simpan = mysqli_query($konek, $query_insert);
        
        if ($simpan) {
            // Menangkap ID transaksi yang baru saja dibuat oleh database
            $id_transaksi_baru = mysqli_insert_id($konek);
            
            // Membawa ID tersebut ke halaman nota menggunakan URL (?id=...)
            echo "<script>
                    alert('Pembelian Berhasil! Menunggu validasi dari admin.'); 
                    window.location='nota_pembelian.php?id=" . $id_transaksi_baru . "';
                  </script>";
        } else {
            echo "<script>alert('Gagal menyimpan data transaksi ke database!');</script>";
        }
    } else {
        echo "<script>alert('Gagal mengunggah foto struk! Pastikan folder assets/uploads sudah dibuat.');</script>";
    }
}

// Menangkap ID event dari URL
$id_event = isset($_GET['id']) ? $_GET['id'] : 1;
$query_event = mysqli_query($konek, "SELECT * FROM jadwal_event WHERE id_event='$id_event'");
$event = mysqli_fetch_assoc($query_event);

// Jika ID event tidak ada di database, beri nama default
$nama_event = $event ? $event['nama_event'] : "Hiphop Fest: Changbin & Friends";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beli Tiket - Irama Cipta Eventa</title>
</head>
<body>

<section class="hero-events" style="height: 250px; background: linear-gradient(to bottom, rgba(10,10,10,0.8), #0a0a0a), url('assets/images/latar.jpg') no-repeat center center/cover;">
    <div class="hero-content">
        <h1 style="font-size: 2rem; margin-top: 50px;">Ticket Reservation</h1>
        <p style="color: #ff3366; font-weight: bold;"><?php echo htmlspecialchars($nama_event); ?></p>
    </div>
</section>

<section class="event-detail-container" style="max-width: 700px; margin-top: -30px;">
    <div class="event-detail-layout" style="display: block; padding: 40px;">
        
        <form method="POST" action="" class="contact-card-form" enctype="multipart/form-data">
            <input type="hidden" name="id_event" value="<?php echo $id_event; ?>">
            
            <div style="margin-bottom: 25px;">
                <label style="color: #ff3366; font-weight: bold;">Nama Lengkap Sesuai KTP</label>
                <input type="text" name="nama_pembeli" required placeholder="Masukkan nama lengkap Anda..." style="width: 100%; padding: 12px; background: #111; border: 1px solid #333; color: white; border-radius: 4px; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="color: #ff3366; font-weight: bold;">Alamat Email Aktif</label>
                <input type="email" name="email_pembeli" required placeholder="e-ticket akan dikirim ke email ini..." style="width: 100%; padding: 12px; background: #111; border: 1px solid #333; color: white; border-radius: 4px; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="color: #ff3366; font-weight: bold;">Pilih Kategori Tiket</label>
                <select name="kategori_tiket" id="kategori_tiket" onchange="hitungTotal()" style="width: 100%; padding: 12px; background: #111; border: 1px solid #333; color: white; border-radius: 4px; margin-top: 5px;">
                    <option value="VIP Standing" data-harga="3500000">VIP Standing - Rp 3.500.000</option>
                    <option value="CAT 1 (Seating)" data-harga="2800000">CAT 1 (Seating) - Rp 2.800.000</option>
                    <option value="CAT 2 (Seating)" data-harga="1500000">CAT 2 (Seating) - Rp 1.500.000</option>
                </select>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="color: #ff3366; font-weight: bold;">Jumlah Tiket (Maksimal 4)</label>
                <select name="jumlah_tiket" id="jumlah_tiket" onchange="hitungTotal()" style="width: 100%; padding: 12px; background: #111; border: 1px solid #333; color: white; border-radius: 4px; margin-top: 5px;">
                    <option value="1">1 Tiket</option>
                    <option value="2">2 Tiket</option>
                    <option value="3">3 Tiket</option>
                    <option value="4">4 Tiket</option>
                </select>
            </div>

            <div style="background: #0a0a0a; padding: 20px; border-left: 4px solid #ff3366; margin-bottom: 30px; border-radius: 4px;">
                <p style="color: #aaa; font-size: 13px; text-transform: uppercase;">Total Pembayaran</p>
                <h2 style="color: #ffffff; margin-top: 5px;" id="display_total">Rp 3.500.000</h2>
                <input type="hidden" name="total_bayar" id="total_bayar" value="3500000">
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="color: #ff3366; font-weight: bold;">Upload Bukti Transfer / Pembayaran</label>
                <input type="file" name="foto_bukti" accept="image/jpeg, image/png, image/jpg" required style="width: 100%; padding: 10px; background: #111; border: 1px solid #333; color: white; border-radius: 4px; margin-top: 5px;">
                <p style="font-size: 11px; color: #888; margin-top: 5px;">* Format: JPG, JPEG, PNG.</p>
            </div>

            <button type="submit" name="submit_beli" class="btn-pill" style="width: 100%; text-align: center; border: none; cursor: pointer; font-size: 16px; background: #ff3366; color: white; padding: 15px; border-radius: 4px; font-weight: bold;">Konfirmasi & Bayar Sekarang</button>
        </form>
        
    </div>
</section>

<script>
function hitungTotal() {
    var selectTiket = document.getElementById("kategori_tiket");
    var harga = selectTiket.options[selectTiket.selectedIndex].getAttribute("data-harga");
    var jumlah = document.getElementById("jumlah_tiket").value;
    
    var total = parseInt(harga) * parseInt(jumlah);
    
    // Format mata uang Rupiah untuk tampilan visual
    var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    });
    
    document.getElementById("display_total").innerText = formatter.format(total);
    document.getElementById("total_bayar").value = total;
}
</script>

</body>
</html>