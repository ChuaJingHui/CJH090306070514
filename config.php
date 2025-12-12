<?php

$con = mysqli_connect("localhost","root","");

if(!$con){
    die('Sambungan kepada Pangkalan Data Gagal'.mysqli_connect_error());
}

mysqli_select_db($con,"CJH090306070514");

?>