<?php

function checkLogin() {
    if (isset($_SESSION['is_login'])) {
        $isLogin = $_SESSION['is_login'];        
        return $isLogin ? true : false;
    }

    return false;    
}

function onlyAdmin() {
    if (!checkLogin()) {
        header('location:index.php');
        exit;
    }
}

function getUserLogin($key) {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        return isset($username[$key]) ? $username[$key] : null;
    }

    return null;
}

function getNumberOfUsers($koneksi) {
    $sql = "SELECT COUNT(*) as total FROM user"; 
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}

function getNumberOfBukuTamu($koneksi) {
    $sql = "SELECT COUNT(*) as total FROM buku_tamu"; 
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}