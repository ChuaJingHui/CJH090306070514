<?php
require "config.php";

// 1. Ambil ID dari URL
$id = $_GET['id'];

// 2. Dapatkan data asal pengundi
$query_pengundi = mysqli_query($con, "SELECT * FROM pengundi WHERE IDPengguna = '$id'");
$data = mysqli_fetch_assoc($query_pengundi);

// 3. Dapatkan senarai kelas untuk menu pilihan (dropdown)
$query_kelas = mysqli_query($con, "SELECT * FROM kelas");

// 4. Proses apabila butang KEMASKINI ditekan
if (isset($_POST['update'])) {
    $nama_baru = $_POST['nama'];
    $kelas_baru = $_POST['id_kelas'];

    $update = mysqli_query($con, "UPDATE pengundi SET Nama='$nama_baru', IDKelas='$kelas_baru' WHERE IDPengguna='$id'");

    if ($update) {
        echo "<script>alert('Maklumat berjaya dikemaskini!'); window.location='kemaskini.php';</script>";
    } else {
        echo "<script>alert('Gagal mengemaskini!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pengundi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="nav">
        <div class="navTop"><h1>KEMASKINI DATA</h1></div>
    </nav>

    <center>
        <form action="" method="POST" style="width: 40%; margin-top: 50px;">
            <h2>Edit Maklumat Pengundi</h2>
            
            <label>ID Pengguna (Tidak boleh ubah):</label>
            <input type="text" class="user" value="<?php echo $data['IDPengguna']; ?>" readonly style="background-color: #eee;">

            <label>Nama Pengundi:</label>
            <input type="text" name="nama" class="user" value="<?php echo $data['Nama']; ?>" required>

            <label>Kelas:</label>
            <select name="id_kelas" class="user">
                <?php while($k = mysqli_fetch_assoc($query_kelas)) { ?>
                    <option value="<?php echo $k['IDKelas']; ?>" <?php if($k['IDKelas'] == $data['IDKelas']) echo 'selected'; ?>>
                        <?php echo $k['Kelas']; ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit" name="update" class="btn">SIMPAN PERUBAHAN</button>
            <a href="kemaskini.php" class="btn" style="background-color: #ccc; text-decoration:none; color:black;">BATAL</a>
        </form>
    </center>

    <footer>
        <span class="copyright">Disediakan oleh Chua Jing Hui</span>
    </footer>
</body>
</html>