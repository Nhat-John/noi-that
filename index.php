<?php
include 'db.php';

$living_room_data = mysqli_query($conn, "SELECT * FROM products WHERE category = 'Phòng khách' ");
$bed_room_data = mysqli_query($conn, "SELECT * FROM products WHERE category = 'Phòng ngủ' ");
$kitchen_room_data = mysqli_query($conn, "SELECT * FROM products WHERE category = 'Phòng bếp' ");
$out_door_data = mysqli_query($conn, "SELECT * FROM products WHERE category = 'Ngoài trời' ");
?>

<?php
$pageTitle = 'Nhat Decor';
$pathCSS = './assets/css/styles.css';
$pathResetCSS = './assets/css/reset.css';
$pathCart = './cart.php';
?>




<!-- Import header -->
<?php include 'header.php' ?>

<!-- Begin: products -->
<main class="main-content main-content--no-padding-top">

    <!-- Slider -->
    <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" navigation="true" space-between="30"
        centered-slides="true" autoplay-delay="2500" autoplay-disable-on-interaction="false">
        <swiper-slide>
            <img src="./assets/imgs/slider_1.webp" alt="">
        </swiper-slide>
        <swiper-slide>
            <img src="./assets/imgs/slider_2.jpg" alt="">
        </swiper-slide>
        <swiper-slide>
            <img src="./assets/imgs/slider_3.jpg" alt="">
        </swiper-slide>
        <swiper-slide>
            <img src="./assets/imgs/slider_4.jpg" alt="">
        </swiper-slide>
    </swiper-container>

    <div class="products">
        <!-- Living room -->
        <div class="container">
            <div class="title-wrap">
                <h2 class="title">Nội thất phòng khách</h2>
            </div>

            <div class="products__list">
                <?php
                if (mysqli_num_rows($living_room_data) > 0) {
                    while ($product = mysqli_fetch_assoc($living_room_data)): ?>
                        <div class='products__item'>
                            <a href='product.php?id=<?php echo $product['id']; ?>' class='products__link-img'>
                                <img class='products__img' src='./assets/imgs/<?php echo $product['image'] ?>'>
                            </a>

                            <div class='products__content'>
                                <p class='products__name'>
                                    <a href='product.php?id=<?php echo $product['id']; ?>'>
                                        <?php echo $product['name'] ?>
                                    </a>
                                </p>
                                <span class='products__new-price'>
                                    <?php echo number_format($product['newPrice'], 0, ',', '.') ?>₫
                                </span>
                                <span class='products__old-price'>
                                    <?php echo number_format($product['oldPrice'], 0, ',', '.') ?>₫
                                </span>
                                <span class='sale products__sale'>
                                    -<?php echo $product['sale'] ?>%
                                </span>
                            </div>
                        </div>
                <?php
                    endwhile;
                }
                ?>
            </div>
        </div>

        <!-- Bed room -->
        <div class="container">
            <div class="title-wrap">
                <h2 class="title">Nội thất phòng ngủ</h2>
            </div>

            <div class="products__list">
                <?php
                if (mysqli_num_rows($bed_room_data) > 0) {
                    while ($product = mysqli_fetch_assoc($bed_room_data)): ?>
                        <div class='products__item'>
                            <a href='product.php?id=<?php echo $product['id']; ?>' class='products__link-img'>
                                <img class='products__img' src='./assets/imgs/<?php echo $product['image'] ?>'>
                            </a>

                            <div class='products__content'>
                                <p class='products__name'>
                                    <a href='product.php?id=<?php echo $product['id']; ?>'>
                                        <?php echo $product['name'] ?>
                                    </a>
                                </p>
                                <span class='products__new-price'>
                                    <?php echo number_format($product['newPrice'], 0, ',', '.') ?>₫
                                </span>
                                <span class='products__old-price'>
                                    <?php echo number_format($product['oldPrice'], 0, ',', '.') ?>₫
                                </span>
                                <span class='sale products__sale'>
                                    -<?php echo $product['sale'] ?>%
                                </span>
                            </div>
                        </div>
                <?php
                    endwhile;
                }
                ?>
            </div>
        </div>

        <!-- Kitchen room -->
        <div class="container">
            <div class="title-wrap">
                <h2 class="title">Nội thất phòng bếp</h2>
            </div>

            <div class="products__list">
                <?php
                if (mysqli_num_rows($kitchen_room_data) > 0) {
                    while ($product = mysqli_fetch_assoc($kitchen_room_data)): ?>
                        <div class='products__item'>
                            <a href='product.php?id=<?php echo $product['id']; ?>' class='products__link-img'>
                                <img class='products__img' src='./assets/imgs/<?php echo $product['image'] ?>'>
                            </a>

                            <div class='products__content'>
                                <p class='products__name'>
                                    <a href='product.php?id=<?php echo $product['id']; ?>'>
                                        <?php echo $product['name'] ?>
                                    </a>
                                </p>
                                <span class='products__new-price'>
                                    <?php echo number_format($product['newPrice'], 0, ',', '.') ?>₫
                                </span>
                                <span class='products__old-price'>
                                    <?php echo number_format($product['oldPrice'], 0, ',', '.') ?>₫
                                </span>
                                <span class='sale products__sale'>
                                    -<?php echo $product['sale'] ?>%
                                </span>
                            </div>
                        </div>
                <?php
                    endwhile;
                }
                ?>
            </div>
        </div>

        <!-- Outdoor -->
        <div class="container">
            <div class="title-wrap">
                <h2 class="title">Nội thất ngoài trời</h2>
            </div>

            <div class="products__list">
                <?php
                if (mysqli_num_rows($out_door_data) > 0) {
                    while ($product = mysqli_fetch_assoc($out_door_data)): ?>
                        <div class='products__item'>
                            <a href='product.php?id=<?php echo $product['id']; ?>' class='products__link-img'>
                                <img class='products__img' src='./assets/imgs/<?php echo $product['image'] ?>'>
                            </a>

                            <div class='products__content'>
                                <p class='products__name'>
                                    <a href='product.php?id=<?php echo $product['id']; ?>'>
                                        <?php echo $product['name'] ?>
                                    </a>
                                </p>
                                <span class='products__new-price'>
                                    <?php echo number_format($product['newPrice'], 0, ',', '.') ?>₫
                                </span>
                                <span class='products__old-price'>
                                    <?php echo number_format($product['oldPrice'], 0, ',', '.') ?>₫
                                </span>
                                <span class='sale products__sale'>
                                    -<?php echo $product['sale'] ?>%
                                </span>
                            </div>
                        </div>
                <?php
                    endwhile;
                }
                ?>
            </div>
        </div>
    </div>
</main>

<!-- Begin: Policies  -->
<div class="policies">
    <div class="container">
        <div class="policies__body">
            <div class="policies__item">
                <div class="policies__icon">
                    <img src="./assets/imgs/policies_icon_1.webp" alt="">
                </div>
                <div class="policies__content">
                    <h3>Hotline: 123456789</h3>
                    <p>Dịch vụ hỗ trợ bạn 24/7</p>
                </div>
            </div>

            <div class="policies__item">
                <div class="policies__icon">
                    <img src="./assets/imgs/policies_icon_2.webp" alt="">
                </div>
                <div class="policies__content">
                    <h3>Nhiều khuyến mãi HOT</h3>
                    <p>Nhiều ưu đãi khuyến mãi hot trong dịp cuối năm</p>
                </div>
            </div>

            <div class="policies__item">
                <div class="policies__icon">
                    <img src="./assets/imgs/policies_icon_3.webp" alt="">
                </div>
                <div class="policies__content">
                    <h3>Đổi trả miễn phí</h3>
                    <p>Trong vòng 48 giờ</p>
                </div>
            </div>

            <div class="policies__item">
                <div class="policies__icon">
                    <img src="./assets/imgs/policies_icon_4.webp" alt="">
                </div>
                <div class="policies__content">
                    <h3>Giá luôn tốt nhất</h3>
                    <p>Giá luôn thấp nhất so với thị trường</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End: Policies  -->

<!-- Import footer -->
<?php include 'footer.php'  ?>
</div>

<!-- CDN swiper slider -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

</body>

</html>