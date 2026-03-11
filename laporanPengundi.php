<!DOCTYPE html>
<html>
    <head>
        <title>Pengundian</title>
        <link rel="stylesheet" href="styles.css">
        
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
          <a href="login.php" class="nav-btn">LOG MASUK</a>
          <a href="laporanPengundi.php" class="nav-btn">KEPUTUSAN</a>
          <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
      </nav>

      <!--MEMBUAT PENGUNDIAN-->
        <form onsubmit="" action="" method="POST">
            <table class="undi">
                <tr>
                    <td colspan="2" style="padding: 5px;">
                        <h3 style="margin: 0;" >Jumlah Undian</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <u>Permainan Tradisional</u>
                        <img src="https://umbiofficial.com/cdn/shop/articles/nostalgic-permainan-tradisional-you-might-miss-2509474.jpg?v=1757095395" alt="Permainan Tradisional" >
                        <p><u>undian</u></p>
                    </td>
                    <td>
                        <u>Permainan Digital</u>
                        <img src="https://www.sinarharian.com.my/sinarbestari/uploads/2021/06/1091985.jpg" alt="Permainan Digital" >
                        <p><u>undian</u></p>
                    </td>
                </tr>
            <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" value="CETAK" class="btn">
                    </td>
                </tr>
            </table>
        </form>
      <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
      </footer>
    </body>
</html>
