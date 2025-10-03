<?php
    $koneksi = mysqli_connect('localhost','root','','mypicures');

    if(!$koneksi){
        echo "Ada masalah";
    }
?>