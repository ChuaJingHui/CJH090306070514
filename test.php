<!-- <!DOCTYPE html>
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
      

      <form action="data.php" method="get">
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
                <datalist id="fkelas">
                    <option value="4S1">
                    <option value="4S3">
                    <option value="4S9">
                    <option value="4T2">
                    <option value="4C2">
                    <option value="4C3">
                    <option value="4CL">
                    <option value="4SL">
                </datalist>
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
      
      <footer>
        <span class="copyright">Hak Cipta@Persatuan Penyelidikan Dan Kajian Remaja</span>
      </footer>
    </body>
</html> -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>daftar</title>


        <!--DAFTAR PAGE-->
        <center>
            <table class="header">
            <!--Sistem name at top-->
            <tr>
                <td colspan="3"><div class="sistemName"><center><b>SISTEM PENGUNDIAN PEMILIHAN PEMENANG PERTANDINGAN DEBAT</b></center></div></td>
            </tr>
            <!--Log masuk and daftar button at the top-->
            <tr>
                <td colspan=2 align="left"><button>Daftar</button></td>
                <td colspan=2 align="right"><a href="logmasuk.html"><button>Log Masuk</button></a></td>
            </tr>
        </table>
        </center>


    <style>
    html {
        scroll-behavior: smooth;
    }


    /* Let the font become times new roman */
    body,button,select,input::placeholder{
        font-family: "Times New Roman", sans-serif;
    }


    form {
        width: 320px;
        padding:20px;
        border:1px solid #ccc;
    }
   
    .register{
        display:block;
        width: 320px;
        margin: 12px auto 0;
    }
   
    input,select
    {
        width:90%;
        margin-top:5px;
        box-sizing:border-box
     }


    /*Tooltip style*/
    .tooltip{
        color:#fff;
        background-color:red;
        padding:5px 8px;
        font-size:12px;
        margin-top:4px;
        display:none;
        border-radius: 4px;
    }


    .invalid{
        border:2px solid red;
    }
    </style>


    </head>


    <body>
        <center>


        <form onsubmit="return validateIC()" action="" method="">


        <table class="register">
            <!--Borang Pendaftaran at screen top bottom-->
            <tr>
                <td colspan="3"><center><b>Borang Pendaftaran</b></center></td>
            </tr>
            <!--Key in daftar maklumat-->
            <tr><td>Nama</td><td>:</td><td>
              <input type="text" name="nama" placeholder="Masukkan Nama"required></td></tr>
            <tr><td>Kelas</td><td>:</td>
            <td><select name="Kelas"required>
                <?php
                require ('config.php');
                //Untuk memaparkan query kelas
                $sqlSelectKelas="SELECT*FROM Kelas";
                $data=$con->query($sqlSelectKelas);


                print"<option>Pilih Kelas</option>";
                if($data->num_rows>0){
                    while ($row = $data->fetch_assoc()) {
                        //Fetch a result tow as an associative array:
                        echo "<option value='".$row['IDKelas']."'>"
                        .$row['Kelas']."</option>";
                        }
                    }
                ?>
               
                </select>
            </td>
            </tr>  
            <tr><td>NO KP</td><td>:</td><td><input type="text" id="ic" name="NOKP" placeholder="Masukkan NO KP"required>
                <div id="icTooltip" class="tooltip">
                    IC number must be exactly 12 digits (number only)
                </div>
                </td>
            </tr>
            <tr><td>Kata Laluan</td><td>:</td><td><input type="password" name="password" required></td></tr>


            <!--daftar botton after key in maklumat-->
            <tr><td colspan="3" class="daftar"><center><button type="submit" name="Daftar" value="Daftar">Daftar</button></center></td></tr>


        </table><!--Close for register-->






        </form>


        <script>
        function validateIC(){
            const ic=document.getElementById("ic");
            const tooltip=document.getElementById("icTooltip");


            //Remove non-numeric characters
            ic.value=ic.value.replace(/\D/g,'');


            if(ic.value.length!==12){
                ic.classList.add("invalid");
                tooltip.style.display="block";
                return false;
            } else {
                ic.classList.remove("invalid");
                tooltip.style.display="none";
                return true;
            }
        }


    document.getElementById("ic").addEventListener("input", validateIC);


    </script>
    </body>


    <footer>
        <center><p>© Tan Zhi Yi 2025 Hak Cipta</p></center>
    </footer>


</html>



