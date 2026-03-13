<?php
// Memanggil fail konfigurasi pangkalan data
require "config.php";

// Semak jika pengguna telah menekan butang 'SIMPAN REKOD'
if (isset($_POST['tambah'])) {
    
    // Menerima data dari borang dan menggunakan fungsi 'escape' untuk keselamatan (elak SQL Injection)
    $no_kp = mysqli_real_escape_string($sambungan, $_POST['no_kad_pengenalan']);
    $nama_pengguna = mysqli_real_escape_string($sambungan, $_POST['nama_penuh']);
    $kelas_pilihan = mysqli_real_escape_string($sambungan, $_POST['pilihan_kelas']);
    $kata_laluan = mysqli_real_escape_string($sambungan, $_POST['kata_laluan']);

    // Arahan SQL untuk memasukkan data login ke dalam jadual 'pengguna' terlebih dahulu
    $tambah_pengguna = mysqli_query($sambungan, "INSERT INTO pengguna(`IDPengguna`, `KataLaluan`) VALUES('$no_kp', '$kata_laluan')");
    
    // Semak jika proses memasukkan data ke jadual 'pengguna' berjaya
    if ($tambah_pengguna) {
        
        // Seterusnya, masukkan maklumat peribadi ke dalam jadual 'pengundi'
        $tambah_pengundi = mysqli_query($sambungan, "INSERT INTO pengundi(`IDPengguna`, `Nama`, `IDKelas`) VALUES('$no_kp', '$nama_pengguna', '$kelas_pilihan')");
        
        if ($tambah_pengundi) {
            // Mesej berjaya jika kedua-dua proses selesai
            echo "<script>
                    alert('Rekod pengundi dan pengguna baharu berjaya ditambah!');
                    window.location='kemaskini.php';
                  </script>";
        } else {
            echo "<script>alert('Ralat: Gagal menambah rekod ke dalam jadual pengundi!');</script>";
        }
    } else {
        echo "<script>alert('Harap Maaf! ID Pengguna yang dimasukkan telah wujud di dalam sistem.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengundi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="nav">
        <div class="navTop">
            <h1>SISTEM PENGUNDIAN PERMAINAN KEGEMARAN REMAJA</h1>
        </div>
        <div class="navButtons">
            <a href="laporan.php" class="nav-btn">LAPORAN</a>
            <a href="keputusanAdmin.php" class="nav-btn">KEPUTUSAN</a>
            <a href="kemaskini.php" class="nav-btn">KEMASKINI</a>
            <a href="login.php" class="nav-btn">KELUAR</a>
        </div>
    </nav>

    <center>
        <h1 style="margin: 20px 0;">TAMBAH PENGUNDI BARU</h1>
        
        <div class="form-tambah">
            <form onsubmit="return validateIC()" method="POST" action="">
                
                <label for="no_kad_pengenalan">ID Pengguna (No. Kad Pengenalan):</label>
                <input type="text" id="ic" name="no_kad_pengenalan" placeholder="Contoh: 010203040506" required>
                <div id="icTooltip" class="tooltip">ID Pengguna mesti mengandungi tepat 12 digit (nombor sahaja)</div>

                <label for="nama_penuh">Nama Penuh:</label>
                <input type="text" id="nama_penuh" name="nama_penuh" placeholder="Sila masukkan nama pengundi" required>

                <label for="pilihan_kelas">Kelas:</label>
                <select name="pilihan_kelas" id="pilihan_kelas" required>
                    <option value=''>-- Sila Pilih Kelas --</option>
                    <?php
                    // Mendapatkan pilihan kelas terus dari jadual 'kelas'
                    $arahan_pilih_kelas = "SELECT * FROM kelas ORDER BY Kelas ASC";
                    $data_kelas = mysqli_query($sambungan, $arahan_pilih_kelas);

                    if (mysqli_num_rows($data_kelas) > 0) {
                        while ($baris_kelas = mysqli_fetch_assoc($data_kelas)) {
                            echo "<option value='" . $baris_kelas['IDKelas'] . "'>" . $baris_kelas['Kelas'] . "</option>";
                        }
                    }
                    ?>
                </select>

                <label for="kata_laluan">Kata Laluan:</label>
                <div class="password-container">
                    <input type="password" id="kata_laluan" name="kata_laluan" placeholder="Sila masukkan kata laluan" required>
                    <span id="togglePassword" class="eye-icon"></span>
                </div>

                <button type="submit" name="tambah" class="btn-submit">SIMPAN REKOD</button>
            </form>
            <br>
            <center>
                <a href="kemaskini.php" style="text-decoration: none; color: #d9534f; font-weight: bold;">[ Batal & Kembali ]</a>
            </center>
        </div>
    </center>

    <script>
        // JS untuk sistem papar/sembunyi kata laluan (ikon mata)
        const suisKataLaluan = document.getElementById('togglePassword');
        const inputKataLaluan = document.getElementById('kata_laluan');
        
        // Ikon dalam bentuk SVG (grafik vektor)
        const mataTerbuka = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;
        const mataTertutup = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>`;

        suisKataLaluan.innerHTML = mataTertutup;

        // Tindakan apabila ikon diklik
        suisKataLaluan.addEventListener('click', function () {
            const modKataLaluan = inputKataLaluan.getAttribute('type') === 'password';
            inputKataLaluan.setAttribute('type', modKataLaluan ? 'text' : 'password');
            this.innerHTML = modKataLaluan ? mataTerbuka : mataTertutup; 
        });

        // Validasi kad pengenalan secara masa-nyata
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

    <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
    </footer>
</body>
</html>