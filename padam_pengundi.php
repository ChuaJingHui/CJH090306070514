<?php
require "config.php";
$id = $_GET['id'];

$delete = mysqli_query($con, "DELETE FROM pengundi WHERE IDPengguna = '$id'");

if ($delete) {
    echo "<script>alert('Rekod dipadam!'); window.location='kemaskini.php';</script>";
} else {
    echo "<script>alert('Gagal dipadam!'); window.location='kemaskini.php';</script>";
}
?>