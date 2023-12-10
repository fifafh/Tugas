<?php
@session_start();
require_once('../required/koneksi.php');
require_once('../required/auth.php');

onlyAdmin();

$query = "SELECT * FROM user ORDER BY id_user DESC";
$result = mysqli_query($koneksi, $query);
?>
<div class="header">
    <div class="left">
        <h1>Manajemen Users</h1>
    </div>
    <a href="#" class="report" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class='bx bx-cloud-download'></i>
        <span>Tambah User</span>
    </a>
</div>

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Data Users</h3>
            <i class='bx bx-filter'></i>
            <i class='bx bx-search'></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while ($data = mysqli_fetch_array($result)) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['username']; ?></td>
                        <td><?= $data['password']; ?></td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $data['id_user']; ?>"><span class="status completed">Edit</span></a>
                            <a href="user-delete.php?id_user=<?php echo $data['id_user']?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                <span class="status pending">Hapus</span>
                            </a>
                            
                            <!--UBAH MODAL DATA  -->
                            <div class="modal fade" id="editModal<?php echo $data['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>ID USER</label>
                                                    <input type="text" value="<?php echo $data['id_user']; ?>" name="id_user" class="form-control" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" value="<?php echo $data['username']; ?>" name="username" class="form-control" placeholder="Masukkan Username" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" value="<?php echo $data['password']; ?>" name="password" class="form-control" placeholder="Masukkan Password" required autocomplete="off">
                                                </div>

                                            <div class="modal-footer">
                                                <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
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
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Masukkan Password" required autocomplete="off">
                        </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- UBAH DATA KE DATABASE -->
        <?php
    if (isset($_POST['updatedata'])) {
        $id_user = $_POST['id_user'];

        $username = $_POST['username'];
        $password = $_POST['password'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $id_tarif = $_POST['id_tarif'];
        $status = $_POST['status'];

        $sql = "UPDATE user SET username = '$username', password = '$password' WHERE id_user='$id_user'";
        if ($koneksi->query($sql)) {
            echo "<script>
            alert('Data Berhasil Di update');
            window.location.href='dashboard.php?page=users';</script>";
        } else {
            trigger_error("Periksa Perintah SQL Manual Anda : " . $sql . "Error : " . $koneksi->error, E_USER_ERROR);
        }
    }
    ?>
    <!-- END OF UBAH DATA KE DATABASE -->
    
    <!-- INSERT DATA KE DATABASE -->
    <?php
    if (isset($_POST['insertdata'])) {
        $id_user = $_POST['id_user'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = $koneksi->query("INSERT INTO user Values('$id_user', '$username', '$password')") or die(mysqli_error($koneksi));
        if ($sql) {
            echo "<script>
        alert('Data Berhasil Di simpan');
        window.location.href='dashboard.php?page=users';</script>";
        } else {
            echo '<script>
        alert("Data Gagal Di Tambahkan");
        </script>';
        }
    }
    ?>
    <!-- END OF MODAL TAMBAH -->

