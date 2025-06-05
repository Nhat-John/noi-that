<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$product = mysqli_fetch_assoc($result);

// Click Add to cart btn
if (isset($_POST['addToCart'])) {
    if (isset($_SESSION['user_name'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$product_name' ");

        if (mysqli_num_rows($select_cart) > 0) {
            $_SESSION['cart_message'] = 'Sản phẩm đã có trong giỏ hàng!';
        } else {
            $insert_product = mysqli_query($conn, "INSERT INTO cart(name, price, image, quantity)
             VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
            $_SESSION['cart_message'] = 'Sản phẩm đã được thêm vào giỏ hàng!';
        }

        // Chuyển hướng sau khi xử lý để tránh lỗi resubmission
        header("Location: product.php?id=$id");
        exit();
    } else {
        header('Location: ./assets/pages/auth/login.php');
    }
}

// Click buy now btn
if (isset($_POST['buyNow'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$product_name' ");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Sản phẩm đã có trong giỏ hàng!';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO cart(name, price, image, quantity)
         VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        header('Location: cart.php');
    }
}
?>

<!-- Check & show message -->
<?php
if (isset($_SESSION['cart_message'])) {
    echo "
                <div class='message'>
                    <span> {$_SESSION['cart_message']} </span>
                    <i class='fa-solid fa-circle-xmark' onclick='this.parentElement.style.display= `none`;'></i>
                </div>";
    unset($_SESSION['cart_message']);
}
?>

<?php
$pageTitle = $product['name'];
$pathCSS = './assets/css/styles.css';
$pathResetCSS = './assets/css/reset.css';
$pathCart = './cart.php';

include 'header.php';
?>

<div class="product-detail">
    <div class="container">
        <!-- Products -->
        <div class="body">
            <div class="product-detail__img">
                <img src="./assets/imgs/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>


            <div class="product-detail__content">
                <h2 class="product-detail__name"><?php echo $product['name']; ?></h2>

                <div class="product-detail__price-box">
                    <strong class="product-detail__new-price">
                        <?php echo number_format($product['newPrice'], 0, ',', '.'); ?>đ
                    </strong>
                    <span class="product-detail__old-price">
                        <?php echo number_format($product['oldPrice'], 0, ',', '.'); ?>đ
                    </span>
                    <strong class="sale product-detail__sale">-<?php echo $product['sale']; ?>%</strong>
                    <p class="product-detail__save-price">
                        (Tiết kiệm
                        <strong>
                            <?php echo number_format($product['oldPrice'] - $product['newPrice'], 0, ',', '.'); ?>)
                        </strong>
                    </p>
                </div>
                <form action="" method="post">
                    <div class="product-detail__form-btn">
                        <div class="product-detail__group">
                            <div class="product-detail__quantity-group">
                                <input type="number" name="product_quantity" value="1" min="1">
                            </div>

                            <input type="hidden" name="product_name" value="<?php echo $product['name'] ?>">
                            <input type="hidden" name="product_price" value="<?php echo $product['newPrice'] ?>">
                            <input type="hidden" name="product_image" value="<?php echo $product['image'] ?>">
                            <button type="submit" name="addToCart" class="btn btn--add-to-cart">Thêm vào giỏ</button>
                        </div>
                        <button type="submit" name="buyNow" class="btn btn--buy-now">Mua ngay</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- tab link -->
        <!-- Tab links -->
        <div class="tab">
            <button class="tablinks" onclick="showContent(event, 'tab-link-1')">Mô tả sản phẩm</button>
            <button class="tablinks" onclick="showContent(event, 'tab-link-2')">Chính sách bảo hành</button>
            <button class="tablinks" onclick="showContent(event, 'tab-link-3')">Chính sách vận chuyển</button>
        </div>

        <!-- Tab content -->
        <div id="tab-link-1" class="tabcontent">
            <div class="product-detail__info">
                <h2>Mô tả sản phẩm</h2>
                <p>
                    <strong>Tên sản phẩm:</strong>
                    <?php echo $product['name'] ?>
                </p>
                <p>
                    <strong>Kích thước:</strong>
                    <?php echo $product['size'] ?>
                </p>
                <p>
                    <strong>Màu sắc:</strong>
                    <?php echo $product['color'] ?>
                </p>
                <p>
                    <strong>Chất liệu:</strong>
                    <?php echo $product['material'] ?>
                </p>

                <h2>Giới thiệu sản phẩm</h2>
                <p>
                    <?php
                    echo $product['description'];
                    ?>
                </p>
            </div>
        </div>

        <div id="tab-link-2" class="tabcontent">
            <p style="line-height: 1.8;">
                - Các sản phẩm mua tại Showroom LAVIEHOME đều được bảo hành nhanh chóng,tận tâm và chu đáo . Áp dụng bảo hành miễn phí với những trường hợp sau. <br>
                - Sản phẩm nhập khẩu da thật : 2 Năm <br>
                - Sản phẩm sản xuất tại VIỆT NAM, giả da: 1 Năm <br>
                - Các sản phẩm khác( bàn ăn, bàn trà...): 1 Năm <br>
                - Riêng đối với các sản phẩm xi mạ: 03 tháng <br>
                Sau thời gian bảo hành LAVIEHOME nếu phát sinh nhu cầu LAVIEHOME sẽ hỗ trợ Qúy Khách hàng chi phí nhập nguyên liệu và công thay. <br>
                Lưu ý: Trường hợp hàng hóa không được bảo hành khi: <br>
                - Hàng hóa đã được sửa chữa ở một đơn vị khác <br>
                - Hàng hóa bị lỗi không phải do nhà sản xuất như bị cắt rách, bị vật nặng hay va đạp mạnh làm ảnh hưởng đến kết cấu khung <br>
                - Hàng hóa bị lỗi do tác nhân xunh quanh như hóa chất, hay động vật nuôi trong nhà. <br>
                - Trong trường hợp không được bảo hành thì chúng tôi hỗ trợ bảo trì hàng hóa với mức phí hỗ trợ chỉ tính theo nguyên liệu trên thị trường
            </p>

            <p style="text-align:center; font-weight: 600;">
                <strong>Chúng tôi xin chân thành cảm ơn Quý khách đã dành thời gian tham khảo sản phẩm và các chính sách của Công ty chúng tôi.</strong>
            </p>
        </div>

        <div id="tab-link-3" class="tabcontent">
            <h3>Nội dung đang được cập nhật</h3>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
</div>

<!-- Show tab content -->
<script>
    function showContent(evt, content) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(content).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

</body>

</html>