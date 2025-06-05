<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?></title>
    <!-- Embed Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Embed Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Link CSS -->
    <link rel="stylesheet" href="<?php echo $pathResetCSS ?>">
    <link rel="stylesheet" href="<?php echo $pathCSS ?>">

    <!-- Swiper -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <div class="main">
        <!-- Begin: Header-large -->
        <header class="header fixed header--large">
            <div class="container">
                <div class="header-body">
                    <div class="header-body__item">
                        <form action="#!" class="header-body__form">
                            <input type="text" placeholder="Tìm sản phẩm" class="header-body__input">
                            <button type="submit" class="header-body__btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>

                    <div class="header-body__item">
                        <a href="/" class="logo header-body__logo">
                            NHAT<span>DECOR</span>
                        </a>
                    </div>

                    <div class="header-body__item">
                        <a href="#!" class="header-body__call-us">
                            <i class="fa-solid fa-phone"></i>
                            <span>Gọi cho chúng tôi: 123456789</span>
                        </a>

                        <?php
                        if (isset($_SESSION['user_name'])) {
                        ?>
                            <div class="header-body__user">
                                <img src="/project_noi_that/assets/imgs/icon-account.webp" alt="">

                                <span><?php echo $_SESSION['user_name'] ?> </span>

                                <div class="account-action">
                                    <a href="/project_noi_that/assets/pages/auth/logout.php" onclick="return confirm('Bạn có chắc muốn đăng xuất!')">Đăng xuất</a>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="header-body__user">
                                <img src="/project_noi_that/assets/imgs/icon-account.webp" alt="">
                                <div class="account-action">
                                    <a href="/project_noi_that/assets/pages/auth/register.php">Đăng ký</a>
                                    <a href="/project_noi_that/assets/pages/auth/login.php">Đăng nhập</a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>


                        <?php
                        $select_rows = mysqli_query($conn, "SELECT * FROM cart");
                        $row_count = mysqli_num_rows($select_rows);
                        ?>
                        <a href="<?php echo $pathCart ?>" class="header-body__cart">
                            <img src="/project_noi_that/assets/imgs/icon-cart.webp" alt="">
                            <span class="header-body__badge">
                                <?php echo $row_count ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>


            <!-- Navbar  -->
            <nav class="nav">
                <div class="container">
                    <div class="nav-body">
                        <ul class="navbar-list">
                            <li class="navbar-item">
                                <a href="/project_noi_that/" class="navbar-link">Trang chủ</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Phòng khách</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Phòng ngủ</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Phòng bếp</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Văn phòng</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Ngoài trời</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Nhà hàng - cafe</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Trang trí</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Tin tức</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- End: Header-large -->

        <!-- Begin: Header-small -->
        <header class="header fixed header--small">
            <div class="container">
                <div class="wrap-search" id="wrap-search">
                    <div class="wrap-search-body">
                        <form action="#!" class="header-body__form">
                            <input type="text" placeholder="Tìm sản phẩm" class="header-body__input">
                            <button type="submit" class="header-body__btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="header-body">
                    <div class="header-body__item">
                        <span class="header--small__bars-icon" id="bars-icon">
                            <i class="fa-solid fa-bars"></i>
                        </span>
                    </div>

                    <div class="header-body__item">
                        <a href="/" class="logo header-body__logo">
                            NHAT<span>DECOR</span>
                        </a>
                    </div>

                    <div class="header-body__item">
                        <span class="header--small__search-icon" id="search-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>

                        <?php
                        $select_rows = mysqli_query($conn, "SELECT * FROM cart");
                        $row_count = mysqli_num_rows($select_rows);
                        ?>
                        <a href="<?php echo $pathCart ?>" class="header-body__cart">
                            <img src="/project_noi_that/assets/imgs/icon-cart.webp" alt="">
                            <span class="header-body__badge">
                                <?php echo $row_count ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>


            <!-- Navbar  -->
            <nav class="nav" id="nav-small">
                <div class="container">
                    <div class="nav-body">
                        <ul class="navbar-list">
                            <li class="navbar-item">
                                <?php
                                if (isset($_SESSION['user_name'])) {
                                ?>
                                    <div class="header-body__user">
                                        <img src="/project_noi_that/assets/imgs/icon-account.webp" alt="">

                                        <span><?php echo $_SESSION['user_name'] ?> </span>

                                        <div class="account-action">
                                            <a href="/project_noi_that/assets/pages/auth/logout.php" onclick="return confirm('Bạn có chắc muốn đăng xuất!')">Đăng xuất</a>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="header-body__user header-body__user--logged-in">
                                        <img src="/project_noi_that/assets/imgs/icon-account.webp" alt="">

                                        <div class="group">
                                            <a href="/project_noi_that/assets/pages/auth/register.php">Đăng ký</a>
                                            <a href="/project_noi_that/assets/pages/auth/login.php">Đăng nhập</a>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </li>
                            <li class="navbar-item">
                                <a href="/project_noi_that/" class="navbar-link">Trang chủ</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Phòng khách</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Phòng ngủ</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Phòng bếp</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Văn phòng</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Ngoài trời</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Nhà hàng - cafe</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Trang trí</a>
                            </li>
                            <li class="navbar-item">
                                <a href="#!" class="navbar-link">Tin tức</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <script>
            const bars_icon = document.querySelector('#bars-icon');
            const nav_small = document.querySelector('#nav-small');

            bars_icon.onclick = () => {
                nav_small.classList.toggle('show-nav');
            }

            nav_small.onclick = () => {
                nav_small.classList.toggle('show-nav');
            }

            const search_icon = document.querySelector('#search-icon');
            const wrap_search = document.querySelector('#wrap-search');

            search_icon.onclick = () => {
                wrap_search.classList.toggle('show-search');
            }

            wrap_search.onclick = () => {
                wrap_search.classList.toggle('show-search');
            }
        </script>
        <!-- End: Header-small -->