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
          <a href="login.php" class="nav-btn">Log Masuk</a>
          <a href="admin.php" class="nav-btn">Laporan</a>
          <a href="login.php" class="nav-btn">Keluar</a>
        </div>
 
      </nav>

      <center>
        <h1>LOG MASUK</h1>
      

      <form action="data.php">
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
        <span class="copyright">Hak Cipta@Persatuan Penyelidikan Dan Kajian Remaja</span>
      </footer>
    </body>
</html>
