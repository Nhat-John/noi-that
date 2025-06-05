<?php
include 'db.php';

// Nhấn nút thanh toán
if (isset($_POST['checkout_btn'])) {
    $fullName = $_POST['fullName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    // Kiểm tra form
    if ($fullName == '' || $phoneNumber == '' || $email == '' || $address == '' || $city == '') {
        $message[] = '<p>Bạn chưa nhập đầy đủ thông tin</p>';
    } else {
        // SELECT cart để tính giá
        $cart_query = mysqli_query($conn, "SELECT * FROM cart");
        $price_total = 0;
        if (mysqli_num_rows($cart_query) > 0) {
            while ($cartItem = mysqli_fetch_assoc($cart_query)) {
                $product_name[] = $cartItem['name'] . '(' . $cartItem['quantity'] . ')';
                $product_price =   $cartItem['price'] * $cartItem['quantity'];
                $price_total += $product_price;
            };
        };

        $total_product = implode(', ', $product_name);
        $total_price = number_format($price_total, 0, ',', '.');

        // Add sản phẩm vô table order_product
        $detail_query = mysqli_query($conn, "INSERT INTO `order_product`(fullName, phoneNumber, email, paymentMethod,	
        address, city, total_products, total_price) VALUES ('$fullName', '$phoneNumber', '$email', '$payment_method', '$address', '$city', '$total_product', '$total_price') ");

        if ($cart_query && $detail_query) {
            mysqli_query($conn, "DELETE FROM cart");
            echo "
                <div class='order-message-container'>
                    <div class='message-container'>
                        <h3>Cảm ơn bạn vì đã mua hàng!</h3>

                        <div class='order-detail'>
                            <span>$total_product</span>
                            <span class='total'>Tổng tiền: " . $total_price . "đ</span>
                        </div>

                        <div class='customer-detail'>
                            <p>Tên của bạn: <span>$fullName</span></p>
                            <p>Số điện thoại: <span>$phoneNumber</span></p>
                            <p>Email: <span>$email</span></p>
                            <p>Phương thức thanh toán: <span>$payment_method</span></p>
                            <p>Địa chỉ: <span>$address</span></p>
                            <p>Thành phố: <span>$city</span></p>
                        </div>

                        <a href='./index.php'>Quay về trang chủ</a>
                    </div>
                </div>";
        }
    }
}
?>

<?php
$pageTitle = 'Thanh toán';
$pathCSS = './assets/css/styles.css';
$pathResetCSS = './assets/css/reset.css';
$pathCart = './cart.php';
?>

<!-- Import header -->
<?php include 'header.php' ?>


<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo "
                <div class='message message--error'>
                    <span>$message</span>
                    <i class='fa-solid fa-circle-xmark' onclick='this.parentElement.style.display= `none`;'></i>
                </div>";
    }
}
?>

<main class="main-content">
    <div class="container">
        <div class="title-wrap">
            <h2 class="title">Hoàn thành đơn hàng</h2>
        </div>


        <!-- Checkout form -->
        <section class="checkout-form">
            <form action="" method="post" class="checkout-form__form">
                <div class="checkout-form_flex">
                    <div class="checkout-form__form-item">
                        <span>Họ tên</span>
                        <input type="text" placeholder="Tên" name="fullName" require value="<?php echo isset($fullName) ? $fullName : '' ?>">
                    </div>
                    <div class="checkout-form__form-item">
                        <span>Số điện thoại</span>
                        <input type="number" placeholder="Tên" name="phoneNumber" require value="<?php echo isset($phoneNumber) ? $phoneNumber : '' ?>">
                    </div>
                    <div class="checkout-form__form-item">
                        <span>Email</span>
                        <input type="email" placeholder="Tên" name="email" require value="<?php echo isset($email) ? $email : '' ?>">
                    </div>
                    <div class="checkout-form__form-item">
                        <span>Phương thức thanh toán</span>
                        <select name="payment_method" id="">
                            <option value="cash" selected>Tiền mặt</option>
                            <option value="transfer">Chuyển khoản</option>
                            <option value="swipe_card">Quẹt thẻ</option>
                        </select>
                    </div>
                    <div class="checkout-form__form-item">
                        <span>Địa chỉ</span>
                        <input type="text" placeholder="Tên" name="address" require value="<?php echo isset($address) ? $address : '' ?>">
                    </div>
                    <div class="checkout-form__form-item">
                        <span>Thành phố</span>
                        <input type="text" placeholder="Tên" name="city" require value="<?php echo isset($city) ? $city : '' ?>">
                    </div>
                </div>

                <!-- Show grand total -->
                <div class="show-order">
                    <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM cart");
                    $grand_total = 0;

                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($item_cart = mysqli_fetch_assoc($select_cart)):
                            $total_price = $item_cart['price'] * $item_cart['quantity'];
                            $grand_total += $total_price;
                        endwhile;
                    } else {
                    ?>
                        <p style="color: red; margin-top: 16px;">Không có sản phẩm trong giỏ hàng</p>
                    <?php
                    }
                    ?>

                    <p class="grand-total"> Tổng tiền: <?php echo number_format($grand_total, 0, ',', '.') ?>₫</p>
                </div>

                <input type="submit" value="Thanh toán ngay" name="checkout_btn" class="checkout-form__btn-checkout">
            </form>
        </section>
    </div>
</main>


<!-- Import footer -->
<?php include 'footer.php'  ?>
</div>
</body>

</html>