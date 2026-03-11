<!DOCTYPE html>
<html>
    <head>
        <title>Pendaftaran</title>
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

      <center>
        <h1>Pendaftaran</h1>
      <!--Key in daftar maklumat-->
      <form onsubmit="return validateIC()" action="ProsesPendaftaran.php" method="GET">

        <table class="register">
            <tr>
              <td colspan="3">
                <input type="text" id="ic" name="ic" placeholder="IDPengguna(No.KP)" class="user" required>
                  <!-- Tooltip moved inside the TD -->
                  <div id="icTooltip" class="tooltip" style="display:none;">
                      IC number must be exactly 12 digits (number only)
                  </div>
                </td>
            </tr>
            <tr>
              <td colspan="3"><input type="text" id="fname" name="fname" placeholder="Nama" class="user" required></td>
            </tr>
            <tr>
              <td colspan="3">
                <select name='Kelas' required>
                 <?php
                    require('config.php');
                    //Untuk memaparkan query kelas
                    $sqlSelectKelas="SELECT * FROM Kelas";
                    $data=$con->query($sqlSelectKelas);

                    print"<option>Pilih Kelas</option>";
                    if($data->num_rows>0){
                      while($row = $data->fetch_assoc()){
                          //Fetch a result row as an associative array:
                              echo "<option value='".$row['IDKelas']."'>"
                            .$row['Kelas']."</option>";
                          }
                    }
                ?>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="3"><input type="text" id="fpassword" name="fpassword" placeholder="Kata Laluan" class="user" required></td>
            </tr>
            <tr>
              <td colspan="3"><a href="login.php" class="register">Sudah Daftar?</a></td>
            </tr>

            <!--daftar botton after key in maklumat-->
            <tr>
              <td style="text-align: right;padding-right:20%;"><input type="submit" value="Sahkan" class="btn"></td>
            </tr>
        </table>
      </form>
      </center>

      <script>
      function validateIC(){
  const ic = document.getElementById("ic");
  const tooltip = document.getElementById("icTooltip");

  // Use capital L in classList
  if(ic.value.length !== 12){
    ic.classList.add("invalid"); 
    tooltip.style.display = "block";
    return false;
  } else {
    ic.classList.remove("invalid");
    tooltip.style.display = "none";
    return true;
  }
}

      document.getElementById("ic").addEventListener("input", validateIC);
      
      </script>
    
      
      <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>
<?php

    //Menghubung ke pangkalan data
    require('config.php');

    if(isset($_GET['register'])){

    //Mengumpuk pemboleh ubah untuk menyimpan data daripada pengguna
    $name=$_GET['nama'];
    $noKP=$_GET['noKP'];
    $password=$_GET['kataLaluan'];
    $kelas=$_GET['kelas'];

    $sqlInsertPengguna=mysqli_query($con,"INSERT INTO `pengguna`(`IDPengguna`,`KataLaluan`) VALUES('$noKP','$password')");
    $sqlInsertPengundi=mysqli_query($con,"INSERT INTO `pengundi`(`IDPengguna`,`Nama`,`IDKelas`) VALUES('$noKP','$name','$kelas')");

    //Menyemak jika memenuhi semua keadaan, tambah rekod ke dalam jadual dan memaparkan mesej
    if($sqlInsertPengguna && $sqlInsertPengundi)
        {
        echo"<script>alert('Pendaftaran berjaya! Anda boleh gunakan IDPengguna sebagai nama untuk mengundi.');
            window.location='login.php';</script>";
        }
    else{
        echo"<script>alert('Pendaftaran akaun baharu gagal ! IDPengguna yang dimasukkan telah wujud.');
            window.location='register.php';</script>";
    }
    }

?>