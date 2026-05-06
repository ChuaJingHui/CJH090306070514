<?php
    // Memulakan pengurusan sesi pengguna untuk penyimpanan data sementara
    session_start();
    
    // Memanggil fail konfigurasi sambungan pangkalan data
    require('config.php'); 

    // Menyemak tindakan klik pengguna pada butang login
    if(isset($_POST['login'])){

        // Mengambil input ID Pengguna daripada borang POST
        $id_pengguna = $_POST['ic'];
        // Mengambil input Kata Laluan daripada borang POST
        $kata_laluan = $_POST['fpassword'];

        // Logik semakan khusus untuk akaun log masuk pentadbir
        if($id_pengguna === "123456789012" && $kata_laluan === "123") {
            // Memaparkan makluman berjaya log masuk sebagai pentadbir
            echo "<script>alert('Anda telah berjaya log masuk sebagai Admin.');</script>";
            // Menghantar pentadbir ke halaman utama pengurusan admin
            echo "<script>window.location.replace('lamanUtamaAdmin.php')</script>";
        }
        else {
            // Melaksanakan carian akaun pengguna dalam pangkalan data
            $rekod = mysqli_query($sambungan, "SELECT * FROM pengguna WHERE IDPengguna='$id_pengguna' AND KataLaluan='$kata_laluan'");

            // Mendapatkan jumlah rekod yang ditemui daripada hasil carian
            $hasilCarian = mysqli_num_rows($rekod);

            // Menyemak jika rekod pengguna wujud dalam pangkalan data
            if($hasilCarian > 0){ 
                // Menyimpan ID pengguna ke dalam pembolehubah sesi
                $_SESSION['ic'] = $id_pengguna;

                // Memaparkan makluman berjaya log masuk bagi pengguna biasa
                echo "<script>alert('Anda telah berjaya log masuk.');</script>";
                // Menghantar pengguna ke halaman proses pengundian
                echo "<script>window.location.replace('undi.php')</script>";
            }
            else {
                // Memaparkan makluman ralat sekiranya kredential tidak sepadan
                echo "<script>alert('Harap Maaf. ID Pengguna atau Kata Laluan anda salah.');
                window.location.replace('login.php');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Menetapkan tajuk laman yang dipaparkan pada tab pelayar -->
        <title>Log Masuk</title>
        <!-- Menghubungkan fail CSS luaran untuk gaya reka bentuk laman -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <!-- Tajuk utama sistem yang dipaparkan pada bahagian atas navigasi -->
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
 
      </nav>

      <div id="pilihan-warna">
        <!-- Pilihan penukaran warna latar belakang ke merah jambu -->
        <div class="kotak" style="background: #f59e9e98;" onclick="tukarWarna('#f59e9e98')"></div>
        <!-- Pilihan penukaran warna latar belakang ke hijau laut -->
        <div class="kotak" style="background: #beecdf8a;" onclick="tukarWarna('#beecdf8a')"></div>
        <!-- Pilihan penukaran warna latar belakang ke ungu lembut -->
        <div class="kotak" style="background: #dbbaf16e;" onclick="tukarWarna('#dbbaf16e')"></div>
        <!-- Pilihan penukaran warna latar belakang ke kelabu cerah -->
        <div class="kotak" style="background: #dfe6e9;" onclick="tukarWarna('#dfe6e9')"></div>
        <!-- Pilihan penukaran warna latar belakang ke putih -->
        <div class="kotak" style="background: #ffffff;" onclick="tukarWarna('#ffffff')"></div>
    </div>

    <script>
        // Fungsi JavaScript untuk menukar warna latar belakang badan dokumen
        function tukarWarna(warna) {
            // Mengubah nilai warna latar belakang elemen body
            document.body.style.backgroundColor = warna;
        }
    </script>
    
      <center>
        <!-- Tajuk halaman bagi bahagian log masuk -->
        <h1 style="margin-top:100px;">LOG MASUK</h1>
      

      <form action="login.php" method="POST">
        <table>
            
            <tr>
              <!-- Label bagi medan ID Pengguna -->
              <td style="text-align:left; width:10px;">IDPengguna:</td><td colspan="3">
                <!-- Medan input untuk memasukkan ID Pengguna -->
                <input type="text" id="ic" name="ic" placeholder="IDPengguna" class="user">
              </td>
            </tr>
            
            <tr>
              <!-- Label bagi medan Kata Laluan -->
              <td style="text-align:right; width:10px;">Kata Laluan:</td>
              <td >
                <div class="password-container">
                  <!-- Medan input kata laluan dengan mod privasi -->
                  <input type="password" id="fpassword" name="fpassword" placeholder="Kata Laluan" class="user">
                  <!-- Ruangan untuk meletakkan ikon penukar paparan kata laluan -->
                  <span id="togglePassword" class="eye-icon"></span> 
                </div>
              </td>
            </tr>
            
            <tr>
              <!-- Pautan navigasi ke halaman pendaftaran akaun baharu -->
              <td colspan="3"><a href="register.php" class="register">Daftar Akaun Baharu?</a></td>
            </tr>
            <tr>
              <!-- Butang untuk menghantar borang bagi tujuan pengesahan log masuk -->
              <td colspan="3" style="text-align: center; padding-right: 50px;"><input type="submit" name="login" value="Sahkan" class="btn"></td>
            </tr>
          </table>
      </form>

      <script>
        // Mengambil elemen ikon mata untuk fungsi tukar paparan
        const togglePassword = document.getElementById('togglePassword');
        // Mengambil elemen input kata laluan
        const passwordInput = document.getElementById('fpassword');

        // Mendefinisikan kod SVG bagi ikon mata terbuka
        const eyeOpen = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;

        // Mendefinisikan kod SVG bagi ikon mata tertutup (disilang)
        const eyeClosed = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>`;

        // Menetapkan ikon mata tertutup sebagai paparan asal
        togglePassword.innerHTML = eyeClosed;

        // Menambah fungsi pendengar klik pada elemen ikon mata
        togglePassword.addEventListener('click', function () {
            // Memeriksa jika jenis input semasa adalah jenis password
            const isPassword = passwordInput.getAttribute('type') === 'password';
    
            // Menukar jenis input antara 'text' dan 'password' berdasarkan keadaan semasa
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
    
            // Mengubah paparan ikon selari dengan perubahan jenis input teks
            this.innerHTML = isPassword ? eyeOpen : eyeClosed; 
        });
      </script>

      </center>
      
      <footer>
        <!-- Paparan maklumat hak cipta dan nama penyedia sistem di bahagian kaki -->
        <span>Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>