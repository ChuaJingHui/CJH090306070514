<?php
require "config.php";

// 1. Sediakan penyataan SQL (The SQL query you provided)
$sql = "SELECT pengundi.IDPengguna, pengundi.Nama, senarai_permainan.Permainan, kelas.Kelas, maklumat_pengundian.Tarikh
        FROM maklumat_pengundian
        INNER JOIN pengundi ON maklumat_pengundian.IDPengguna = pengundi.IDPengguna
        INNER JOIN senarai_permainan ON maklumat_pengundian.IDPermainan = senarai_permainan.IDPermainan
        INNER JOIN kelas ON pengundi.IDKelas = kelas.IDKelas 
        ORDER BY Tarikh DESC";

// 2. Laksanakan query
$result = mysqli_query($con, $sql); // Pastikan $kon adalah nama variabel sambungan dalam config.php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pengundian</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            @media print {
                nav, footer, .btn-container {
                    display: none;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                }
                body {
                    text-align: center;
                }
            }
            .laporan {
                width: 80%;
                margin: 20px auto;
                border-collapse: collapse;
            }
            .laporan th, .laporan td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }
            .btn-container {
                text-align: center;
                margin-top: 10px;
                margin-bottom:20px;
            }
        </style>
    </head>
    <script>
        function printTable(){
            window.print();
        }
    </script>

    <body>
      <nav class="nav">
        <div class="navTop">
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
          <a href="laporan.php" class="nav-btn">LAPORAN</a>
          <a href="keputusanAdmin.php" class="nav-btn">KEPUTUSAN</a>
          <a href="kemaskini.php" class="nav-btn">KEMASKINI</a>
          <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
      </nav>

      <h2 style="text-align:center;">LAPORAN PENGUNDIAN</h2>

      <table class="laporan">
        <thead>
          <tr>
            <th>ID Pengguna</th>
            <th>Nama</th>
            <th>Pengundian (Permainan)</th>
            <th>Kelas</th>
            <th>Tarikh</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // 3. Semak jika ada data
          if (mysqli_num_rows($result) > 0) {
              // 4. Paparkan data setiap baris
              while($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row['IDPengguna'] . "</td>";
                  echo "<td>" . $row['Nama'] . "</td>";
                  echo "<td>" . $row['Permainan'] . "</td>";
                  echo "<td>" . $row['Kelas'] . "</td>";
                  echo "<td>" . $row['Tarikh'] . "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='5' style='text-align:center;'>Tiada rekod dijumpai</td></tr>";
          }
          ?>
        </tbody>
      </table>

      <div class="btn-container">
          <button onclick="printTable()" class="btn">CETAK LAPORAN</button>
      </div>

      <footer>
        <p class="copyright">Disediakan oleh Chua Jing Hui</p>
      </footer>
    </body>
</html>