<?php
// Memanggil fail sambungan pangkalan data
require "config.php";

// Pastikan skrip ini diakses menerusi borang kaedah POST, bukan akses URL terus
if (isset($_POST['id_pengguna'])) {
    
    // Langkah Keselamatan: Elakkan SQL Injection
    $id_pengguna = mysqli_real_escape_string($sambungan, $_POST['id_pengguna']);

    // LANGKAH 1: Padam sejarah undian (Jadual Anak) jika wujud
    // Kita padam ini dulu supaya pangkalan data tidak 'marah' jika kita padam profil pengguna yang masih ada rekod undian.
    mysqli_query($sambungan, "DELETE FROM maklumat_pengundian WHERE IDPengguna = '$id_pengguna'");

    // LANGKAH 2: Padam maklumat profil pengundi (Jadual Anak)
    mysqli_query($sambungan, "DELETE FROM pengundi WHERE IDPengguna = '$id_pengguna'");

    // LANGKAH 3: Padam akaun log masuk (Jadual Ibu Utama)
    $padam_pengguna = mysqli_query($sambungan, "DELETE FROM pengguna WHERE IDPengguna = '$id_pengguna'");

    // Tindakan amaran dipaparkan selepas proses pelaksanaan langkah terakhir selesai
    if ($padam_pengguna) {
        echo "<script>alert('Rekod pengguna dan sejarah undian berjaya dipadam sepenuhnya dari sistem!'); window.location='kemaskini.php';</script>";
    } else {
        // Memaparkan ralat spesifik jika proses masih gagal
        $ralat_sistem = mysqli_error($sambungan);
        echo "<script>alert('Proses memadam gagal! Ralat Sistem: $ralat_sistem'); window.location='kemaskini.php';</script>";
    }
} else {
    // Halang sesiapa yang cuba masuk terus ke URL padam_pengundi.php tanpa menggunakan borang
    header("Location: kemaskini.php");
    exit();
}
?>