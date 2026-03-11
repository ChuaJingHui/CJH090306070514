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
      <form onsubmit="return validateIC()" action="register.php" method="GET">

        <table class="register" style="width: 60%; margin: auto;"> <tr>
              <td colspan="3">
                <input type="text" id="ic" name="ic" placeholder="IDPengguna(No.KP)" class="user" required>
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
                <select name='Kelas' class="user" required>
                 <?php
                    require('config.php');
                    //Untuk memaparkan query kelas
                    $sqlSelectKelas="SELECT * FROM Kelas";
                    $data=$con->query($sqlSelectKelas);

                    print"<option value=''>Pilih Kelas</option>"; // Added value='' to default option
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
              <td colspan="3">
                <div class="password-container">
                  <input type="password" id="fpassword" name="fpassword" placeholder="Kata Laluan" class="user" required>
                  <span id="togglePassword" class="eye-icon"></span>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="text-align: center;"><a href="login.php" class="register">Sudah Daftar?</a></td> 
            </tr>
            <tr>
              <td colspan="3" style="text-align: right; padding-right: 50px;"><input type="submit" name="register" value="Sahkan" class="btn"></td>
            </tr>
        </table>
      </form>
      <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('fpassword');

        // 1. Define the professional SVG icons (Open Eye and Closed/Slashed Eye)
        const eyeOpen = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;

        const eyeClosed = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>`;

        // 2. Set the starting icon inside the span
        togglePassword.innerHTML = eyeClosed;

        // 3. The click function
        togglePassword.addEventListener('click', function () {
            // Check if the password is currently hidden
            const isPassword = passwordInput.getAttribute('type') === 'password';
    
            // Toggle the input type between 'text' and 'password'
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
    
            // Swap the icon using innerHTML instead of textContent
            // Shows closed eye when visible, open eye when hidden
            this.innerHTML = isPassword ? eyeOpen : eyeClosed; 
        });
      </script>

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
    $noKP=$_GET['ic'];
    $name=$_GET['fname'];
    $kelas=$_GET['Kelas'];
    $password=$_GET['fpassword'];

    $sqlInsertPengguna=mysqli_query($con,"INSERT INTO pengguna(`IDPengguna`,`KataLaluan`) VALUES('$noKP','$password')");
    $sqlInsertPengundi=mysqli_query($con,"INSERT INTO pengundi(`IDPengguna`,`Nama`,`IDKelas`) VALUES('$noKP','$name','$kelas')");

    //Menyemak jika memenuhi semua keadaan, tambah rekod ke dalam jadual dan memaparkan mesej
    if($sqlInsertPengguna && $sqlInsertPengundi)
        {
        echo"<script>alert('Pendaftaran berjaya! Anda boleh gunakan IDPengguna sebagai nama untuk mengundi.');
            window.location='login.php';</script>";
        }
    else{
        echo"<script>alert('Pendaftaran akaun baharu gagal ! IDPengguna yang dimasukkan telah wujud.');
            window.location.replace('register.php');</script>";
    }
    }

?>