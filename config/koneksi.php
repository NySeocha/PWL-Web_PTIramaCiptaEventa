<?php
    $konek = mysqli_connect("localhost", "root", "", "db_irama_cipta");

    if (!$konek) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>