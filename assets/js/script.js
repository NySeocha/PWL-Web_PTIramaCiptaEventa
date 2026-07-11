// Menunggu sampai seluruh halaman HTML selesai dimuat
document.addEventListener("DOMContentLoaded", function() {
    
    // Mengecek apakah ada parameter di URL (misal: ?status=success)
    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        
        // Memunculkan notifikasi sesuai status
        if (status === 'success') {
            alert('Pesan berhasil terkirim! Tim Irama Cipta Eventa akan segera menghubungi Anda.');
        } else if (status === 'error') {
            alert('Mohon maaf, pesan gagal dikirim ke sistem. Silakan coba lagi.');
        }
        
        // MAGIC TRICK: Membersihkan URL agar notifikasi tidak muncul terus saat halaman di-refresh
        window.history.replaceState(null, null, window.location.pathname);
    }
});