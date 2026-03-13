<?php
    // Membuka log rekod sesi agar sistem tahu identiti pengguna
    session_start();
    
    // Tetapan fail sambungan pelayan
    require('config.php');

    // Menyekat pengguna yang memintas halaman jika sesi belum aktif (bukan pengundi)
    if(!isset($_SESSION['ic'])){
        header("Location:login.php");
        exit();
    }

    $no_kp = $_SESSION['ic'];

    // Membuat semakan sejarah pengguna di dalam rekod undian
    $semakan_rekod = mysqli_query($sambungan, "SELECT * FROM maklumat_pengundian WHERE IDPengguna='$no_kp'");
    
    if(!$semakan_rekod){
        die("Pemprosesan ralat ketika cuba membaca senarai undian: ".mysqli_error($sambungan));
    }
    
    // Memberi logik 'True/False' sekiranya pengundi telah atau belum mengundi
    $status_mengundi = mysqli_num_rows($semakan_rekod) > 0;

    // Tindak balas sistem jika borang telah disahkan
    if(isset($_POST['hantar_undian'])){
        
        // Memastikan tindakan pencegahan berganda bagi pengundi (Anti-Double Voting)
        if($status_mengundi){
            echo "<script>alert('Sistem menolak percubaan anda. Setiap pengundi sah hanya dibenarkan mengundi sekali sahaja mengikut dasar yang ditetapkan.'); window.location='keputusan.php';</script>";
        } else {
            
            // Mengutip data permainan yang diklik pengundi
            $pilihan_permainan = $_POST['pilihan_undi'];
            date_default_timezone_set("Asia/Kuala_Lumpur");

            // Pelaksanaan menyimpan data ke pangkalan data beserta catatan tarikh semasa
            $tambah_undi = mysqli_query($sambungan, "INSERT INTO maklumat_pengundian(`IDPengguna`,`IDPermainan`,`Tarikh`) 
                                                 VALUES('$no_kp', '$pilihan_permainan', NOW())");

            // Mesej paparan berjaya dihantar
            if($tambah_undi){
                echo "<script>alert('Mesej Undian Sah! Terima kasih kerana melibatkan diri dalam pengundian ini.'); window.location='keputusan.php';</script>";
            } else {
                die("Terdapat gangguan menyimpan data undian: ".mysqli_error($sambungan));
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Laman Pemilihan Pengundian</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
          <a href="undi.php" class="nav-btn">PILIHAN UNDI</a>
          <a href="login.php" class="nav-btn">LOG KELUAR</a>
        </div>
      </nav>

      <center>
          <h1 style="margin-top: 30px; color: #333;">BORANG PENGUNDIAN RASMI</h1>
      </center>

      <?php if($status_mengundi): ?>
          
          <div class="mesej-sudah-undi">
              <h2>⚠️ Status Akaun: Telah Menghantar Undian</h2>
              <p style="font-size: 1.2em;">Log sistem membuktikan bahawa borang anda telah pun diarkibkan.</p>
              <p style="font-size: 1.1em;"><strong>Penafian: Proses ulangan undian adalah ditegah sama sekali untuk memastikan keputusan adil.</strong></p>
          </div>

      <?php else: ?>

          <form action="undi.php" method="POST">
              <table class="undi">
                  <tr>
                      <td>
                          <div class="pilihan-container">
                              <img src="https://umbiofficial.com/cdn/shop/articles/nostalgic-permainan-tradisional-you-might-miss-2509474.jpg?v=1757095395" alt="Permainan Tradisional">
                              <div class="tajuk-pilihan">Permainan Jenis Tradisional</div>
                              <p class="definisi">Definisi: Permainan nostalgia yang sarat dengan warisan adat resam menggunakan kaedah manual yang bersahaja.</p>
                          </div>
                      </td>
                      <td>
                          <div class="pilihan-container">
                              <img src="https://www.sinarharian.com.my/sinarbestari/uploads/2021/06/1091985.jpg" alt="Permainan Digital">
                              <div class="tajuk-pilihan">Permainan Jenis Digital</div>
                              <p class="definisi">Definisi: Kategori moden yang berteraskan perisian elektronik dan grafik komputer menerusi skrin interaktif.</p>
                          </div>
                      </td>
                  </tr>
                  <tr>
                      <td style="text-align: center; border: none; padding-top: 0;">
                          <input type="radio" id="pilih_tradisional" name="pilihan_undi" value="U02" class="radio-pilih" required>
                          <label for="pilih_tradisional" class="label-pilih">SAYA SOKONG TRADISIONAL</label>
                      </td>
                      <td style="text-align: center; border: none; padding-top: 0;">
                          <input type="radio" id="pilih_digital" name="pilihan_undi" value="U01" class="radio-pilih" required>
                          <label for="pilih_digital" class="label-pilih">SAYA SOKONG DIGITAL</label>
                      </td>
                  </tr>
                  <tr>
                      <td colspan="2" style="text-align: center; border: none;">
                          <input type="submit" name="hantar_undian" value="MUKTAMADKAN PILIHAN SAYA" class="btn-submit" style="width: 40%; margin-top: 20px; font-size: 1.2em; padding: 15px;">
                      </td>
                  </tr>
              </table>
          </form>
         
      <?php
      //Menutup Logik Syarat 
       endif; 
      ?>

      <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>