<?php
// Sambungan ke pelayan MySQL
require "config.php";

// Menghasilkan arahan carian menyatukan nama kelas bagi pengundi
$arahan_sql = "SELECT pengundi.IDPengguna, pengundi.Nama, kelas.Kelas 
        FROM pengundi 
        INNER JOIN kelas ON pengundi.IDKelas = kelas.IDKelas 
        ORDER BY pengundi.IDPengguna ASC";

$hasil_carian = mysqli_query($sambungan, $arahan_sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Kemaskini</title>
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

    <center>
        <h1 style="margin: 20px 0;">KEMASKINI MAKLUMAT PENGUNDI (ADMIN)</h1>
    
        
        <table class="kemaskini">
            <thead>
                <tr>
                    <th>ID Pengguna</th>
                    <th>Nama Pengundi</th>
                    <th>Kelas Berdaftar</th>
                    <th colspan="2">Tindakan Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($baris = mysqli_fetch_assoc($hasil_carian)) {
                    echo "<tr>";
                    echo "<td>" . $baris['IDPengguna'] . "</td>";
                    echo "<td>" . $baris['Nama'] . "</td>";
                    echo "<td>" . $baris['Kelas'] . "</td>";
                    
                    // -- PENTING: Penggunaan kaedah POST untuk fungsi EDIT --
                    echo "<td>
                            <form action='edit_pengundi.php' method='POST' style='margin: 0;'>
                                <input type='hidden' name='id_pengguna' value='" . $baris['IDPengguna'] . "'>
                                <button type='submit' style='color: blue; font-weight: bold; background: none; border: none; cursor: pointer; font-size: 16px; text-decoration: underline;'>EDIT</button>
                            </form>
                          </td>";
                          
                    // -- PENTING: Penggunaan kaedah POST untuk fungsi PADAM beserta sistem amaran --
                    echo "<td>
                            <form action='padam_pengundi.php' method='POST' style='margin: 0;' onsubmit='return confirm(\"Adakah anda pasti untuk padam rekod pengundi ini secara kekal?\")'>
                                <input type='hidden' name='id_pengguna' value='" . $baris['IDPengguna'] . "'>
                                <button type='submit' style='color: red; font-weight: bold; background: none; border: none; cursor: pointer; font-size: 16px; text-decoration: underline;'>PADAM</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </center>

    <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
    </footer>
</body>
</html>