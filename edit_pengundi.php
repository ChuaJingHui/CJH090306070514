<?php
// Tetapan fail sambungan pangkalan data
require "config.php";

// Pastikan skrip ini diakses menerusi butang POST
if(!isset($_POST['id_pengguna'])){
    header("Location: kemaskini.php");
    exit();
}

// 1. Ambil ID pengguna hasil hantaran dari jadual Kemaskini
$id_pengguna = $_POST['id_pengguna'];

// 2. Dapatkan data asal pengundi berdaftar dari pangkalan data
$carian_pengundi = mysqli_query($sambungan, "SELECT * FROM pengundi WHERE IDPengguna = '$id_pengguna'");
$data_pengundi = mysqli_fetch_assoc($carian_pengundi);

// 3. Dapatkan senarai kelas lengkap bagi membentuk menu pilihan (dropdown)
$carian_kelas = mysqli_query($sambungan, "SELECT * FROM kelas");

// 4. Proses memuatnaik maklumat berlaku apabila butang SIMPAN ditekan
if (isset($_POST['kemaskini_data'])) {
    
    // Menerima nilai baharu
    $nama_baru = $_POST['nama_dikemaskini'];
    $kelas_baru = $_POST['kelas_dikemaskini'];

    // Arahan mengemaskini (Update) ke pangkalan data
    $kemaskini_data = mysqli_query($sambungan, "UPDATE pengundi SET Nama='$nama_baru', IDKelas='$kelas_baru' WHERE IDPengguna='$id_pengguna'");

    // Proses paparan respons sistem terhadap kemaskini
    if ($kemaskini_data) {
        echo "<script>alert('Syabas! Maklumat pengundi telah dikemaskini dengan sempurna.'); window.location='kemaskini.php';</script>";
    } else {
        echo "<script>alert('Gagal melaksanakan kemaskini terhadap pelayan data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kemaskini Profil Pengundi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="nav">
        <div class="navTop"><h1>PENGURUSAN REKOD DATA PENGUNDI</h1></div>
    </nav>

    <center>
        <form action="" method="POST" style="width: 40%; margin-top: 50px;">
            <h2>Borang Perubahan Maklumat</h2>
            
            <input type="hidden" name="id_pengguna" value="<?php echo $data_pengundi['IDPengguna']; ?>">

            <label style="font-weight: bold; margin-top: 10px; display: block;">ID Pengguna (Sistem Kunci):</label>
            <input type="text" class="user" value="<?php echo $data_pengundi['IDPengguna']; ?>" readonly style="background-color: #eee;">

            <label style="font-weight: bold; margin-top: 10px; display: block;">Nama Baharu Pengundi:</label>
            <input type="text" name="nama_dikemaskini" class="user" value="<?php echo $data_pengundi['Nama']; ?>" required>

            <label style="font-weight: bold; margin-top: 10px; display: block;">Penempatan Kelas Berdaftar:</label>
            <select name="kelas_dikemaskini" class="user">
                <?php while($baris_kelas = mysqli_fetch_assoc($carian_kelas)) { ?>
                    <option value="<?php echo $baris_kelas['IDKelas']; ?>" <?php if($baris_kelas['IDKelas'] == $data_pengundi['IDKelas']) echo 'selected'; ?>>
                        <?php echo $baris_kelas['Kelas']; ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit" name="kemaskini_data" class="btn">SIMPAN PERUBAHAN</button>
            <a href="kemaskini.php" class="btn" style="background-color: #ccc; text-decoration:none; color:black; font-size:12px;">BATAL & BALIK</a>
        </form>
    </center>

    <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
    </footer>
</body>
</html>