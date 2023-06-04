<?php
      error_reporting(0); //untuk mematikan detail laporan error  
      //koneksi
      $host="localhost";
      $user="admin";
      $pass="a.bogo.8094";
      $db="digilib_tk";

      $koneksi=mysqli_connect($host,$user,$pass,$db);
      // if(!$koneksi) echo 'koneksi gagal'.mysqli_error($koneksi);
      if (!$koneksi) {
        echo ("Koneksi Gagal...").mysqli_error($koneksi);
      }
?>