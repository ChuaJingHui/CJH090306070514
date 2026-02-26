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
          <a href="login.php" class="nav-btn">LOG MASUK</a>
          <a href="admin.php" class="nav-btn">LAPORAN</a>
          <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
 
      </nav>

      <center>
        <h1>LOG MASUK</h1>
      

      <form action="data.php" method="POST">
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


