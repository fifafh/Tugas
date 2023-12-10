<?php
@session_start();
require_once('../required/koneksi.php');
require_once('../required/auth.php');

onlyAdmin();

$query = "SELECT * FROM experience ORDER BY id_experience DESC";
$result = mysqli_query($koneksi, $query);
?>

<div class="header">
    <div class="left">
        <h1>Manajemen Experiences</h1>
    </div>
    <a href="#" class="report" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class='bx bx-cloud-download'></i>
        <span>Tambah Experience</span>
    </a>
</div>

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Data Experiences</h3>
            <i class='bx bx-filter'></i>
            <i class='bx bx-search'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Job</th>
                    <th>Tahun</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($result)) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['job']; ?></td>
                        <td><?= $data['tahun_awal'] . ' - ' . $data['tahun_akhir']; ?></td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModal<?= $data['id_experience']; ?>">
                                <span class="status completed">Edit</span>
                            </a>
                            <a href="experiences-delete.php?id_experience=<?= $data['id_experience']?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                <span class="status pending">Hapus</span>
                            </a>
                        </td>
                    </tr>
                    <!-- UBAH MODAL DATA  -->
                    <div class="modal fade" id="editModal<?= $data['id_experience']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data Experiences</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ID Experience</label>
                                            <input type="text" value="<?php echo $data['id_experience']; ?>" name="id_experience" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Job</label>
                                            <input type="text" value="<?php echo $data['job']; ?>" name="job" class="form-control" placeholder="Masukkan Nama Job" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Awal</label>
                                            <select class="form-control" name="tahun_awal" required>
                                                <?php for ($year = date("Y"); $year >= 1900; $year--) : ?>
                                                    <option value="<?php echo $year; ?>" <?php echo ($year == $data['tahun_awal']) ? 'selected' : ''; ?>>
                                                        <?php echo $year; ?>
                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Akhir</label>
                                            <select class="form-control" name="tahun_akhir" required>
                                                <?php for ($year = date("Y"); $year >= 1900; $year--) : ?>
                                                    <option value="<?php echo $year; ?>" <?php echo ($year == $data['tahun_akhir']) ? 'selected' : ''; ?>>
                                                        <?php echo $year; ?>
                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <input type="hidden" name="id_experience" value="<?php echo $data['id_experience']; ?>">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="updatedata" class="btn btn-primary">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END OF MODAL UBAH DATA -->
                <?php $no++; endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Job</label>
                        <input type="text" name="job" class="form-control" placeholder="Masukkan Nama Job" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tahun Awal</label>
                        <select class="form-control" name="tahun_awal" required>
                            <?php for ($year = date("Y"); $year >= 1900; $year--) : ?>
                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun Akhir</label>
                        <select class="form-control" name="tahun_akhir" required>
                            <?php for ($year = date("Y"); $year >= 1900; $year--) : ?>
                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="insertdata" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF MODAL TAMBAH -->

<!-- UBAH DATA KE DATABASE -->
<?php
if (isset($_POST['updatedata'])) {
    $id_experience = $_POST['id_experience'];
    $job = $_POST['job'];
    $tahun_awal = $_POST['tahun_awal'];
    $tahun_akhir = $_POST['tahun_akhir'];

    $sql = "UPDATE experience SET job = '$job', tahun_awal = '$tahun_awal', tahun_akhir = '$tahun_akhir' WHERE id_experience='$id_experience'";
    
    if ($koneksi->query($sql)) {
        echo "<script>
        alert('Data Berhasil Diupdate');
        window.location.href='dashboard.php?page=experiences';</script>";
    } else {
        trigger_error("Periksa Perintah SQL Manual Anda : " . $sql . "Error : " . $koneksi->error, E_USER_ERROR);
    }
}
?>

<!-- END OF UBAH DATA KE DATABASE -->

<!-- INSERT DATA KE DATABASE -->
<?php
if (isset($_POST['insertdata'])) {
    $id_experince = $_POST['id_experince'];
    $job = $_POST['job'];
    $tahun_awal = $_POST['tahun_awal'];
    $tahun_akhir = $_POST['tahun_akhir'];


    $sql = $koneksi->query("INSERT INTO experience Values('$id_experince', '$job', '$tahun_awal', '$tahun_akhir')") or die(mysqli_error($koneksi));
    if ($sql) {
        echo "<script>
    alert('Data Berhasil Di simpan');
    window.location.href='dashboard.php?page=experiences';</script>";
    } else {
        echo '<script>
    alert("Data Gagal Di Tambahkan");
    </script>';
    }
}
?>
<!-- END OF INSERT DATA KE DATABASE -->