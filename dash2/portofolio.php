<?php
@session_start();
require_once('../required/koneksi.php');
require_once('../required/auth.php');

onlyAdmin();

$query = "SELECT * FROM portofolio ORDER BY id_portofolio DESC";
$result = mysqli_query($koneksi, $query);
?>

<div class="header">
    <div class="left">
        <h1>Manajemen Portofolio</h1>
    </div>
    <a href="#" class="report" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class='bx bx-cloud-download'></i>
        <span>Tambah Portofolio</span>
    </a>
</div>

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Data Portofolio</h3>
            <i class='bx bx-filter'></i>
            <i class='bx bx-search'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Projek</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($result)) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['project_name']; ?></td>
                        <td><?= $data['price']; ?></td>
                        <td class="image-cell">
                            <?php
                            if (!empty($data['picture'])) {
                                echo '<img src="../berkas/' . $data['picture'] . '" alt="Pratinjau" class="preview-image">';
                                echo '<p class="file-name">' . $data['picture'] . '</p>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $data['id_portofolio']; ?>"><span class="status completed">Edit</span></a>
                            <a href="portofolio-delete.php?id_portofolio=<?php echo $data['id_portofolio']?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                <span class="status pending">Hapus</span>
                            </a>

                            <!-- UBAH MODAL DATA  -->
                            <div class="modal fade" id="editModal<?php echo $data['id_portofolio']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>ID Portofolio</label>
                                                    <input type="text" value="<?php echo $data['id_portofolio']; ?>" name="id_portofolio" class="form-control" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Projek</label>
                                                    <input type="text" value="<?php echo $data['project_name']; ?>" name="project_name" class="form-control" placeholder="Masukkan Nama Projek" required autocomplete="off">
                                                </div>

                                                <div class="form-group">
                                                    <label>Harga Projek</label>
                                                    <input type="text" value="<?php echo $data['price']; ?>" name="price" class="form-control" placeholder="Masukkan Harga" required autocomplete="off">
                                                </div>

                                                <div class="form-group">
                                                    <label>Upload File</label>
                                                    <input type="file" name="picture" class="form-control">
                                                </div>

                                            </div>
                                            
                                            <div class="modal-footer">
                                                <input type="hidden" name="id_portofolio" value="<?php echo $data['id_portofolio']; ?>">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" name="updatedata" class="btn btn-primary">Ubah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF MODAL UBAH DATA -->
                        </td>
                    </tr>
                <?php $no++;
                endwhile; ?>
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
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Projek</label>
                        <input type="text" name="project_name" class="form-control" placeholder="Masukkan Nama Projek" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Harga Projek</label>
                        <input type="text" name="price" class="form-control" placeholder="Masukkan Harga" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Upload File</label>
                        <input type="file" name="picture" class="form-control">
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
    $id_portofolio = $_POST['id_portofolio'];
    $project_name = $_POST['project_name'];
    $price = $_POST['price'];
    
    // Check if a new file is uploaded
    if ($_FILES['picture']['name'] != '') {
        $direktori = "../berkas/";
        $picture = $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], $direktori . $picture);
        
        $sql = "UPDATE portofolio SET project_name = '$project_name', price = '$price', picture = '$picture' WHERE id_portofolio='$id_portofolio'";
    } else {
        // If no new file is uploaded
        $sql = "UPDATE portofolio SET project_name = '$project_name', price = '$price' WHERE id_portofolio='$id_portofolio'";
    }
    
    if ($koneksi->query($sql)) {
        echo "<script>
        alert('Data Berhasil Diupdate');
        window.location.href='dashboard.php?page=portofolio';</script>";
    } else {
        trigger_error("Periksa Perintah SQL Manual Anda : " . $sql . "Error : " . $koneksi->error, E_USER_ERROR);
    }
}
?>
<!-- END OF UBAH DATA KE DATABASE -->

<!-- INSERT DATA KE DATABASE -->
<?php
if (isset($_POST['insertdata'])) {
    $project_name = $_POST['project_name'];
    $price = $_POST['price'];

    $direktori = "../berkas/";
    $picture = $_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $direktori . $picture);

    $sql = $koneksi->query("INSERT INTO portofolio (project_name, price, picture) VALUES ('$project_name', '$price', '$picture')");

    if ($sql) {
        echo "<script>
            alert('Data Berhasil Disimpan');
            window.location.href='dashboard.php?page=portofolio';</script>";
    } else {
        echo '<script>
            alert("Data Gagal Disimpan");
            </script>';
    }
}
?>
<!-- END OF INSERT DATA KE DATABASE -->

