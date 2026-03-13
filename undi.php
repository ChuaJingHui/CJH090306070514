<?php
    session_start();
    //Menghubung ke pangkalan data
    require('config.php');

    if(!isset($_SESSION['ic'])){
    header("Location:login.php");
    exit();
}

$noKP=$_SESSION['ic'];

$semak=mysqli_query($con,"SELECT * FROM maklumat_pengundian WHERE IDPengguna='$noKP'");

if(!$semak){
    die("Query semak undian gagal:".mysqli_error($con));
}
$sudah_undi=mysqli_num_rows($semak)>0;



    if(isset($_POST['undi'])){

    //Mengumpuk pemboleh ubah untuk menyimpan data daripada pengguna
    $pilihan=$_POST['fpilih'];
    date_default_timezone_set("Asia/Kuala_Lumpur");



    //Simpan Undian
    $sqlInsertUndi = mysqli_query($con, "INSERT INTO maklumat_pengundian(`IDPengguna`,`IDPermainan`,`Tarikh`) 
                 VALUES('$noKP', '$pilihan', NOW())");

    //Menyemak jika memenuhi semua keadaan, tambah rekod ke dalam jadual dan memaparkan mesej
    if($sqlInsertUndi){
        echo "<script>alert('Undian berjaya dihantar');window.location='keputusan.php'</script>";
    }
    else{
        die("Insert undi gagal: ".mysqli_error($con));
    }
    }
?>


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
          <a href="undi.php" class="nav-btn">UNDI</a>
          <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
      </nav>

      <!--MEMBUAT PENGUNDIAN-->
        <form action="undi.php" method="POST">
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