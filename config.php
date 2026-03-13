<?php
// Menyediakan maklumat sambungan pangkalan data (Host, Username, Password)
$sambungan = mysqli_connect("localhost", "root", "");

// Semak jika fail gagal disambungkan kepada pelayan pangkalan data
if(!$sambungan){
    die('Sambungan kepada Pangkalan Data Gagal: ' . mysqli_connect_error());
}

// Memilih pangkalan data yang spesifik untuk digunakan dalam sistem ini
mysqli_select_db($sambungan, "CJH090306070514");
?>