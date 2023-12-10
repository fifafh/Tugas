<?php
session_start();
require_once('../required/auth.php');

onlyAdmin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>Skyfaa</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Sky</span>faa</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="dashboard.php?page=dashboard"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="dashboard.php?page=users"><i class='bx bx-user-plus'></i>Users</a></li>
            <li><a href="dashboard.php?page=experiences"><i class='bx bx-analyse'></i>Experiences</a></li>
            <li><a href="dashboard.php?page=portofolio"><i class='bx bx-message-square-dots'></i>Portofolio</a></li>
            <li><a href="dashboard.php?page=buku-tamu"><i class='bx bx-group'></i>Buku Tamu</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="../logout.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>
            <a href="#" class="profile">
                <img src="images/logo.png">
            </a>
        </nav>
        <!-- End of Navbar -->

        <main>

            <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    switch ($page) {
                        case 'dashboard':
                            include 'default.php';
                            break;

                        case 'users':
                            include 'users.php';
                            break;

                        case 'experiences':
                            include 'experiences.php';
                            break;
                        
                        case 'portofolio':
                            include 'portofolio.php';
                            break;

                        case 'buku-tamu':
                            include 'buku-tamu.php';
                            break; 
                        
                        default:
                            # code...
                            break;
                    }
                }
            ?>

        </main>

    </div>
    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/tZ1oFYMMqW2veMkkRfC+4Gk6qN0k1WlSpdA+0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="index.js"></script>
  


</body>
</html>
