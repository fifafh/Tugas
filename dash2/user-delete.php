<?php
session_start();
require_once('../required/koneksi.php');

if (isset($_GET['id_user'])) {
    $id = $_GET['id_user'];

    $query = "DELETE FROM user WHERE id_user='{$id}'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
        alert('Data Berhasil Di hapus');
        window.location.href='dashboard.php?page=users';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Di hapus');
        window.location.href='dashboard.php?page=users';
        </script>";
    }
} else {
    header('location:dashboard.php?page=users');
}
?>