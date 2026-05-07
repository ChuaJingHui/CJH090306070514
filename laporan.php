<?php
// Menyambung ke pelayan pangkalan data MySQL
// Memanggil fail konfigurasi sambungan pangkalan data
require "config.php";

// Menghasilkan arahan gabungan pelbagai jadual (JOIN) bagi memaparkan maklumat lengkap 
// Menyediakan arahan SQL JOIN untuk mengambil maklumat pengundian yang lengkap dari pelbagai jadual
$arahan_sql = "SELECT pengundi.IDPengguna, pengundi.Nama, senarai_permainan.Permainan, kelas.Kelas, maklumat_pengundian.Tarikh
        FROM maklumat_pengundian
        INNER JOIN pengundi ON maklumat_pengundian.IDPengguna = pengundi.IDPengguna
        INNER JOIN senarai_permainan ON maklumat_pengundian.IDPermainan = senarai_permainan.IDPermainan
        INNER JOIN kelas ON pengundi.IDKelas = kelas.IDKelas 
        ORDER BY maklumat_pengundian.Tarikh DESC";

// Melaksanakan arahan SQL menggunakan pembolehubah sambungan yang telah ditetapkan
$hasil_carian = mysqli_query($sambungan, $arahan_sql); 
?>
<!-- Mengisytiharkan jenis dokumen sebagai standard HTML5 -->
<!DOCTYPE html>
<html>
    <head>
        <!-- Menetapkan tajuk laman yang dipaparkan pada tab pelayar web -->
        <title>Laporan Pengundian</title>
        <!-- Menghubungkan fail CSS luaran untuk reka bentuk laporan -->
        <link rel="stylesheet" href="styles.css">
        <script>
            // Fungsi JS untuk memanggil skrin cetakan komputer
            // Fungsi JavaScript untuk membuka dialog cetakan pelayar
            function printTable(){
                // Menjalankan arahan cetak dokumen
                window.print();
            }
        </script>
        <style>
          /* Tetapan gaya khusus yang hanya terpakai semasa mencetak halaman ke kertas */
          @media print 
          {
              /* Menyembunyikan elemen yang tidak perlu dicetak seperti menu dan footer */
              nav, footer, .btn-container, .btn-cetak
              {
                  display: none !important;
              }
              /* Membesarkan lebar jadual laporan supaya memenuhi ruang kertas */
              .laporan, .undi-container 
              {
                  width: 90%;
                  box-shadow: none;
              }
              /* Menukarkan warna latar pengepala kepada kelabu untuk menjimatkan dakwat pencetak */
              .laporan th, .undi th 
              {
                  background-color: #cccccc !important; 
                  color: black !important;
              }
              /* Menetapkan sempadan hitam bagi setiap sel dalam cetakan */
              th, td 
              {
                  border: 1px solid black;
                  padding: 8px;
              }
              /* Menyelaraskan teks badan halaman ke tengah semasa cetakan */
              body 
              {
                  text-align: center;
              }
          }
        </style>
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <!-- Tajuk utama sistem yang dipaparkan pada bar navigasi -->
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
          <!-- Pautan navigasi kembali ke Laman Utama Admin -->
          <a href="lamanUtamaAdmin.php" class="nav-btn">LAMAN UTAMA</a>
          <!-- Pautan navigasi ke halaman Kemaskini maklumat -->
          <a href="kemaskini.php" class="nav-btn">KEMASKINI</a>
          <!-- Pautan navigasi untuk melihat Keputusan Admin -->
            <a href="keputusanAdmin.php" class="nav-btn">KEPUTUSAN</a>
            <!-- Pautan navigasi ke halaman Laporan pengundian -->
            <a href="laporan.php" class="nav-btn">LAPORAN</a>
            <!-- Pautan navigasi ke bahagian Import data -->
            <a href="import.php" class="nav-btn">IMPORT</a>
          <!-- Pautan navigasi untuk Keluar dari sistem -->
          <a href="logkeluar.php" class="nav-btn">KELUAR</a>
        </div>
      </nav>

      <center>
          <!-- Tajuk besar bagi laporan penuh keseluruhan pengundian -->
          <h2 style="margin: 30px 0 20px 0; color: #333;">LAPORAN PENUH KESELURUHAN PENGUNDIAN</h2>
      </center>

      <table class="laporan">
        <thead>
          <tr>
            <!-- Pengepala kolom bagi ID Pengguna -->
            <th>ID Pengguna</th>
            <!-- Pengepala kolom bagi Nama Penuh Pengundi -->
            <th>Nama Penuh Pengundi</th>
            <!-- Pengepala kolom bagi Pilihan Permainan -->
            <th>Pilihan Permainan</th>
            <!-- Pengepala kolom bagi Kelas -->
            <th>Kelas</th>
            <!-- Pengepala kolom bagi Tarikh Mengundi -->
            <th>Tarikh Mengundi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Menyemak adakah wujud sekurang-kurangnya satu data untuk dipaparkan
          // Memeriksa jumlah baris rekod yang diperolehi dari pangkalan data
          if (mysqli_num_rows($hasil_carian) > 0) {
              
              // Cipta baris baharu (row) selagi rekod data belum habis dibaca
              // Memulakan gelung untuk memaparkan setiap rekod sebagai baris jadual
              while($baris = mysqli_fetch_assoc($hasil_carian)) {
                  echo "<tr>";
                  // Memaparkan ID Pengguna dengan ciri keselamatan terhadap XSS
                  echo "<td>" . htmlspecialchars($baris['IDPengguna']) . "</td>";
                  // Memaparkan Nama Pengundi dengan penggayaan penjajaran kiri
                  echo "<td style='text-align:center; padding-left:15px;'>" . htmlspecialchars($baris['Nama']) . "</td>";
                  // Memaparkan pilihan permainan pengundi
                  echo "<td>" . htmlspecialchars($baris['Permainan']) . "</td>";
                  // Memaparkan maklumat kelas pengundi
                  echo "<td>" . htmlspecialchars($baris['Kelas']) . "</td>";
                  // Memaparkan tarikh dan masa undian dilakukan
                  echo "<td>" . htmlspecialchars($baris['Tarikh']) . "</td>";
                  echo "</tr>";
              }
          } else {
              // Paparkan mesej ketiadaan rekod
              // Memaparkan baris mesej amaran sekiranya pangkalan data kosong
              echo "<tr><td colspan='5' style='text-align:center; padding: 20px; color: red;'>Masih tiada rekod dijumpai dalam sistem.</td></tr>";
          }
          ?>
        </tbody>
      </table>

      <center>
          <div class="btn-container">
              <!-- Butang untuk mengaktifkan fungsi cetakan laporan -->
              <button onclick="printTable()" class="btn-cetak">CETAK LAPORAN</button>
          </div>
      </center>

      <footer>
        <!-- Memaparkan teks maklumat hak cipta dan penyedia sistem di bahagian kaki -->
        <center><p>Disediakan oleh Chua Jing Hui</p></center>
      </footer>
    </body>
</html>