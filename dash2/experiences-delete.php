<?php
session_start();
require_once('../required/koneksi.php');

if (isset($_GET['id_experience'])) {
    $id = $_GET['id_experience'];

    $query = "DELETE FROM experience WHERE id_experience='{$id}'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
        alert('Data Berhasil Di hapus');
        window.location.href='dashboard.php?page=experiences';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Di hapus');
        window.location.href='dashboard.php?page=experiences';
        </script>";
    }
} else {
    header('location:dashboard.php?page=experiences');
}
?>