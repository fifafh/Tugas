<?php
@session_start();
require_once('../required/koneksi.php');
require_once('../required/auth.php');

onlyAdmin();

$query = "SELECT * FROM buku_tamu ORDER BY id_buku DESC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($koneksi));
}
?>

<div class="header">
    <div class="left">
        <h1>Manajemen Buku Tamu</h1>
    </div>
</div>

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Data Buku Tamu</h3>
            <i class='bx bx-filter'></i>
            <i class='bx bx-search'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($result)) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['email']; ?></td>
                        <td><?= $data['subject']; ?></td>
                        <td><?= $data['message']; ?></td>

                        <td>
                            <a href="buku-tamu_delete.php?id_buku=<?php echo $data['id_buku']?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                <span class="status pending">Hapus</span>
                            </a>
                        </td>
                    </tr>
                <?php $no++;
                endwhile; ?>
            </tbody>
        </table>
    </div>
</div>



