<?php
session_start();
require_once('../required/koneksi.php');

if (isset($_GET['id_buku'])) {
    $id = $_GET['id_buku'];

    $query = "DELETE FROM buku_tamu WHERE id_buku='{$id}'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
        alert('Data Berhasil Di hapus');
        window.location.href='dashboard.php?page=buku-tamu';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Di hapus');
        window.location.href='dashboard.php?page=buku-tamu';
        </script>";
    }
} else {
    header('location:dashboard.php?page=buku-tamu');
}
?>