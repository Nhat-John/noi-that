<?php
include '../../../db.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Không hash lại mật khẩu
    $c_password = $_POST['c_password']; // Không hash lại mật khẩu

    $select = "SELECT * FROM user WHERE name = '$username'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'Người dùng đã tồn tại';
    } else {
        if ($password != $c_password) {
            $error[] = 'Mật khẩu và xác nhận mật khẩu không khớp!';
        } else {
            $insert = "INSERT INTO user(name, password) VALUES ('$username', '$password') ";
            mysqli_query($conn, $insert);
            header('Location: login.php');
        }
    }
}

?>

<?php
$pageTitle = 'Đăng Ký Tài Khoản';
$pathCSS = '../../css/styles.css';
$pathResetCSS = '../../css/reset.css';
$pathCart = '../../../cart.php';

require '../../../header.php';
?>

<div class="form-block">
    <div class="form-block__body">
        <h1 class="form-block__heading">ĐĂNG KÝ TÀI KHOẢN</h1>
        <p class="form-block__desc">Bạn đã có tài khoản? <a href="./login.php">Đăng nhập tại đây</a></p>

        <form class="form-block__form" method="post">
            <div class="form-group">
                <label for="username" class="form-group__label">Tên đăng nhập <span>*</span></label>
                <input type="text" id="username" name="username" class="form-group__input" placeholder="Tên" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-group__label">Mật khẩu <span>*</span></label>
                <input type="password" id="password" name="password" class="form-group__input" placeholder="Mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="c_password" class="form-group__label">Xác nhận mật khẩu <span>*</span></label>
                <input type="password" id="c_password" name="c_password" class="form-group__input" placeholder="Xác nhận mật khẩu" required>
            </div>

            <button type="submit" class="form-group__submit" name="register">Đăng ký</button>
        </form>

        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<p style="color: red; margin-top: 12px;">' . $error . '</p>';
            }
        }
        ?>
    </div>
</div>

<?php require '../../../footer.php' ?>
</div>
</body>

</html>