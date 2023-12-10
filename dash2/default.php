<?php
@session_start();
require_once('../required/auth.php');
require_once('../required/koneksi.php');

onlyAdmin();
?>

<div class="header">
    <div class="left">
        <h1>Dashboard</h1>
    </div>
</div>
<!-- Insights -->
<ul class="insights">
    <li>
        <i class='bx bx-show-alt'></i>
        <span class="info">
            <h3>
                <?php
                    $jumlahPengguna = getNumberOfUsers($koneksi);
                    echo $jumlahPengguna." DATA USER";
                ?>
            </h3>
            <p><a href="dashboard.php?page=users">See more</a></p>
        </span>
    </li>
    <li><i class='bx bx-line-chart'></i>
        <span class="info">
            <h3>
                <?php
                    $jumlahBukuTamu = getNumberOfBukuTamu($koneksi);
                    echo $jumlahBukuTamu." DATA BUKU TAMU";
                ?>
            </h3>
            <p><a href="dashboard.php?page=buku-tamu">See more</a></p>
        </span>
    </li>
</ul>
<!-- End of Insights -->
