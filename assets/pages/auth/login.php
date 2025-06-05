<?php
session_start();
include '../../../db.php';


if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $select = "SELECT * FROM user WHERE name = '$username'";
    $result = mysqli_query($conn, $select);

    $row = mysqli_fetch_array($result);

    // Check username, password
    if ($username != $row['name'] && $password != $row['password']) {
        $message =  "Tên đăng nhập hoặc mật khẩu không đúng";
    } else {
        if ($row['role'] == 'user' && $username == $row['name'] && $password == $row['password']) {
            $_SESSION['user_name'] = $row['name'];
            header('Location: ../../../index.php');
        } else if ($row['role'] == 'admin' && $username == $row['name'] && $password == $row['password']) {
            $_SESSION['admin_name'] = $row['name'];
            header('Location: ../../../admin.php');
        }
    }
}
?>

<?php
$pageTitle = 'Đăng nhập tài khoản';
$pathCSS = '../../css/styles.css';
$pathResetCSS = '../../css/reset.css';
$pathCart = '../../../cart.php';

require '../../../header.php';
?>

<div class="form-block">
    <div class="form-block__body">
        <h1 class="form-block__heading">ĐĂNG NHẬP TÀI KHOẢN</h1>

        <form class="form-block__form" method="post">
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span style="color: red;">' . $error . '</span>';
                }
            }
            ?>
            <div class="form-group">
                <label for="username" class="form-group__label">Tên đăng nhập <span>*</span></label>
                <input type="text" id="username" name="username" class="form-group__input" placeholder="Tên" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-group__label">Mật khẩu <span>*</span></label>
                <input type="password" id="password" name="password" class="form-group__input" placeholder="Mật khẩu" required>
            </div>

            <button type="submit" class="form-group__submit" name="login">Đăng nhập</button>

            <p style='color: red; margin-top: 16px;'>
                <?php
                echo isset($message) ? $message : '';
                ?>
            </p>

        </form>
    </div>
</div>

<?php require '../../../footer.php' ?>
</div>
</body>

</html>