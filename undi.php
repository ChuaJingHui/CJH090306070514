
<?php
// Memulakan session
session_start();

// Menghalang cache pelayar supaya butang 'Back' tidak memaparkan maklumat selepas logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Tarikh masa lampau

// Redirect ke index.php jika session tidak wujud untuk mengelakkan loop'; n1
if (!isset($_SESSION['IDPengguna'])) {
    print('<script>window.location = "index.php"</script>');
    exit();
}

// Memastikan pengguna telah log masuk dengan betul
if (isset($_SESSION['IDPengguna']) && $_SESSION['logMasuk'] == true) {
?>
<?php
    
    // Memanggil fail konfigurasi sambungan pangkalan data
    require('config.php');

    // Memeriksa jika sesi pengguna belum wujud untuk menyekat akses tanpa izin
    if(!isset($_SESSION['ic'])){
        // Menghantar pengguna kembali ke laman log masuk
        header("Location:index.php");
        // Memberhentikan pelaksanaan skrip
        exit();
    }

    // Menyimpan nombor kad pengenalan pengguna daripada sesi ke dalam pembolehubah
    $no_kp = $_SESSION['ic'];

    // Melaksanakan arahan SQL untuk menyemak sama ada pengguna sudah mengundi
    $semakan_rekod = mysqli_query($sambungan, "SELECT * FROM maklumat_pengundian WHERE IDPengguna='$no_kp'");
    
    // Memastikan proses carian pangkalan data berjalan tanpa ralat
    if(!$semakan_rekod){
        // Menamatkan skrip dan memaparkan punca ralat pangkalan data
        die("Pemprosesan ralat ketika cuba membaca senarai undian: ".mysqli_error($sambungan));
    }
    
    // Menetapkan status boolean berdasarkan kewujudan rekod undian
    $status_mengundi = mysqli_num_rows($semakan_rekod) > 0;

    // Memproses penghantaran borang apabila butang hantar diklik
    if(isset($_POST['hantar_undian'])){
        
        // Melakukan semakan terakhir bagi menghalang pengundian berganda
        if($status_mengundi){
            // Memaparkan amaran ralat dan menghala pengguna ke laman keputusan
            echo "<script>alert('Sistem menolak percubaan anda. Setiap pengundi sah hanya dibenarkan mengundi sekali sahaja mengikut dasar yang ditetapkan.'); window.location='keputusan.php';</script>";
        } else {
            
            // Mengambil nilai pilihan permainan yang dihantar melalui borang
            $pilihan_permainan = $_POST['pilihan_undi'];
            // Menetapkan zon masa rasmi bagi catatan tarikh sistem
            date_default_timezone_set("Asia/Kuala_Lumpur");

            // Memasukkan data undian baharu ke dalam jadual maklumat pengundian
            $tambah_undi = mysqli_query($sambungan, "INSERT INTO maklumat_pengundian(`IDPengguna`,`IDPermainan`,`Tarikh`) 
                                                 VALUES('$no_kp', '$pilihan_permainan', NOW())");

            // Memeriksa status kejayaan proses memasukkan data
            if($tambah_undi){
                // Memaparkan mesej kejayaan dan beralih ke halaman keputusan
                echo "<script>alert('Mesej Undian Sah! Terima kasih kerana melibatkan diri dalam pengundian ini.'); window.location='keputusan.php';</script>";
            } else {
                // Memaparkan mesej ralat kegagalan menyimpan data
                die("Terdapat gangguan menyimpan data undian: ".mysqli_error($sambungan));
            }
        }
    }
?>

<!-- Mengisytiharkan standard dokumen sebagai HTML5 -->
<!DOCTYPE html>
<html>
    <head>
        <!-- Menetapkan tajuk laman yang dipaparkan pada tab pelayar web -->
        <title>Laman Pemilihan Pengundian</title>
        <!-- Menghubungkan fail CSS luaran untuk reka bentuk laman -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <!-- Tajuk utama sistem yang dipaparkan pada bar navigasi -->
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
            <!-- Pautan navigasi untuk melihat keputusan undian semasa -->
            <a href="keputusan.php" class="nav-btn">KEPUTUSAN</a>
            <!-- Pautan navigasi untuk keluar dari sistem -->
            <a href="logkeluar.php" class="nav-btn">KELUAR</a>
        </div>
      </nav>

      <center>
          <!-- Tajuk utama bagi borang pengundian rasmi -->
          <h1 style="margin-top: 30px; color: #333;">BORANG PENGUNDIAN RASMI</h1>
      </center>

      <!-- Memulakan blok syarat jika pengundi dikesan sudah menghantar undian -->
      <?php if($status_mengundi): ?>
          
          <div class="mesej-sudah-undi">
              <!-- Paparan status amaran pengundian telah dilakukan -->
              <h2>⚠️ Status Akaun: Telah Menghantar Undian</h2>
              <!-- Penerangan sistem mengenai arkib rekod undian pengguna -->
              <p style="font-size: 1.2em;">Log sistem membuktikan bahawa borang anda telah pun diarkibkan.</p>
              <!-- Nota penafian integriti pengundian yang adil -->
              <p style="font-size: 1.1em;"><strong>Penafian: Proses ulangan undian adalah ditegah sama sekali untuk memastikan keputusan adil.</strong></p>
          </div>

      <!-- Blok alternatif bagi pengundi yang belum menghantar undian -->
      <?php else: ?>

          <!-- Memulakan borang pengundian dengan kaedah penghantaran POST -->
          <form action="undi.php" method="POST">
              <table class="undi">
                  <tr>
                      <td>
                          <div class="pilihan-container">
                              <!-- Memaparkan imej rujukan bagi permainan tradisional -->
                              <img src="https://umbiofficial.com/cdn/shop/articles/nostalgic-permainan-tradisional-you-might-miss-2509474.jpg?v=1757095395" alt="Permainan Tradisional">
                              <!-- Tajuk bagi kategori pilihan permainan tradisional -->
                              <div class="tajuk-pilihan">Permainan Jenis Tradisional</div>
                              <!-- Penjelasan ringkas mengenai definisi permainan tradisional -->
                              <p class="definisi">Definisi: Permainan nostalgia yang sarat dengan warisan adat resam menggunakan kaedah manual yang bersahaja.</p>
                          </div>
                      </td>
                      <td>
                          <div class="pilihan-container">
                              <!-- Memaparkan imej rujukan bagi permainan digital -->
                              <img src="https://www.sinarharian.com.my/sinarbestari/uploads/2021/06/1091985.jpg" alt="Permainan Digital">
                              <!-- Tajuk bagi kategori pilihan permainan digital -->
                              <div class="tajuk-pilihan">Permainan Jenis Digital</div>
                              <!-- Penjelasan ringkas mengenai definisi permainan digital -->
                              <p class="definisi">Definisi: Kategori moden yang berteraskan perisian elektronik dan grafik komputer menerusi skrin interaktif.</p>
                          </div>
                      </td>
                  </tr>
                  <tr>
                      <td style="text-align: center; border: none; padding-top: 0;">
                          <!-- Butang radio untuk memilih kategori permainan tradisional -->
                          <input type="radio" id="pilih_tradisional" name="pilihan_undi" value="U02" class="radio-pilih" required>
                          <!-- Label teks untuk pilihan sokongan tradisional -->
                          <label for="pilih_tradisional" class="label-pilih">SAYA SOKONG TRADISIONAL</label>
                      </td>
                      <td style="text-align: center; border: none; padding-top: 0;">
                          <!-- Butang radio untuk memilih kategori permainan digital -->
                          <input type="radio" id="pilih_digital" name="pilihan_undi" value="U01" class="radio-pilih" required>
                          <!-- Label teks untuk pilihan sokongan digital -->
                          <label for="pilih_digital" class="label-pilih">SAYA SOKONG DIGITAL</label>
                      </td>
                  </tr>
                  <tr>
                      <td colspan="2" style="text-align: center; border: none;">
                          <!-- Butang penghantaran muktamad bagi borang undian -->
                          <input type="submit" name="hantar_undian" value="MUKTAMADKAN PILIHAN SAYA" class="btn-submit" style="width: 40%; margin-top: 20px; font-size: 1.2em; padding: 15px;">
                      </td>
                  </tr>
              </table>
          </form>
         
      <!-- Menamatkan blok logik syarat pengundian -->
      <?php
       endif; 
      ?>

      <footer>
        <!-- Paparan maklumat hak cipta dan penyedia sistem di bahagian kaki -->
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