<?php
// Menyambung ke pelayan pangkalan data MySQL
require "config.php";

// Menghasilkan arahan gabungan pelbagai jadual (JOIN) bagi memaparkan maklumat lengkap 
$arahan_sql = "SELECT pengundi.IDPengguna, pengundi.Nama, senarai_permainan.Permainan, kelas.Kelas, maklumat_pengundian.Tarikh
        FROM maklumat_pengundian
        INNER JOIN pengundi ON maklumat_pengundian.IDPengguna = pengundi.IDPengguna
        INNER JOIN senarai_permainan ON maklumat_pengundian.IDPermainan = senarai_permainan.IDPermainan
        INNER JOIN kelas ON pengundi.IDKelas = kelas.IDKelas 
        ORDER BY maklumat_pengundian.Tarikh DESC";

$hasil_carian = mysqli_query($sambungan, $arahan_sql); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Pengundian</title>
        <link rel="stylesheet" href="styles.css">
        <script>
            // Fungsi JS untuk memanggil skrin cetakan komputer
            function printTable(){
                window.print();
            }
        </script>
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
          <a href="lamanUtama.php" class="nav-btn">LAMAN UTAMA</a>
          <a href="laporan.php" class="nav-btn">LAPORAN</a>
          <a href="keputusanAdmin.php" class="nav-btn">KEPUTUSAN</a>
          <a href="kemaskini.php" class="nav-btn">KEMASKINI</a>
          <a href="import.php" class="nav-btn">IMPORT</a>
          <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
      </nav>

      <center>
          <h2 style="margin: 30px 0 20px 0; color: #333;">LAPORAN PENUH KESELURUHAN PENGUNDIAN</h2>
      </center>

      <table class="laporan">
        <thead>
          <tr>
            <th>ID Pengguna</th>
            <th>Nama Penuh Pengundi</th>
            <th>Pilihan Permainan</th>
            <th>Kelas</th>
            <th>Tarikh Mengundi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Menyemak adakah wujud sekurang-kurangnya satu data untuk dipaparkan
          if (mysqli_num_rows($hasil_carian) > 0) {
              
              // Cipta baris baharu (row) selagi rekod data belum habis dibaca
              while($baris = mysqli_fetch_assoc($hasil_carian)) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($baris['IDPengguna']) . "</td>";
                  echo "<td style='text-align:left; padding-left:15px;'>" . htmlspecialchars($baris['Nama']) . "</td>";
                  echo "<td>" . htmlspecialchars($baris['Permainan']) . "</td>";
                  echo "<td>" . htmlspecialchars($baris['Kelas']) . "</td>";
                  echo "<td>" . htmlspecialchars($baris['Tarikh']) . "</td>";
                  echo "</tr>";
              }
          } else {
              // Paparkan mesej ketiadaan rekod
              echo "<tr><td colspan='5' style='text-align:center; padding: 20px; color: red;'>Masih tiada rekod dijumpai dalam sistem.</td></tr>";
          }
          ?>
        </tbody>
      </table>

      <center>
          <div class="btn-container">
              <button onclick="printTable()" class="btn-cetak">CETAK LAPORAN</button>
          </div>
      </center>

      <footer>
        <center><p class="copyright">Disediakan oleh Chua Jing Hui</p></center>
      </footer>
    </body>
</html>