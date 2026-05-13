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
                            <td>Import Fail Di Sini>>><input style="font-size:18;" type='file' name='DataKelas'></td> 
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
    require "config.php";

    if(isset($_POST['import'])){
        if($_FILES['DataKelas']['name']){
            $arrFilename = explode('.', $_FILES['DataKelas']['name']);

            if(end($arrFilename) == "csv"){
                $handle = fopen($_FILES['DataKelas']['tmp_name'], "r");
               
                $bilangan_berjaya = 0;
                $senarai_duplikasi = []; // Array untuk simpan ID yang bertindih

                while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
                    $item1 = mysqli_real_escape_string($sambungan, $data[0]);
                    $item2 = mysqli_real_escape_string($sambungan, $data[1]);
                   
                    if(!empty($item1)){
                        // 1. Semak dahulu jika ID sudah wujud dalam pangkalan data
                        $semak = mysqli_query($sambungan, "SELECT IDkelas FROM kelas WHERE IDkelas = '$item1'");
                       
                        if(mysqli_num_rows($semak) > 0){
                            // Jika wujud, masukkan ke dalam array duplikasi
                            $senarai_duplikasi[] = $item1;
                        } else {
                            // Jika tiada, baru buat INSERT
                            $import = "INSERT INTO `kelas`(`IDkelas`,`kelas`) VALUES('$item1','$item2')";
                            if(mysqli_query($sambungan, $import)){
                                $bilangan_berjaya++;
                            }
                        }
                    }
                }
                fclose($handle);

                // Menyediakan mesej untuk JavaScript
                $mesej = "Proses import berjaya.\\n";
                $mesej .= "Rekod Berjaya: $bilangan_berjaya\\n";

                // Jika ada duplikasi, tambahkan senarai ID ke dalam mesej
                if(count($senarai_duplikasi) > 0){
                    $mesej .= "\\nData Duplikasi Dikesan (Tidak diimport):\\n";
                    $mesej .= implode(", ", $senarai_duplikasi);
                }

                if($bilangan_berjaya == 0 && count($senarai_duplikasi) == 0){
                    echo "<script>window.alert('Gagal! Fail CSV tiada rekod.');
                    window.location.href='import.php';</script>";
                } else {
                    echo "<script>window.alert('$mesej');
                    window.location.href='import.php';</script>";
                }
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