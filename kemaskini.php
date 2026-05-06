<?php
// Memanggil fail konfigurasi untuk menyambung ke pangkalan data
require "config.php";

// Menyediakan arahan SQL JOIN untuk mengambil data pengundi bersama nama kelas mereka
$arahan_sql = "SELECT pengundi.IDPengguna, pengundi.Nama, kelas.Kelas 
                FROM pengundi 
                INNER JOIN kelas ON pengundi.IDKelas = kelas.IDKelas 
                ORDER BY pengundi.IDPengguna ASC";

// Melaksanakan arahan SQL menggunakan pembolehubah sambungan yang telah ditetapkan
$hasil_carian = mysqli_query($sambungan, $arahan_sql);
?> 
<!-- Mengisytiharkan jenis dokumen sebagai standard HTML5 -->
<!DOCTYPE html> 
<html> 
    <head> 
        <!-- Menetapkan tajuk laman yang akan dipaparkan pada tab pelayar web -->
        <title>Sistem Kemaskini</title> 
        <!-- Menghubungkan fail CSS luaran untuk reka bentuk susun atur laman -->
        <link rel="stylesheet" href="styles.css"> 
    </head> 
    
    <body> 
        <nav class="nav"> 
            <div class="navTop"> 
                <!-- Tajuk utama sistem pengundian yang dipaparkan pada bar navigasi -->
                <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1> 
            </div> 
            
            <div class="navButtons"> 
                <!-- Pautan navigasi kembali ke Laman Utama Admin -->
                <a href="lamanUtamaAdmin.php" class="nav-btn">LAMAN UTAMA</a> 
                <!-- Pautan navigasi ke halaman Kemaskini maklumat -->
                <a href="kemaskini.php" class="nav-btn">KEMASKINI</a> 
                <!-- Pautan navigasi untuk melihat Keputusan undian -->
                <a href="keputusanAdmin.php" class="nav-btn">KEPUTUSAN</a> 
                <!-- Pautan navigasi ke bahagian Laporan sistem -->
                <a href="laporan.php" class="nav-btn">LAPORAN</a> 
                <!-- Pautan navigasi ke bahagian Import data luar -->
                <a href="import.php" class="nav-btn">IMPORT</a> 
                <!-- Pautan navigasi untuk Keluar daripada sistem -->
                <a href="login.php" class="nav-btn">KELUAR</a> 
            </div> 
        </nav> 
        
        <center> 
            <!-- Tajuk halaman bagi pengurusan kemaskini maklumat pengundi -->
            <h1 style="margin: 20px 0;">KEMASKINI MAKLUMAT PENGUNDI (ADMIN)</h1> 
            
            <table class="kemaskini"> 
                <thead> 
                    <tr> 
                        <!-- Pengepala kolom untuk ID Pengguna -->
                        <th>ID Pengguna</th> 
                        <!-- Pengepala kolom untuk Nama Pengundi -->
                        <th>Nama Pengundi</th> 
                        <!-- Pengepala kolom untuk Kelas Berdaftar -->
                        <th>Kelas Berdaftar</th> 
                        <!-- Pengepala kolom untuk ruangan tindakan pentadbir -->
                        <th colspan="2">Tindakan Admin</th> 
                    </tr> 
                </thead> 
                
                <tbody> 
                    <?php
                        // Memulakan gelung untuk memaparkan setiap baris rekod daripada pangkalan data
                        while($baris = mysqli_fetch_assoc($hasil_carian)) {
                            // Memaparkan tag pembuka baris bagi setiap rekod
                            echo "<tr>";
                            // Memaparkan data ID Pengguna ke dalam sel jadual
                            echo "<td>" . $baris['IDPengguna'] . "</td>";
                            // Memaparkan data Nama Pengundi ke dalam sel jadual
                            echo "<td>" . $baris['Nama'] . "</td>";
                            // Memaparkan data Nama Kelas ke dalam sel jadual
                            echo "<td>" . $baris['Kelas'] . "</td>";
                    
                            // Memaparkan butang UBAH yang akan menghantar ID melalui kaedah POST
                            echo "<td>
                                    <!-- Borang tindakan untuk mengubah maklumat profil pengundi -->
                                    <form action='edit_pengundi.php' method='POST' style='margin: 0;'>
                                        <!-- Input tersembunyi bagi membawa maklumat ID Pengguna yang ingin diubah -->
                                        <input type='hidden' name='id_pengguna' value='" . $baris['IDPengguna'] . "'>
                                        <!-- Butang penghantaran borang bagi proses kemaskini -->
                                        <button type='submit' style='color: blue; font-weight: bold; background: none; border: none; cursor: pointer; font-size: 16px; text-decoration: underline;'>UBAH</button>
                                    </form>
                                </td>";
                          
                            // Memaparkan butang PADAM dengan fungsi pengesahan keselamatan JavaScript
                            echo "<td>
                                    <!-- Borang tindakan untuk membuang rekod pengundi daripada sistem -->
                                    <form action='padam_pengundi.php' method='POST' style='margin: 0;' onsubmit='return confirm(\"Adakah anda pasti untuk padam rekod pengundi ini secara kekal?\")'>
                                        <!-- Input tersembunyi bagi membawa maklumat ID Pengguna yang ingin dipadam -->
                                        <input type='hidden' name='id_pengguna' value='" . $baris['IDPengguna'] . "'>
                                        <!-- Butang penghantaran borang bagi proses pemadaman -->
                                        <button type='submit' style='color: red; font-weight: bold; background: none; border: none; cursor: pointer; font-size: 16px; text-decoration: underline;'>PADAM</button>
                                    </form>
                                </td>";
                            // Memaparkan tag penutup baris bagi setiap rekod
                            echo "</tr>";
                        // Menamatkan blok gelung while
                        }
                    ?> 
                </tbody> 
            </table> 
        </center> 
        
    <footer> 
        <!-- Memaparkan teks maklumat hak cipta dan nama pembangun sistem -->
        <span>Disediakan oleh Chua Jing Hui</span> 
    </footer> 

    </body> 
</html>