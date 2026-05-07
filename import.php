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
<!-- Mengisytiharkan standard dokumen sebagai HTML5 -->
<!DOCTYPE html>
<html> 
    <head> 
        <!-- Menetapkan tajuk laman yang dipaparkan pada tab pelayar -->
        <title>Borang Import Maklumat Kelas</title>
        <!-- Menghubungkan fail CSS luaran untuk penggayaan reka bentuk -->
        <link rel="stylesheet" href="styles.css"> 
    </head> 

    <body> 
        <nav class="nav"> 
            <div class="navTop">
                 <!-- Tajuk utama sistem yang dipaparkan pada bahagian atas navigasi -->
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

        <center> 
            <!-- Tajuk utama bagi bahagian borang import maklumat kelas -->
            <h1 style="margin: 50px auto;">BORANG IMPORT MAKLUMAT KELAS</h1> 
            <div class="form-tambah"> 
                <br> 
                <!-- Borang untuk memuat naik fail dengan sokongan data jenis multipart -->
                <form method="POST" enctype='multipart/form-data'> 
                    <table style="width:fit-content;"> 
                        <tr> 
                            <!-- Ruangan input untuk memilih fail CSV yang ingin diimport -->
                            <td>Import File Di Sini>>><input style="font-size:18;" type='file' name='DataKelas'></td> 
                        </tr> 
                        <tr> 
                            <!-- Butang untuk menghantar borang bagi memulakan proses import -->
                            <td style="text-align:right;"><input type="submit" name="import" value='Import'></td> 
                        </tr> 
                    </table> 
                </form> 
            </div> 
        </center> 
        
    <footer> 
        <!-- Paparan maklumat hak cipta dan nama penyedia sistem -->
        <span>Disediakan oleh Chua Jing Hui</span> 
    </footer> 
            
    <?php 
        // Memanggil fail konfigurasi sambungan pangkalan data
        require "config.php"; 

        // Menyemak sama ada butang import telah ditekan melalui borang POST
        if(isset($_POST['import'])){ 
            // Memastikan fail telah dipilih sebelum memulakan pemprosesan
            if($_FILES['DataKelas']['name']){ 
                // Mengasingkan nama fail dan ekstensi untuk semakan format
                $arrFilename=explode('.',$_FILES['DataKelas']['name']); 

                // Menjalankan proses hanya jika fail yang dimuat naik berformat CSV
                if($arrFilename[1]=="csv"){ 
                    // Membuka fail sementara dalam mod baca (read-only)
                    $handle=fopen($_FILES['DataKelas']['tmp_name'],"r"); 

                    // Membaca kandungan fail CSV baris demi baris menggunakan gelung
                    while(($data=fgetcsv($handle,1000,","))!==FALSE){ 
                        // Menapis data item pertama untuk tujuan keselamatan SQL
                        $item1=mysqli_real_escape_string($sambungan,$data[0]); 
                        // Menapis data item kedua untuk tujuan keselamatan SQL
                        $item2=mysqli_real_escape_string($sambungan,$data[1]); 
                        // Menyediakan arahan SQL INSERT untuk memasukkan data kelas
                        $import="INSERT INTO `kelas`(`IDkelas`,`kelas`) VALUES('$item1','$item2')"; 
                        // Melaksanakan arahan SQL ke atas pangkalan data
                        mysqli_query($sambungan,$import); 
                    } 

                    // Menutup fail CSV setelah selesai proses pembacaan
                    fclose($handle); 
                    // Memaparkan mesej maklum balas berjaya dan menghalakan semula ke laman import
                    echo "<script>window.alert('Data kelas berjaya diimport.'); 
                    window.location.href='import.php';</script>"; 
                } 
            } 
        } 
    ?> 
    
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