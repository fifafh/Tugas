<?php
$koneksi = mysqli_connect("localhost", "root", "", "web_profile");

if(!$koneksi) {
    die('Tidak dapat menghubungkan mysql:' .mysql_error());
}
?>