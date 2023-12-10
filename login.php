<?php
session_start();
require_once('required/koneksi.php');
require_once('required/auth.php');

if (checkLogin()) {
    header('location:index.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '{$username}' AND password = '{$password}'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);

    if ($data) {
        $_SESSION['is_login'] = true;
        $_SESSION['user'] = $data;
        header('Location:dash2/dashboard.php?page=dashboard');
        exit;
    } else {
        header('location:login.php?status=gagal');
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  </head>
  <body>

    <div class="login-form">
        <form id='login' action="login.php" method="POST" class='form'>
            <div class="heading">
                <img class="avatar" src="img/avatar.svg">
                <h2>Hi, WELCOME!</h3><br>
            </div>

            <div class="wrap-reg">
                <label>Username</label>
                <input type="text" name="username" autocomplete="off" required/>
                <span class="focus-input"></span>
            </div>
            <div class="wrap-reg">
                <label>Password</label>
                <input type="password" name="password" autocomplete required/>
                <span class="focus-input"></span>
            </div>
            <input type="submit" class="btn" value="Login" name="login">
        </form>
    </div>


</body>
</html>

<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript">
        <?php 
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'sukses') : ?>
                alert('Login Berhasil.');
            <?php elseif ($status == 'gagal') : ?>
                alert('Login gagal. Username/Password Salah');
            <?php endif;
        }
        ?>
    </script>

<?php 
    mysqli_close($koneksi);