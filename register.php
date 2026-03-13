<?php
// Memanggil sambungan pangkalan data
require('config.php');

// Menyemak tindakan butang daftar
if(isset($_POST['daftar_akaun'])){

    // Menyimpan data POST ke dalam pembolehubah
    $no_kp = $_POST['no_kad_pengenalan'];
    $nama_pengguna = $_POST['nama_penuh'];
    $kelas_pilihan = $_POST['pilihan_kelas'];
    $kata_laluan = $_POST['kata_laluan'];

    // Arahan memasukkan data ke dalam pangkalan data
    $tambah_pengguna = mysqli_query($sambungan,"INSERT INTO pengguna(`IDPengguna`,`KataLaluan`) VALUES('$no_kp','$kata_laluan')");
    $tambah_pengundi = mysqli_query($sambungan,"INSERT INTO pengundi(`IDPengguna`,`Nama`,`IDKelas`) VALUES('$no_kp','$nama_pengguna','$kelas_pilihan')");

    // Jika kedua-dua arahan SQL berjaya dilaksana
    if($tambah_pengguna && $tambah_pengundi) {
        echo "<script>alert('Pendaftaran berjaya! Anda boleh gunakan ID Pengguna sebagai nama untuk mengundi.');
              window.location='login.php';</script>";
    } else {
        echo "<script>alert('Pendaftaran akaun baharu gagal! ID Pengguna yang dimasukkan telah wujud.');
              window.location.replace('register.php');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>PENDAFTARAN</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
          <a href="login.php" class="nav-btn">LOG MASUK</a>
          <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
      </nav>

      <center>
        <h1>PENDAFTARAN</h1>
      
      <form onsubmit="return validateIC()" action="register.php" method="POST">
        <table class="register" style="width: 60%; margin: auto;"> 
            <tr>
              <td colspan="3">
                <input type="text" id="ic" name="no_kad_pengenalan" placeholder="ID Pengguna (No. KP tanpa sengkang)" class="user" required>
                  <div id="icTooltip" class="tooltip" style="display:none;">
                      ID Pengguna mesti mengandungi tepat 12 digit (nombor sahaja).
                  </div>
                </td>
            </tr>
            <tr>
              <td colspan="3"><input type="text" id="nama_penuh" name="nama_penuh" placeholder="Sila masukkan Nama Penuh" class="user" required></td>
            </tr>
            <tr>
              <td colspan="3">
                <select name='pilihan_kelas' class="user" required>
                <?php
                    // Mendapatkan senarai kelas dari pangkalan data untuk paparan dropdown
                    $arahan_pilih_kelas = "SELECT * FROM Kelas";
                    $data_kelas = mysqli_query($sambungan, $arahan_pilih_kelas);

                    print "<option value=''>-- Sila Pilih Kelas --</option>"; 
                    
                    if(mysqli_num_rows($data_kelas) > 0){
                      while($baris_kelas = mysqli_fetch_assoc($data_kelas)){
                              echo "<option value='" . $baris_kelas['IDKelas'] . "'>" . $baris_kelas['Kelas'] . "</option>";
                          }
                    }
                ?>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <div class="password-container">
                  <input type="password" id="kata_laluan" name="kata_laluan" placeholder="Kata Laluan" class="user" required>
                  <span id="togglePassword" class="eye-icon"></span>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="text-align: center;"><a href="login.php" class="register">Sudah mempunyai akaun? Log masuk di sini.</a></td> 
            </tr>
            <tr>
              <td colspan="3" style="text-align: right; padding-right: 50px;">
                  <input type="submit" name="daftar_akaun" value="Sahkan Pendaftaran" class="btn">
              </td>
            </tr>
        </table>
      </form>

      <script>
        const suisKataLaluan = document.getElementById('togglePassword');
        const inputKataLaluan = document.getElementById('kata_laluan');

        const mataTerbuka = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;
        const mataTertutup = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>`;

        suisKataLaluan.innerHTML = mataTertutup;

        suisKataLaluan.addEventListener('click', function () {
            const modKataLaluan = inputKataLaluan.getAttribute('type') === 'password';
            inputKataLaluan.setAttribute('type', modKataLaluan ? 'text' : 'password');
            this.innerHTML = modKataLaluan ? mataTerbuka : mataTertutup; 
        });

        function validateIC(){
          const kotak_ic = document.getElementById("ic");
          const kotak_amaran = document.getElementById("icTooltip");

          if(kotak_ic.value.length !== 12 || isNaN(kotak_ic.value)){
            kotak_ic.classList.add("invalid"); 
            kotak_amaran.style.display = "block";
            return false;
          } else {
            kotak_ic.classList.remove("invalid");
            kotak_amaran.style.display = "none";
            return true;
          }
        }
        document.getElementById("ic").addEventListener("input", validateIC);
      </script>
      </center>
      
      <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>