<?php
// Fail konfigurasi memuatkan sambungan
require "config.php";

// ---- Bahagian 1: Mengira undian bagi Permainan Tradisional ----
$arahan_sql_tradisional = "SELECT COUNT(maklumat_pengundian.IDPengguna) AS Jumlah 
                           FROM maklumat_pengundian 
                           INNER JOIN senarai_permainan ON maklumat_pengundian.IDPermainan = senarai_permainan.IDPermainan 
                           WHERE senarai_permainan.Permainan LIKE '%Tradisional%'";
$hasil_tradisional = mysqli_query($sambungan, $arahan_sql_tradisional);
$data_tradisional = mysqli_fetch_assoc($hasil_tradisional);
$jumlah_tradisional = $data_tradisional['Jumlah']; // Nilai akan disimpan untuk digunakan kelak di ruangan HTML

// ---- Bahagian 2: Mengira undian bagi Permainan Digital ----
$arahan_sql_digital = "SELECT COUNT(maklumat_pengundian.IDPengguna) AS Jumlah 
                       FROM maklumat_pengundian 
                       INNER JOIN senarai_permainan ON maklumat_pengundian.IDPermainan = senarai_permainan.IDPermainan 
                       WHERE senarai_permainan.Permainan LIKE '%Digital%'";
$hasil_digital = mysqli_query($sambungan, $arahan_sql_digital);
$data_digital = mysqli_fetch_assoc($hasil_digital);
$jumlah_digital = $data_digital['Jumlah'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Keputusan Pengundian Keseluruhan</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
          <a href="import.php" class="nav-btn">IMPORT</a>
          <a href="laporan.php" class="nav-btn">LAPORAN</a>
          <a href="keputusanAdmin.php" class="nav-btn">KEPUTUSAN</a>
          <a href="kemaskini.php" class="nav-btn">KEMASKINI</a>
          <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
      </nav>

      

      <div class="undi-container">
          <table class="undi">
              <tr>
                  <th colspan="2">KEPUTUSAN UNDIAN KESELURUHAN (LIVE)</th>
              </tr>
              <tr>
                  <td>
                      <div class="tajuk-permainan">Permainan Tradisional</div>
                      <img src="https://umbiofficial.com/cdn/shop/articles/nostalgic-permainan-tradisional-you-might-miss-2509474.jpg?v=1757095395" alt="Permainan Tradisional">
                      <p style="margin-bottom: 5px;">Jumlah Terkumpul:</p>
                      <div class="jumlah-undi"><?php echo $jumlah_tradisional; ?> Undian</div>
                  </td>
                  <td>
                      <div class="tajuk-permainan">Permainan Digital</div>
                      <img src="https://www.sinarharian.com.my/sinarbestari/uploads/2021/06/1091985.jpg" alt="Permainan Digital">
                      <p style="margin-bottom: 5px;">Jumlah Terkumpul:</p>
                      <div class="jumlah-undi"><?php echo $jumlah_digital; ?> Undian</div>
                  </td>
              </tr>
              <tr style="text-align:center">Pemenang ialah
          </table>
      </div>

      <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>