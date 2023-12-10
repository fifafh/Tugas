<?php
session_start();
require_once('../required/koneksi.php');

if (isset($_GET['id_portofolio'])) {
    $id = $_GET['id_portofolio'];

    $query = "DELETE FROM portofolio WHERE id_portofolio='{$id}'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
        alert('Data Berhasil Di hapus');
        window.location.href='dashboard.php?page=portofolio';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Di hapus');
        window.location.href='dashboard.php?page=portofolio';
        </script>";
    }
} else {
    header('location:dashboard.php?page=portofolio');
}
?>