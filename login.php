<?php
    session_start();
    //Menghubung ke pangkalan data
    require('config.php'); //require('config.php');

    if(isset($_POST['login'])){

    //Mengumpukkan pemboleh ubah untuk menyimpan data daripada pengguna
    $nama=$_POST['ic'];
    $password=$_POST['fpassword'];

    if($nama==="admin" && $password==="123")
    {
      echo"<script>alert('Anda telah berjaya log masuk.');</script>";
      echo"<script>window.location.replace('laporan.php')</script>";
    }
    else{
      //Melakukan query untuk mengesahkan akaun pengguna
      $rekod=mysqli_query($con,"SELECT * FROM Pengguna WHERE IDPengguna='$nama' AND KataLaluan='$password'");

      //Hasil carian rekod dari Pangkalan Data
      $hasilCarian=mysqli_num_rows($rekod);

      //Semak pengguna berjaya atau gagal untuk log masuk ke dalam sistem 
      if($hasilCarian>0){   //if((hasilCarian>0)or($hasilCarianPeserta>0))

        $_SESSION['ic']=$nama;

        echo "<script>alert('Anda telah berjaya log masuk.');</script>";
        echo "<script>window.location.replace('undi.php')</script>";
      }
      else{
        echo "<script>alert('Harap Maaf.Username atau Kata Laluan anda salah');
        window.location.replace('login.php');</script>";
      }
    }
    }

?>

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
          <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
 
      </nav>

      <center>
        <h1>LOG MASUK</h1>
      

      <form action="login.php" method="POST">
        <table>
            <tr>
              <td colspan="3"><input type="text" id="ic" name="ic" placeholder="IDPengguna" class="user" required></td>
            </tr>
            <tr>
              <td colspan="3">
                <div class="password-container">
                  <input type="password" id="fpassword" name="fpassword" placeholder="Kata Laluan" class="user" required>
                  <span id="togglePassword" class="eye-icon"></span>
                </div>
            </tr>
            <tr>
              <td colspan="3"><a href="register.php" class="register">Daftar Akaun Baharu?</a></td>
            </tr>
            <tr>
              <td style="text-align: right; padding-right: 50px;"><input type="submit" name="login" value="Sahkan" class="btn"></td>
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
      
      <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>




