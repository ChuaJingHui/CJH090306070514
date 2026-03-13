<?php
require "config.php";

$sql = "SELECT pengundi.IDPengguna, pengundi.Nama, kelas.Kelas 
        FROM pengundi 
        INNER JOIN kelas ON pengundi.IDKelas = kelas.IDKelas 
        ORDER BY pengundi.IDPengguna ASC";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kemaskini</title>
    <link rel="stylesheet" href="styles.css"> </head>
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

    <center>
        <h1 style="margin: 20px 0;">KEMASKINI MAKLUMAT PENGUNDI</h1>
        
        <table class="kemaskini">
            <thead>
                <tr>
                    <th>ID Pengguna</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th colspan="2">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['IDPengguna'] . "</td>";
                    echo "<td>" . $row['Nama'] . "</td>";
                    echo "<td>" . $row['Kelas'] . "</td>";
                    // Gunakan pautan teks atau butang kecil
                    echo "<td><a href='edit_pengundi.php?id=".$row['IDPengguna']."' style='color: blue; font-weight: bold; text-decoration: none;'>EDIT</a></td>";
                    echo "<td><a href='padam_pengundi.php?id=".$row['IDPengguna']."' style='color: red; font-weight: bold; text-decoration: none;' onclick='return confirm(\"Padam rekod ini?\")'>PADAM</a></td>";
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