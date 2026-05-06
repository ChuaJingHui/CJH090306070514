<?php
// Memanggil fail konfigurasi sambungan pangkalan data
require "config.php";

// Memeriksa jika data ID pengguna tidak dihantar melalui kaedah POST
if(!isset($_POST['id_pengguna'])){
    // Mengarahkan semula pengguna ke halaman kemaskini
    header("Location: kemaskini.php");
    // Memberhentikan pelaksanaan skrip dengan serta-merta
    exit();
}

// Menyimpan nilai ID pengguna daripada borang ke dalam pembolehubah
$id_pengguna = $_POST['id_pengguna'];

// Melaksanakan arahan SQL untuk mencari rekod pengundi berdasarkan ID unik
$carian_pengundi = mysqli_query($sambungan, "SELECT * FROM pengundi WHERE IDPengguna = '$id_pengguna'");
// Menukarkan hasil carian SQL kepada bentuk tatasusunan (array)
$data_pengundi = mysqli_fetch_assoc($carian_pengundi);

// Melaksanakan arahan SQL untuk mengambil semua senarai kelas yang tersedia
$carian_kelas = mysqli_query($sambungan, "SELECT * FROM kelas");

// Memulakan proses kemaskini data jika butang simpan ditekan
if (isset($_POST['kemaskini_data'])) {
    
    // Menyimpan nilai nama baharu daripada input borang
    $nama_baru = $_POST['nama_dikemaskini'];
    // Menyimpan nilai ID kelas baharu daripada pilihan borang
    $kelas_baru = $_POST['kelas_dikemaskini'];

    // Menjalankan arahan SQL UPDATE untuk mengemaskini maklumat dalam pangkalan data
    $kemaskini_data = mysqli_query($sambungan, "UPDATE pengundi SET Nama='$nama_baru', IDKelas='$kelas_baru' WHERE IDPengguna='$id_pengguna'");

    // Menyemak sama ada operasi kemaskini pangkalan data berjaya
    if ($kemaskini_data) {
        // Memaparkan makluman berjaya dan kembali ke halaman kemaskini utama
        echo "<script>alert('Syabas! Maklumat pengundi telah dikemaskini dengan sempurna.'); window.location='kemaskini.php';</script>";
    } else {
        // Memaparkan makluman ralat jika proses kemaskini gagal
        echo "<script>alert('Gagal melaksanakan kemaskini terhadap pelayan data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Menetapkan tajuk laman yang dipaparkan pada tab pelayar web -->
    <title>Kemaskini Profil Pengundi</title>
    <!-- Menghubungkan fail CSS luaran untuk reka bentuk laman -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <nav class="nav">
        <div class="navTop">
            <!-- Tajuk utama sistem yang dipaparkan pada bar navigasi -->
            <h1>PENGURUSAN REKOD DATA PENGUNDI</h1>
        </div>
    </nav>

    <center>
        <form action="" method="POST" style="width: 40%; margin-top: 50px;">
            <!-- Tajuk bagi borang perubahan maklumat pengundi -->
            <h1 style="margin-top:100px;">Borang Perubahan Maklumat</h1>
            
            <!-- Medan input tersembunyi untuk membawa data ID pengguna semasa submit -->
            <input type="hidden" name="id_pengguna" value="<?php echo $data_pengundi['IDPengguna']; ?>">

            <!-- Label bagi medan ID Pengguna -->
            <label style="font-weight: bold; margin-top: 10px; display: block;">ID Pengguna (Sistem Kunci):</label>
            <!-- Medan paparan ID pengguna yang ditetapkan sebagai hanya baca (readonly) -->
            <input type="text" class="user" value="<?php echo $data_pengundi['IDPengguna']; ?>" readonly style="background-color: #eee;">

            <!-- Label bagi medan Nama Baharu -->
            <label style="font-weight: bold; margin-top: 10px; display: block;">Nama Baharu Pengundi:</label>
            <!-- Medan input teks untuk menukar nama pengundi -->
            <input type="text" name="nama_dikemaskini" class="user" value="<?php echo $data_pengundi['Nama']; ?>" required>
            
            <!-- Label bagi medan pilihan kelas -->
            <label style="font-weight: bold; margin-top: 10px; display: block;">Penempatan Kelas Berdaftar:</label>
            <!-- Menu lungsur untuk memilih kelas pengundi -->
            <select name="kelas_dikemaskini" class="user">
                <?php 
                // Memulakan gelung untuk memaparkan setiap rekod kelas yang ada
                while($baris_kelas = mysqli_fetch_assoc($carian_kelas)) { 
                ?>
                    <!-- Memaparkan pilihan kelas dan menandakan 'selected' pada kelas asal pengundi -->
                    <option value="<?php echo $baris_kelas['IDKelas']; ?>" <?php if($baris_kelas['IDKelas'] == $data_pengundi['IDKelas']) echo 'selected'; ?>>
                        <!-- Nama kelas yang muncul dalam pilihan dropdown -->
                        <?php echo $baris_kelas['Kelas']; ?>
                    </option>
                <?php } ?>
            </select>

            <!-- Butang untuk menghantar borang bagi menyimpan perubahan -->
            <button type="submit" name="kemaskini_data" class="btn">SIMPAN PERUBAHAN</button>

            <!-- Pautan untuk membatalkan tindakan dan kembali ke halaman kemaskini -->
            <a href="kemaskini.php" class="btn" style="background-color: #ccc; text-decoration:none; color:black; font-size:12px;">BATAL & BALIK</a>
        </form>
    </center>

    <footer>
        <!-- Paparan maklumat hak cipta dan penyedia sistem di bahagian kaki -->
        <span>Disediakan oleh Chua Jing Hui</span>
    </footer>
</body>
</html>