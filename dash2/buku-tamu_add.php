<?php
session_start();
require_once('../required/koneksi.php');

if (isset($_POST['insertdata'])) {
    $id_buku = $_POST['id_buku'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = $koneksi->query("INSERT INTO buku_tamu Values('$id_buku', '$nama', '$email', '$subject', '$message')") or die(mysqli_error($koneksi));
    if ($sql) {
        header('location:../index.php?buku-tamu=sukses');
    } else {
        header('location:../index.php?buku-tamu=gagal');;
    }
} else {
    header('location:../index.php');
}
?>