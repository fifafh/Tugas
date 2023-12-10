<?php 
session_start();
require_once('required/koneksi.php');
require_once('required/auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Link to Google Material Icons -->
    <link rel="stylesheet" href="https://fonts.google.com/icons?icon.set=Material+Icons">
</head>
<body>
    <!-- Scroll to top button -->
    <div class="scrollToTop-btn flex-center">
        <i class="fas fa-arrow-up"></i>
    </div>

    <!-- Header -->
    <header>
        <div class="nav-bar">
            <a href="#" class="logo">Skyfaa</a>
            <div class="navigation">
                <div class="nav-items">
                    <a class="active" href="#home">Home</a>
                    <a href="#about">About</a>
                    <a href="#services">Experiences</a>
                    <a href="#portfolio">Portfolio</a>
                    <a href="#contact">Contact</a>
                    <a href="login.php">Login</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Home Section -->
    <section class="home flex-center" id="home">
        <div class="home-container">
            <div class="media-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
            <div class="info">
                <h2>Hi, I am Afifah</h2>
                <h3>Front-end Developer</h3>
                <p>I create stunning websites for your business, Highly experienced in web design and development</p>
                <a href="" class="btn">Hire Me <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <div class="home-img">
                <img src="images/foto.png" alt="">
            </div>
        </div>
        <a href="#about" class="scroll-down">Scroll Down <i class="fas fa-arrow-down"></i></a>
    </section>

    <!-- About -->
    <section class="about section" id="about">
        <div class="container flex-center">
            <h1 class="section-title-01">About Me</h1>
            <h2 class="section-title-02">About Me</h2>
            <div class="content flex-center">
                <div class="about-img">
                    <img src="images/Fotoku.png"  alt="">
                </div>
    
                <div class="about-info">
                    <div class="description">
                        <h3>I'm Afifah Yasmin Kamilah</h3>
                        <h4><span>A Junior Front-End Developer based in Indonesia</span></h4>
                        <p>I design and develop services for customers specializing creating stylish,
                            modern websites, web services and online
                            stores. My passion is to design digital user experinces through meaningful
                            interactions. Check out my Portofolio
                        </p>
                    </div>
    
                    <ul class="professional-list">
                        <li class="list-item">
                            <h3>7+</h3>
                            <span>Years of<br> Experience</span>
                        </li>
                        <li class="list-item">
                            <h3>2K+</h3>
                            <span>Happy<br> Customers</span>
                        </li>
                        <li class="list-item">
                            <h3>5+</h3>
                            <span>Success<br> Projects</span>
                        </li>
                    </ul>
                    <a href="" class="btn">Download CV <i class="fas fa-download"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services section -->
    <section class="services section" id="services">
        <div class="container flex-center">
            <h1 class="section-title-01">Experiences</h1>
            <h2 class="section-title-02">Experiences</h2>
            <div class="content">
                <div class="services-description">
                    <h3>My Expertise</h3>
                </div>
                <ul class="service-list">
                        <?php
                            $queryExp = "SELECT * FROM experience ORDER BY id_experience ASC";
                            $resultExp = mysqli_query($koneksi, $queryExp);

                            while ($data = mysqli_fetch_array($resultExp)) :
                        ?>
                        <li class="service-container">
                            <div class="service-card">
                            <i class="fa-solid fa-laptop-code"></i>
                                <h3>
                                    <?= $data['job']; ?> 
                                </h3>
                                <div class="learn-more-btn">
                                    <?= $data['tahun_awal']; ?> - <?= $data['tahun_akhir']; ?>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </section>

    
    <!-- Portofolio section -->
    <section class="portfolio section" id="portfolio">
        <div class="container flex-center">
            <h1 class="section-title-01">Portfolio</h1>
            <h2 class="section-title-02">Portfolio</h2>
            <div class="content">
                <div class="portfolio-list">
                    <?php
                    $queryExp = "SELECT * FROM portofolio ORDER BY id_portofolio ASC";
                    $resultExp = mysqli_query($koneksi, $queryExp);

                    while ($data = mysqli_fetch_array($resultExp)) :
                    ?>
                        <div class="img-card-container">
                            <div class="img-card">
                                <div class="overlay"></div>
                                <div class="info">
                                    <h3>
                                        <?= $data['project_name']; ?>
                                    </h3>
                                    <span>
                                        <?= $data['price']; ?>
                                    </span>
                                </div>
                                <img src="berkas/<?= $data['picture']; ?>" alt="">
                            </div>
                            <div class="portfolio-model flex-center">
                                <div class="portfolio-model-body">
                                    <i class="fas fa-times portfolio-close-btn"></i>
                                    <h3><?= $data['project_name']; ?></h3>
                                    <img src="berkas/<?= $data['picture']; ?>" alt="<?= $data['project_name']; ?>">
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

        <!-- Get in touch -->
        <div class="get-in-touch sub-section">
            <div class="container">
                <div class="content flex-center">
                    <div class="contact-card flex-center">
                        <div class="title">
                            <h4>Let's Talk</h4>
                            <h3>About Your</h3>
                            <h2>Next Project</h2>
                        </div>
                        <div class="contact-btn">
                            <a href="" class="btn">Get In Touch <i class="fas fa-paper-plane"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our clients -->
        <div class="our-client sub-section">
            <div class="container flex-center">
                <h1 class="section-title-01">Our Clients</h1>
                <h2 class="section-title-02">Our Clients</h2>
                <div class="content">
                    <div class="swiper client-swiper">
                        <div class="swiper-wrapper">
                          <div class="swiper-slide flex-center">
                            <div class="client-img">
                                <img src="images/1.jpeg" alt="">
                            </div>
                            <div class="client-details">
                                <p>Hi, I'm Aria Collins and I am designer & developer who dream making the
                                    the world better place by products. I am also very active for international
                                    clients.
                                </p>
                                <h3>Aria Collins</h3>
                                <span>Marketing Manager</span>
                            </div>
                          </div>

                          <div class="swiper-slide flex-center">
                            <div class="client-img">
                                <img src="images/2.jpeg" alt="">
                            </div>
                            <div class="client-details">
                                <p>This is outstanding work. Everything I needed to do has been done by the
                                    makers. I really like this template and more importantly my clients are
                                    blown away it.
                                </p>
                                <h3>Cillian Metcalfe</h3>
                                <span>Graphic Designer</span>
                            </div>
                          </div>

                          <div class="swiper-slide flex-center">
                            <div class="client-img">
                                <img src="images/b3.jpeg" alt="">
                            </div>
                            <div class="client-details">
                                <p>These people really know what they are doing! Great customer support
                                    availability and supperb kindness. I am very happy that I've purchased this
                                    liscense!!!
                                </p>
                                <h3>Kianna Baird</h3>
                                <span>App Developer</span>
                            </div>
                          </div>
                        </div>
                        <div class="swiper-button-next">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                        <div class="swiper-button-prev">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="swiper-pagination"></div>
                      </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact section -->
    <section class="contact section" id="contact">
        <div class="container flex-center">
            <h1 class="section-title-01">Contact Me</h1>
            <h2 class="section-title-02">Contact Me</h2>
            <div class="content">
                <div class="contact-left">
                    <h2>Let's discuss your project</h2>
                    <ul class="contact-list">
                        <li>
                            <h3 class="item-title"><i class="fas fa-phone"></i> Phone</h3>
                            <span>+62 838-955-29784</span>
                        </li>
                        <li>
                            <h3 class="item-title"><i class="fas fa-envelope"></i> Email Address</h3>
                            <span><a href="mailto:afhk03@gmail.com">afhk03@gmail.com</a></span>
                        </li>
                        <li>
                            <h3 class="item-title"><i class="fas fa-map-marker-alt"></i> Official Address</h3>
                            <span>Jl. Senyiur Indah 3 No. 33</span>
                        </li>
                    </ul>
                </div>
                <div class="contact-right">
                    <p>I'm always open to discussing product<br><span> design work or partnerships.</span></p>
                    <form action="dash2/buku-tamu_add.php" class="contact-form" method="post">
                        <div class="first-row">
                            <input type="text" name="nama" placeholder="Name" autocomplete="off" required>
                        </div>
                        <div class="second-row">
                            <input type="email" name="email" placeholder="Email" autocomplete="off" required>
                            <input type="text" name="subject" placeholder="Subject" autocomplete="off" required>
                        </div>
                        <div class="third-row">
                            <textarea name="message" rows="7" placeholder="Message" autocomplete="off" required></textarea>
                        </div>
                        <button class="btn" name="insertdata" type="submit">Send Message <i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="about group">
                <h2>Afifah</h2>
                <p>Front-end Developer</p>
                <a href="#about">About Me</a>
            </div>
            <div class="hr"></div>
            <div class="info group">
                <h3>More</h3>
                <ul>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="hr"></div>
            <div class="follow group">
                <h3>Follow</h3>
                <ul>
                    <li><a href=""><i class="fab fa-facebook"></i></a></li>
                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-copyright group">
            <p>@ 2023 by Skyfaa. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>