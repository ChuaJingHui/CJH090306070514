<?php
// Memanggil fail konfigurasi sambungan pangkalan data
require "config.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Menetapkan tajuk laman yang dipaparkan pada tab pelayar -->
        <title>Laman Utama</title>
        <!-- Menghubungkan fail CSS luaran untuk gaya reka bentuk -->
        <link rel="stylesheet" href="styles.css">
        
    </head>
    <body>
      <style>
        /* Gaya asas untuk elemen kelas btn */
        .btn{
          /* Menetapkan warna latar belakang biru */
          background-color:#008CBA;
        }
        /* Gaya untuk butang log masuk termasuk susunan teks dan rupa bentuk */
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
        /* Kesan perubahan warna apabila tetikus berada di atas butang */
        .btn:hover {
          background-color: #005f80; 
        }

      </style>

      <nav class="nav">
        <div class="navTop">
          <!-- Tajuk utama sistem di bahagian navigasi atas -->
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>

 
      </nav>

      <!-- Menyelaraskan kedudukan semua kandungan utama ke tengah -->
      <center>
        <!-- Paparan teks selamat datang yang besar di tengah laman -->
        <h1 style="margin-top:100px; font-size:60px;"> SELAMAT DATANG KE SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA! </h1>

        <div class="lamanUtama">
          <!-- Menyusun atur kedudukan imej menggunakan struktur jadual -->
          <table>
          <tr>
            <!-- Memaparkan imej rujukan bagi kategori permainan digital -->
            <td><img src="https://www.sinarharian.com.my/sinarbestari/uploads/2021/06/1091985.jpg" alt="Permainan Digital"></td>
            <!-- Memaparkan imej rujukan bagi kategori permainan tradisional -->
            <td><img src="https://umbiofficial.com/cdn/shop/articles/nostalgic-permainan-tradisional-you-might-miss-2509474.jpg?v=1757095395" alt="Permainan Tradisional"></td>
          </tr>
          </table>  
        </div>

        <div class="btn">
            <!-- Pautan navigasi ke halaman log masuk dengan penggayaan butang -->
            <a href="login.php" class="btn-login" style="font-size:30px;">LOG MASUK</a>
        </div>




      </center>
      
      <footer>
        <!-- Paparan maklumat hak cipta dan penyedia sistem di bahagian kaki -->
        <span class="hak_cipta">Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>