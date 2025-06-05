<?php
include 'db.php';

if (isset($_POST['update_quantity_btn'])) {
    $update_quantity = $_POST['update_quantity'];
    $update_quantity_id = $_POST['update_quantity_id'];

    $update_quantity_query = mysqli_query($conn, "UPDATE cart SET quantity = '$update_quantity' WHERE id = '$update_quantity_id' ");
    if ($update_quantity_query) {
        header('Location: cart.php');
    };
};

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$remove_id' ");
    header('Location: cart.php');
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM cart");
    header('Location: cart.php');
}
?>

<?php
$pageTitle = 'Giỏ hàng';
$pathCSS = './assets/css/styles.css';
$pathResetCSS = './assets/css/reset.css';
$pathCart = './cart.php';
?>

<!-- Import header -->
<?php require 'header.php' ?>


<main class="main-content">
    <div class="container">

        <?php
        $sql = "SELECT * FROM cart";
        $result = mysqli_query($conn, $sql);
        $grand_total = 0;

        if (mysqli_num_rows($result) > 0) {
        ?>

            <div class="title-wrap">
                <h2 class="title">Giỏ hàng</h2>
            </div>

            <!-- Shopping cart -->
            <section class="shopping-cart">
                <table>
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($product = mysqli_fetch_assoc($result)):
                        ?>
                            <tr>
                                <td>
                                    <img src='./assets/imgs/<?php echo $product['image'] ?>' height="100">
                                </td>
                                <td class="shopping-cart__name"><?php echo $product['name'] ?></td>
                                <td class="shopping-cart__price"><?php echo number_format($product['price'], 0, ',', '.') ?>₫</td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="update_quantity_id" value="<?php echo $product['id'] ?>">
                                        <div class="form-group">
                                            <input type="number" name="update_quantity" id="" min="1" value="<?php echo $product['quantity'] ?>">
                                            <input type="submit" value="Cập nhật" name="update_quantity_btn">
                                        </div>
                                    </form>
                                </td>
                                <td class="shopping-cart__total">
                                    <?php echo number_format($product['price'] * $product['quantity'], 0, ',', '.') ?>₫
                                </td>
                                <td class="shopping-cart__remove-btn">
                                    <a href="./cart.php?remove=<?php echo $product['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $sub_total = $product['price'] * $product['quantity'];
                            $grand_total += $sub_total;
                        endwhile;
                        ?>

                        <tr>
                            <td>
                                <a href="./index.php" class="shopping-cart_btn-continue">Tiếp tục mua sắm</a>
                            </td>
                            <td colspan="3">Tổng tiền các sản phẩm</td>
                            <td class="shopping-cart__total-all">
                                <?php echo number_format($grand_total, 0, ',', '.') ?>₫
                            </td>
                            <td class="shopping-cart__remove-btn">
                                <a href="./cart.php?delete_all=" onclick="return confirm('Bạn có chắc muốn xóa tất cả!')">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Xóa tất cả
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="checkout-btn">
                    <a href="./checkout.php">Tiến hành thanh toán</a>
                </div>
            </section>

        <?php
        } else {
        ?>
            <div class="cart-empty">
                <img src="./assets/imgs/cart_empty_background.webp" alt="">
                <h2>“Hổng” có gì trong giỏ hết</h2>
                <p>Về trang cửa hàng để chọn mua sản phẩm bạn nhé!!</p>
                <a href="./index.php">Mua sắm ngay</a>
            </div>
        <?php } ?>
    </div>

</main>


<!-- Import footer -->
<?php require 'footer.php'  ?>
</div>
</body>

</html>