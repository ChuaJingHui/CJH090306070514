<!DOCTYPE html>
<html>
    <head>
        <title>Log Masuk</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
          <a href="register.php" class="nav-btn">DAFTAR</a>
          <a href="laporan.php" class="nav-btn">LAPORAN</a>
          <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
 
      </nav>

      <center>
        <h1>LOG MASUK</h1>
      

      <form action="laporan.php" method="POST">
        <table>
            <tr>
              <td colspan="3"><input type="text" id="fIC" name="fIC" placeholder="IDPengguna" class="user" required></td>
            </tr>
            <tr>
              <td colspan="3"><input type="text" id="fpassword" name="fpassword" placeholder="Kata Laluan" class="user" required></td>
            </tr>
            <tr>
              <td colspan="3"><a href="register.php" class="register">Daftar Akaun Baharu?</a></td>
            </tr>
            <tr>
              <td style="text-align: right;padding-right:20%;"><input type="submit" value="Sahkan" class="btn"></td>
            </tr>
          </table>
      </form>
      </center>
      
      <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>
<?php

    //Menghubung ke pangkalan data
    require('config.php'); //require('config.php');

    if(isset($_GET['login'])){

    //Mengumpukkan pemboleh ubah untuk menyimpan data daripada pengguna
    $username=$_GET['username'];
    $password=$_GET['password'];

    if($username==="admin" && $password==="123")
    {
      echo"<script>alert('Anda telah berjaya log masuk.');</script>";
      echo"<script>windwo.location.replace('laporan.php')</script>";
    }
    else{
      //Melakukan query untuk mengesahkan akaun pengguna
      $rekod=mysqli_query($con,"SELECT* FROM 'Pengguna' WHERE IDPengguna='$username' AND KataLaluan='$password'");

      //Hasil carian rekod dari Pangkalan Data
      $hasilCarian=mysqli_num_rows($rekod);

      //Semak pengguna berjaya atau gagal untuk log masuk ke dalam sistem 
      if($hasilCarian>0){   //if((hasilCarian>0)or($hasilCarianPeserta>0))

        echo "<script>alert('Anda telah berjaya log masuk.');</script>";
        echo "<script>window.location.replace('undi.php')</script>";
      }
      else{
        echo "<script>alert('Harap Maaf.Username atau Password anda salah');
        windows.location.replace('login.php');</script>";
      }
    }
    }

?>

