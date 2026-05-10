<?php
// Memanggil fail konfigurasi sambungan pangkalan data
require('config.php');

// Menyemak jika butang dengan nama daftar_akaun telah ditekan
if(isset($_POST['daftar_akaun'])){

    // Mengambil data nombor kad pengenalan daripada input borang
    $no_kp = $_POST['no_kad_pengenalan'];
    // Mengambil data nama penuh daripada input borang
    $nama_pengguna = $_POST['nama_penuh'];
    // Mengambil data ID kelas daripada menu lungsur
    $kelas_pilihan = $_POST['pilihan_kelas'];
    // Mengambil data kata laluan daripada input borang
    $kata_laluan = $_POST['kata_laluan'];

    // Melaksanakan arahan SQL untuk memasukkan data ke dalam jadual pengguna
    $tambah_pengguna = mysqli_query($sambungan,"INSERT INTO pengguna(`IDPengguna`,`KataLaluan`) VALUES('$no_kp','$kata_laluan')");
    // Melaksanakan arahan SQL untuk memasukkan data ke dalam jadual pengundi
    $tambah_pengundi = mysqli_query($sambungan,"INSERT INTO pengundi(`IDPengguna`,`Nama`,`IDKelas`) VALUES('$no_kp','$nama_pengguna','$kelas_pilihan')");

    // Menyemak jika kedua-dua proses kemasukan data ke pangkalan data berjaya
    if($tambah_pengguna && $tambah_pengundi) {
        // Memaparkan mesej berjaya dan menghalakan pengguna ke halaman log masuk
        echo "<script>alert('Pendaftaran berjaya! Anda boleh gunakan ID Pengguna sebagai nama untuk mengundi.');
              window.location='index.php';</script>";
    } else {
        // Memaparkan mesej ralat sekiranya ID Pengguna telah wujud dalam sistem
        echo "<script>alert('Pendaftaran akaun baharu gagal! ID Pengguna yang dimasukkan telah wujud.');
              window.location.replace('register.php');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Menetapkan tajuk laman yang dipaparkan pada tab pelayar -->
        <title>PENDAFTARAN</title>
        <!-- Menghubungkan fail gaya CSS luaran untuk reka bentuk laman -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <!-- Tajuk utama sistem yang dipaparkan pada bar navigasi -->
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>

      </nav>

      <center>
        <!-- Tajuk halaman pendaftaran -->
        <h1 style="margin-top:100px;">PENDAFTARAN</h1>
      
      <!-- Memulakan borang dengan fungsi pengesahan JavaScript sebelum dihantar -->
      <form onsubmit="return validateIC()" action="register.php" method="POST">
        <table class="register" style="width: 60%; margin: auto;"> 
            <tr>
              <!-- Label bagi medan ID Pengguna -->
              <td style="text-align:right; white-space:nowrap; width:150px;">ID Pengguna:</td>
              <td colspan="3">
                <!-- Medan input untuk ID Pengguna (No Kad Pengenalan) -->
                <input type="text" id="ic" name="no_kad_pengenalan" placeholder="ID Pengguna (No. KP tanpa sengkang)" class="user" >
                  <!-- Ruangan amaran format ID Pengguna yang tidak dipaparkan secara lalai -->
                  <div id="icTooltip" class="tooltip" style="display:none;">
                      ID Pengguna mesti mengandungi tepat 12 digit (nombor sahaja).
                  </div>
                </td>
            </tr>
            <tr>
              <!-- Label bagi medan Nama Penuh -->
              <td style="text-align:right; white-space:nowrap; padding-right:10px;">Nama Penuh:</td>
              <!-- Medan input untuk Nama Penuh -->
              <td colspan="3"><input type="text" id="nama_penuh" name="nama_penuh" placeholder="Sila Masukkan Nama Penuh" class="user" ></td>
            </tr>
            <tr>
              <!-- Label bagi medan Kelas -->
              <td style="text-align:right; white-space:nowrap; padding-right:10px;">Kelas:</td>
              <td colspan="3">
                <!-- Menu lungsur untuk memilih kelas -->
                <select name='pilihan_kelas' class="user">
                <!--Memulakan blok PHP untuk mengambil senarai kelas daripada pangkalan data-->
                <?php
                    // Menyediakan arahan SQL untuk mendapatkan semua data kelas
                    $arahan_pilih_kelas = "SELECT * FROM Kelas";
                    // Menjalankan query carian kelas
                    $data_kelas = mysqli_query($sambungan, $arahan_pilih_kelas);

                    // Memaparkan pilihan asal sebagai arahan kepada pengguna
                    print "<option value=''>-- Sila Pilih Kelas --</option>"; 
                    
                    // Menyemak jika terdapat rekod kelas dalam pangkalan data
                    if(mysqli_num_rows($data_kelas) > 0){
                      // Melakukan gelung untuk memaparkan setiap baris rekod kelas
                      while($baris_kelas = mysqli_fetch_assoc($data_kelas)){
                              // Memasukkan nama kelas ke dalam elemen pilihan menu lungsur
                              echo "<option value='" . $baris_kelas['IDKelas'] . "'>" . $baris_kelas['Kelas'] . "</option>";
                          }
                    }
                ?>
                </select>
              </td>
            </tr>
            <tr>
              <!-- Label bagi medan Kata Laluan -->
              <td style="text-align:right; white-space:nowrap; padding-right:10px;">Kata Laluan:</td>
              <td colspan="3">
                <div class="password-container">
                  <!-- Medan input kata laluan dengan mod privasi -->
                  <input type="password" id="kata_laluan" name="kata_laluan" placeholder="Kata Laluan" class="user">
                  <!-- Ruangan untuk meletakkan ikon penukar paparan kata laluan -->
                  <span id="togglePassword" class="eye-icon"></span>
                </div>
              </td>
            </tr>
            <tr>
              <!-- Pautan navigasi untuk pengguna yang sudah mempunyai akaun -->
              <td colspan="3" style="text-align: center;"><a href="index.php" class="register">Sudah mempunyai akaun? Log masuk di sini.</a></td> 
            </tr>
            <tr>
              <td colspan="3" style="text-align: right; padding-right: 50px;">
                  <!-- Butang untuk menghantar borang pendaftaran -->
                  <input type="submit" name="daftar_akaun" value="Sahkan" class="btn">
              </td>
            </tr>
        </table>
      </form>

      <script>
        // Mengambil elemen ikon mata untuk fungsi tukar paparan
        const suisKataLaluan = document.getElementById('togglePassword');
        // Mengambil elemen input kata laluan
        const inputKataLaluan = document.getElementById('kata_laluan');

        // Mendefinisikan kod SVG bagi ikon mata terbuka
        const mataTerbuka = `<svg xmlns="http://www.w3.org/2000/svg"
         width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" 
         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
         <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;
        // Mendefinisikan kod SVG bagi ikon mata tertutup
        const mataTertutup = `<svg xmlns="http://www.w3.org/2000/svg" 
        width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" 
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 
        4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
        </path><line x1="1" y1="1" x2="23" y2="23"></line></svg>`;

        // Menetapkan rupa ikon awal kepada mata tertutup
        suisKataLaluan.innerHTML = mataTertutup;

        // Menambah fungsi pendengar klik pada ikon mata
        suisKataLaluan.addEventListener('click', function () {
            // Memeriksa mod paparan input semasa
            const modKataLaluan = inputKataLaluan.getAttribute('type') === 'password';
            // Menukar jenis input antara 'text' dan 'password'
            inputKataLaluan.setAttribute('type', modKataLaluan ? 'text' : 'password');
            // Mengubah ikon berdasarkan mod paparan terkini
            this.innerHTML = modKataLaluan ? mataTerbuka : mataTertutup; 
        });

        // Fungsi untuk mengesahkan format ID Pengguna (No KP)
        function validateIC(){
          // Mengambil elemen input IC
          const kotak_ic = document.getElementById("ic");
          // Mengambil elemen tooltip ralat
          const kotak_amaran = document.getElementById("icTooltip");

          // Menyemak syarat panjang tepat 12 digit dan mestilah nombor
          if(kotak_ic.value.length !== 12 || isNaN(kotak_ic.value)){
            // Menambah kelas CSS invalid untuk tanda ralat visual
            kotak_ic.classList.add("invalid"); 
            // Memaparkan mesej amaran kepada pengguna
            kotak_amaran.style.display = "block";
            // Menghalang proses penghantaran borang
            return false;
          } else {
            // Membuang kelas invalid sekiranya input sah
            kotak_ic.classList.remove("invalid");
            // Menyembunyikan mesej amaran format
            kotak_amaran.style.display = "none";
            // Membenarkan proses penghantaran borang
            return true;
          }
        }
        // Menjalankan fungsi validateIC setiap kali pengguna menaip di kotak ID Pengguna
        document.getElementById("ic").addEventListener("input", validateIC);
      </script>
      </center>
      
      <footer>
        <!-- Paparan maklumat hak cipta dan penyedia sistem di bahagian kaki -->
        <span>Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>