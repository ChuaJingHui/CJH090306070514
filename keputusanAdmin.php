<?php
// Memulakan session
session_start();

// Menghalang cache pelayar supaya butang 'Back' tidak memaparkan maklumat selepas logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Tarikh masa lampau

// Redirect ke index.php jika session tidak wujud untuk mengelakkan loop'; n1
if (!isset($_SESSION['admin'])) {
    print('<script>window.location = "index.php"</script>');
    exit();
}

// Memastikan admin telah log masuk dengan betul
if (isset($_SESSION['admin']) && $_SESSION['logMasuk'] == true) {
?>
<?php
// Memanggil fail konfigurasi untuk menyambung ke pangkalan data
require "config.php";

// Bahagian 1: Mengira undian bagi Permainan Tradisional
// Arahan SQL untuk mengira jumlah undi kategori Tradisional menggunakan INNER JOIN
$arahan_sql_tradisional = "SELECT COUNT(maklumat_pengundian.IDPengguna) AS Jumlah 
                           FROM maklumat_pengundian 
                           INNER JOIN senarai_permainan ON maklumat_pengundian.IDPermainan = senarai_permainan.IDPermainan 
                           WHERE senarai_permainan.Permainan LIKE '%Tradisional%'"; 
// Melaksanakan arahan SQL tradisional ke pangkalan data
$hasil_tradisional = mysqli_query($sambungan, $arahan_sql_tradisional); 
// Mengambil hasil data dalam bentuk array bersekutu
$data_tradisional = mysqli_fetch_assoc($hasil_tradisional); 
// Menyimpan angka jumlah undi tradisional ke dalam pembolehubah
$jumlah_tradisional = $data_tradisional['Jumlah']; 

// Bahagian 2: Mengira undian bagi Permainan Digital
// Arahan SQL untuk mengira jumlah undi kategori Digital menggunakan INNER JOIN
$arahan_sql_digital = "SELECT COUNT(maklumat_pengundian.IDPengguna) AS Jumlah 
                       FROM maklumat_pengundian 
                       INNER JOIN senarai_permainan ON maklumat_pengundian.IDPermainan = senarai_permainan.IDPermainan 
                       WHERE senarai_permainan.Permainan LIKE '%Digital%'"; 
// Melaksanakan arahan SQL digital ke pangkalan data
$hasil_digital = mysqli_query($sambungan, $arahan_sql_digital); 
// Mengambil hasil data dalam bentuk array bersekutu
$data_digital = mysqli_fetch_assoc($hasil_digital); 
// Menyimpan angka jumlah undi digital ke dalam pembolehubah
$jumlah_digital = $data_digital['Jumlah']; 

// Bahagian 3: Fungsi Memaparkan Keputusan
// Fungsi untuk menentukan pemenang berdasarkan perbandingan jumlah undi
function keputusan($jumlah_digital,$jumlah_tradisional){ 
    // Semakan jika undi digital melebihi undi tradisional
    if ($jumlah_digital>$jumlah_tradisional){ 
        // Mengembalikan teks kemenangan digital
        return "Permainan Yang Mendapat Paling Banyak Undi Ialah Permainan Digital."; 
    // Semakan jika undi tradisional melebihi undi digital
    }elseif($jumlah_tradisional>$jumlah_digital){ 
        // Mengembalikan teks kemenangan tradisional
        return "Permainan Yang Mendapat Paling Banyak Undi Ialah Permainan Tradisional."; 
    // Jika kedua-dua jumlah undian adalah sama
    }else{ 
        // Mengembalikan teks keputusan seri
        return "Kedua-dua Permainan Ini Mendapat Undi Seri."; 
    } 
} 

?> 
<!-- Mengisytiharkan dokumen sebagai jenis HTML5 -->
<!DOCTYPE html> 
<html> 
    <head> 
        <!-- Tajuk laman yang dipaparkan pada tab pelayar -->
        <title>Keputusan Pengundian Keseluruhan</title> 
        <!-- Menghubungkan fail gaya CSS luaran -->
        <link rel="stylesheet" href="styles.css"> 
        <style>
            /* CSS khas untuk mod cetakan */
            /* --- GAYA KHAS UNTUK CETAKAN (PORTRAIT) --- */
        @media print {
            @page {
                size: portrait;
                margin: 2cm;
            }

            /* Sembunyikan Navigasi, Footer, Gambar, dan Butang */
            nav, .nav, footer, img, .btn-container, .no-print {
                display: none !important;
            }

            body {
                background-color: white !important;
                margin: 0;
                padding: 0;
                width:90%;
            }

            .undi-container {
                width: 100% !important;
                box-shadow: none !important;
                margin-top: 30px;
            }

            th, td {
                border: 2px solid black !important; /* Border hitam pekat */
                padding: 25px 15px !important;
                text-align: center !important;
                vertical-align: middle !important;
                color: black !important;
            }

            th {
                background-color: #f2f2f2 !important;
                -webkit-print-color-adjust: exact;
                font-size: 1.5em;
            }

            .tajuk-permainan {
                font-size: 1.3em;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .jumlah-undi {
                font-size: 1.8em;
                font-weight: bold;
                margin-top: 10px;
                color:black;
            }

            .umum-pemenang {
                font-size: 28px;
                font-weight: bold;
                text-align:center;
            }
        }   
        </style>
    </head> 

    <body> 
        <center>
        <nav class="nav"> 
            <div class="navTop"> 
                <!-- Tajuk utama sistem pengundian -->
                <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1> 
            </div> 
            <div class="navButtons"> 
                <!-- Pautan navigasi ke Laman Utama Admin -->
                <a href="lamanUtamaAdmin.php" class="nav-btn">LAMAN UTAMA</a> 
                <!-- Pautan navigasi ke halaman Kemaskini -->
                <a href="kemaskini.php" class="nav-btn">KEMASKINI</a> 
                <!-- Pautan navigasi ke halaman Keputusan -->
                <a href="keputusanAdmin.php" class="nav-btn">KEPUTUSAN</a> 
                <!-- Pautan navigasi ke halaman Laporan -->
                <a href="laporan.php" class="nav-btn">LAPORAN</a> 
                <!-- Pautan navigasi ke halaman Import -->
                <a href="import.php" class="nav-btn">IMPORT</a> 
                <!-- Pautan untuk Log Keluar dari sistem -->
                <a href="logkeluar.php" class="nav-btn">KELUAR</a> 
            </div> 
        </nav> 
        
        <div class="undi-container"> 
            <table class="undi"> 
                <tr> 
                    <!-- Tajuk pengepala keputusan undian keseluruhan -->
                    <th colspan="2">KEPUTUSAN UNDIAN KESELURUHAN (LIVE)</th> 
            </tr> 
            <tr> 
                <td> 
                    <!-- Nama kategori permainan tradisional -->
                    <div class="tajuk-permainan">Permainan Tradisional</div> 
                            <!-- Paparkan gambar permainan tradisional -->
                            <img src="https://umbiofficial.com/cdn/shop/articles/nostalgic-permainan-tradisional-you-might-miss-2509474.jpg?v=1757095395" alt="Permainan Tradisional"> 
                            <!-- Label bagi jumlah terkumpul undi -->
                            <p style="margin-bottom: 5px;">Jumlah Terkumpul:</p> 
                    <div class="jumlah-undi">
                        <!-- Paparan angka jumlah undi tradisional menggunakan PHP -->
                        <?php echo $jumlah_tradisional; ?> Undian
                    </div> 
                </td> 
                <td> 
                    <!-- Nama kategori permainan digital -->
                    <div class="tajuk-permainan">Permainan Digital</div> 
                        <!-- Paparkan gambar permainan digital -->
                        <img src="https://www.sinarharian.com.my/sinarbestari/uploads/2021/06/1091985.jpg" alt="Permainan Digital"> 
                        <!-- Label bagi jumlah terkumpul undi -->
                        <p style="margin-bottom: 5px;">Jumlah Terkumpul:</p> 
                    <div class="jumlah-undi">
                        <!-- Paparan angka jumlah undi digital menggunakan PHP -->
                        <?php echo $jumlah_digital; ?> Undian
                    </div> 
                </td> 
            </tr> 
            <tr> 
                <td colspan="2"> 
                    <!-- Memaparkan teks pengumuman pemenang melalui fungsi keputusan -->
                    <p class="umum-pemenang">
                        <?php echo keputusan($jumlah_digital,$jumlah_tradisional); ?>
                    </p> 
                </td> 
            </tr> 
        </table> 
            <div class="btn-container">
                <!-- Butang untuk mengaktifkan fungsi cetakan keputusan -->
                <button onclick="window.print()" class="btn-cetak no-print">CETAK KEPUTUSAN</button>
            </div>
        </center>
    </div> 
    
    <footer> 
        <!-- Paparan maklumat penyedia sistem di bahagian kaki -->
        <span>Disediakan oleh Chua Jing Hui</span> 
    </footer> 
    </body> 
</html>
<?php
} else {
    // Jika cubaan akses tanpa session atau selepas logout
    echo "<script>
        alert('Sila log masuk semula untuk meneruskan.');
        window.location.replace('index.php');
    </script>";
    exit();
}
?>