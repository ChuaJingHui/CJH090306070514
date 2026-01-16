<!DOCTYPE html>
<html>
    <head>
        <title>Pendaftaran</title>
        <link rel="stylesheet" href="styles.css">
        
    </head>
    <body>
      <nav class="nav">
        <div class="navTop">
          <p><h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</p></h1>
        </div>

        
        
      </nav>

      <center>
        <h1>Pendaftaran</h1>
      

      <form onsubmit="return validateForm()" action="" method="">
        <select name='kelas' required>
          <?php
              require('config.php');
              //Untuk memaparkan query kelas
              $sqlSelectKelas="SELECT * FROM kelas";
              $data=$con->query($sqlSelectKelas);

              print"<option>Pilih Kelas</option>";
              if($data->num_rows>0){
                while($rows=$data->fetch_assoc()){
                    //Fetch a result row as an associative array:
                        echo "<option value='".$row['IDKelas']."'>"
                      .$row['kelas']."</option>";
                  }
              }
          ?>
          </select>
        <table>
            <tr>
              <td colspan="3"><input type="text" id="fIC" name="fIC" placeholder="IDPengguna(No.KP)" class="user" required></td>
            </tr>
            <tr>
              <td colspan="3"><input type="text" id="fname" name="fname" placeholder="Nama" class="user" required></td>
            </tr>
            <tr>
              <td colspan="3">
                <input list="kelas" id="fkelas" name="fkelas" placeholder="Kelas" class="user">
                <!-- <datalist id="fkelas">
                    <option value="4S1">
                    <option value="4S3">
                    <option value="4S9">
                    <option value="4T2">
                    <option value="4C2">
                    <option value="4C3">
                    <option value="4CL">
                    <option value="4SL">
                </datalist> -->
              </td>
            </tr>
            <tr>
              <td colspan="3"><input type="text" id="fpassword" name="fpassword" placeholder="Kata Laluan" class="user" required></td>
            </tr>
            <tr>
              <td colspan="3"><a href="login.html" class="register">Sudah Daftar?</a></td>
            </tr>
            <tr>
              <td style="text-align: right;padding-right:20%;"><input type="submit" value="Sahkan" class="btn"></td>
            </tr>
          </table>
      </form>
      </center>

      <script>
      function validateIC(){
        const ic = document.getElementById("fIC");
        const tooltip = document.getElementById("icTooltip");

        //Remove non-numeric characters
        ic.value = ic.value.replace(/\D/g,'');

        if(ic.value.length !== 12){
          ic.classlist.add("invalid");
          tooltip.style.display = "block";
          return false;
        }else{
          ic.classlist.remove("invalid");
          tooltip.style.display = "none";
          return true;
        }
      }
      </script>
    
      
      <footer>
        <span class="copyright">Hak Cipta@Persatuan Penyelidikan Dan Kajian Remaja</span>
      </footer>
    </body>
</html>