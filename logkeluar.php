<?php
    //Meneruskan session sebelumnya
    session_start();

    //Menghapuskan Nilai Terkandung dalam Pemboleh Ubah session
    session_unset();

    //Menghapuskan session
    session_destroy();

    //Memaparkan halaman Log Masuk
    echo"<script>window.location.replace('login.php');</script>";
?>