<!DOCTYPE html>
<html>
    <head>
        <title>Pengundian</title>
        <link rel="stylesheet" href="styles.css">
        
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
          <a href="login.php" class="nav-btn">LOG MASUK</a>
          <a href="laporan.php" class="nav-btn">LAPORAN</a>
          <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
      </nav>

      <!--MEMBUAT PENGUNDIAN-->
        <form onsubmit="" action="" method="GET">
            <table class="undi">
                <tr>
                    <td>
                        <u>Permainan Tradisional</u>
                        <img src="https://umbiofficial.com/cdn/shop/articles/nostalgic-permainan-tradisional-you-might-miss-2509474.jpg?v=1757095395" alt="Permainan Tradisional" >
                        <p>Definisi:Permainan yang menggunakan alat sederhana dan diwariskan secara turun-termurun.</p>
                    </td>
                    <td>
                        <u>Permainan Digital</u>
                        <img src="https://www.sinarharian.com.my/sinarbestari/uploads/2021/06/1091985.jpg" alt="Permainan Digital" >
                        <p>Definisi:Permainan yang dimainkan melalui perangkat elektrik.</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" id="pilih_tradisional" name="fpilih" value="U01" class="pilih" required>
                        <label for="pilih_tradisional">Pilih</label>
                    </td>
                    <td>
                        <input type="radio" id="pilih_digital" name="fpilih" value="U02" class="pilih" required>
                        <label for="pilih_digital">Pilih</label>
                    </td>
                </tr>
            <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="undi" value="Sahkan" class="btn">
                    </td>
                </tr>
            </table>
        </form>
      <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>
<?php
    //Menghubung ke pangkalan data
    require('config.php');

    if(isset($_GET['undi'])){

    //Mengumpuk pemboleh ubah untuk menyimpan data daripada pengguna
    $ic=;
    $pilihan=$_GET['fpilih'];
    $date=date("Y-m-d H:i:s");

    $sqlInsertUndi=mysqli_query($con,"INSERT INTO maklumat_pengundian(`IDPengguna`,`IDPermainan`,`Tarikh`) VALUES('$ic','$pilihan','$date')");

    //Menyemak jika memenuhi semua keadaan, tambah rekod ke dalam jadual dan memaparkan mesej
    if($sqlInsertUndi)
        {
        echo"<script>alert('Pengundian telah berjaya ! Jumlah undian sedang dikira.');
            window.location.replace('laporanPengundi.php');</script>";
        }
    else{
        echo"<script>alert('Pengundian anda gagal ! Sila membuat pengundian.');
            window.location.replace('undi.php');</script>";
    }
    }

?>