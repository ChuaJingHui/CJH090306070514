<?php
// Tetapan fail sambungan pangkalan data
require "config.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Laman Utama</title>
        <link rel="stylesheet" href="styles.css">
        
    </head>
    <body>
      /* Butang untuk log masuk pada laman utama */
      <style>
        .btn{
          background-color:#008CBA;
        }
        .btn-login {
          display: flex;
          text-align: center;
          justify-content: center;
          margin: 20px auto;
          width: 100%;      
          color: black;     
          font-weight: bold;
          display: inline-block;
          text-decoration: none;
        }
        .btn:hover {
          background-color: #005f80; 
        }

      </style>

      <nav class="nav">
        <div class="navTop">
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
            <a href="lamanUtama.php" class="nav-btn">LAMAN UTAMA</a>
            <a href="register.php" class="nav-btn">DAFTAR</a>
            <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
 
      </nav>

      <center>
        <h1 style="margin:100px auto; font-size:60px;"> SELAMAT DATANG! </h1>
        <h2 style="font-size:40px;">Klik Sini Untuk Log Masuk Dalam Sistem Pengundian Permainan Kegemaran Remaja</h2>

        <div class="btn">
            <a href="login.php" class="btn-login" style="font-size:30px;">LOG MASUK</a>
        </div>




      </center>
      
      <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>