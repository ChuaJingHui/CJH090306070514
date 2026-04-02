<!DOCTYPE html>
<html>
<head>
    <title>Borang Import Maklumat Kelas</title>
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
        <h1 style="margin: 20px 0;">BORANG IMPORT MAKLUMAT KELAS</h1>
        
        <div class="form-tambah">
                <br>
                <form method="POST" enctype='multipart/form-data'>
                    <table style="width:fit-content;">
                        <tr>
                            <td>Import File Di Sini>>><input style="font-size:18;" type='file' name='DataKelas' required>
                        </tr>
                        <tr>
                            <td style="text-align:right;"><input type="submit" name="import" value='Import'></td>
                        </tr>
                    </table>
                </form>
        </div>
    </center>

    <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
    </footer>
    <?php
        // Memanggil fail konfigurasi pangkalan data
        require "config.php";

        if(isset($_POST['import'])){
            if($_FILES['DataKelas']['name']){
                $arrFilename=explode('.',$_FILES['DataKelas']['name']);

                if($arrFilename[1]=="csv"){
                    $handle=fopen($_FILES['DataKelas']['tmp_name'],"r");
                    while(($data=fgetcsv($handle,1000,","))!==FALSE){
                        $item1=mysqli_real_escape_string($sambungan,$data[0]);
                        $item2=mysqli_real_escape_string($sambungan,$data[1]);
                        $import="INSERT INTO `kelas`(`IDkelas`,`kelas`) VALUES('$item1','$item2')";
                        mysqli_query($sambungan,$import);
                    }
                    fclose($handle);
                    echo "<script>window.alert('Data kelas berjaya diimport.');
                    windows.location.href='import.php';</script>";
                }
            }
        }

    ?>
</body>
</html>
