<?php
session_start();
include 'db.php';

if (!$_SESSION['admin_name']) {
    header('Location: ./assets/pages/auth/login.php');
};

if (isset($_POST['add_product'])) {
    $p_name = $_POST['p_name'];
    $p_old_price = $_POST['p_old_price'];
    $p_new_price = $_POST['p_new_price'];
    $p_color = $_POST['p_color'];
    $p_size = $_POST['p_size'];
    $p_material = $_POST['p_material'];
    $p_sale = $_POST['p_sale'];

    $p_img = $_FILES['p_img']['name'];
    $p_img_tmp_name = $_FILES['p_img']['tmp_name'];
    $p_img_folder = './assets/imgs/' . $p_img;

    $p_desc = $_POST['p_desc'];
    $p_category = $_POST['p_category'];

    $insert_query = mysqli_query($conn, "INSERT INTO products(name, oldPrice, newPrice, color, size, material, sale, image, description, category) 
    VALUES('$p_name', '$p_old_price', '$p_new_price', '$p_color', '$p_size', ' $p_material', '$p_sale', '$p_img', '$p_desc', '$p_category')");

    if ($insert_query) {
        move_uploaded_file($p_img_tmp_name, $p_img_folder);
        $message[] = 'Thêm sản phẩm thành công!';
    } else {
        $message[] = 'Không thêm sản phẩm được!';
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM products WHERE id = $delete_id ");

    if ($delete_query) {
        $message[] = 'Xóa sản phẩm thành công!';
    } else {
        $message[] = 'Không xóa sản phẩm được!';
    }
}

if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_old_price = $_POST['update_old_price'];
    $update_new_price = $_POST['update_new_price'];
    $update_p_color = $_POST['update_p_color'];
    $update_p_size = $_POST['update_p_size'];
    $update_p_material = $_POST['update_p_material'];
    $update_p_sale = $_POST['update_p_sale'];

    $update_p_img = $_FILES['update_p_img']['name'];
    $update_p_img_tmp_name = $_FILES['update_p_img']['tmp_name'];
    $update_p_img_folder = './assets/imgs/' . $update_p_img;

    $update_p_desc = $_POST['update_p_desc'];
    $update_p_category = $_POST['update_p_category'];


    $update_query = mysqli_query($conn, "UPDATE products SET name = '$update_p_name', oldPrice = $update_old_price, newPrice = $update_new_price,
    color = '$update_p_color', size = '$update_p_size', material = '$update_p_material', sale = $update_p_sale, image = '$update_p_img',
    description = '$update_p_desc', category = '$update_p_category' WHERE id = $update_p_id");

    if ($update_query) {
        $message[] = "Cập nhật thành công!";
        move_uploaded_file($update_p_img_tmp_name, $update_p_img_folder);
        header('Location: admin.php');
    } else {
        $message[] = "Không cập nhật được!";
        header('Location: admin.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo "
                <div class='message'>
                    <span>$message</span>
                    <i class='fa-solid fa-circle-xmark' onclick='this.parentElement.style.display= `none`;'></i>
                </div>";
        }
    }
    ?>

    <a href="./assets/pages/auth/logout_admin.php" style="padding: 20px; display: block;">Đăng xuất admin</a>

    <!-- Add product -->
    <section class="form-container add-product-wrap">
        <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
            <h1>Thêm sản phẩm</h1>

            <input type="text" placeholder="Tên sản phẩm" name="p_name" require>
            <input type="number" placeholder="Giá cũ" name="p_old_price" require>
            <input type="number" placeholder="Giá mới" name="p_new_price" require>
            <input type="text" placeholder="Màu sắc" name="p_color" require>
            <input type="text" placeholder="Kích thước" name="p_size" require>
            <input type="text" placeholder="Chất liệu" name="p_material" require>
            <input type="number" placeholder="Giảm giá" name="p_sale" require>
            <input type="file" name="p_img" accept="image/png, image/jpg, image/jpeg, image/webp" require>
            <textarea name="p_desc" placeholder="Mô tả" id="" require></textarea>
            <input type="text" placeholder="Danh mục" name="p_category" require>

            <input type="submit" value="Thêm sản phẩm" name="add_product">
        </form>
    </section>

    <!-- Display product -->
    <section class="display-product-table">
        <table>
            <tr>
                <th>Hình ảnh</th>
                <th>Tên</th>
                <th>Giá cũ</th>
                <th>Giá mới</th>
                <th>Màu</th>
                <th>Kích thước</th>
                <th>Chất liệu</th>
                <th>Giảm giá</th>
                <th>Mô tả</th>
                <th>Danh mục</th>
                <th></th>
            </tr>

            <?php
            $product_query = mysqli_query($conn, "SELECT * FROM products");

            if (mysqli_num_rows($product_query) > 0) {
                while ($product_fetch = mysqli_fetch_assoc($product_query)) {
            ?>

                    <tr>
                        <td>
                            <img src="./assets/imgs/<?php echo $product_fetch['image'] ?>" alt="" style="width: 60px; height: 60px; object-fit:cover;">
                        </td>
                        <td style="width: 250px">
                            <?php echo $product_fetch['name'] ?>
                        </td>
                        <td>
                            <?php echo number_format($product_fetch['oldPrice'], 0, ',', '.') ?>₫
                        </td>
                        <td>
                            <?php echo number_format($product_fetch['newPrice'], 0, ',', '.') ?>₫
                        </td>
                        <td>
                            <?php echo $product_fetch['color'] ?>
                        </td>
                        <td>
                            <?php echo $product_fetch['size'] ?>
                        </td>
                        <td>
                            <?php echo $product_fetch['material'] ?>
                        </td>
                        <td>
                            <?php echo $product_fetch['sale'] ?>
                        </td>
                        <td>
                            <?php echo $product_fetch['description'] ?>
                        </td>
                        <td>
                            <?php echo $product_fetch['category'] ?>
                        </td>
                        <td style="width: 140px">
                            <a href="admin.php?edit=<?php echo $product_fetch['id'] ?>" class="edit-btn">
                                <i class="fa-regular fa-pen-to-square"></i>
                                Chỉnh sửa
                            </a>
                            <a href="admin.php?delete=<?php echo $product_fetch['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa!')" class="delete-btn">
                                <i class="fa-solid fa-trash"></i>
                                Xóa
                            </a>
                        </td>
                    </tr>
            <?php
                };
            } else {
                echo "<p>Không có sản phẩm trong products</p>";
            }
            ?>
        </table>
    </section>


    <!-- Edit product form -->
    <section class="form-container edit-product-container">
        <?php
        if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM products WHERE id = $edit_id");

            if (mysqli_num_rows($edit_query) > 0) {
                while ($edit_fetch = mysqli_fetch_assoc($edit_query)):
        ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <img src="./assets/imgs/<?php echo $edit_fetch['image'] ?>" alt="" height="60">
                        <input type="hidden" name="update_p_id" value="<?php echo $edit_fetch['id'] ?>">
                        <input type="text" placeholder="Tên sản phẩm" name="update_p_name" value="<?php echo $edit_fetch['name'] ?>">
                        <input type="number" placeholder="Giá cũ" name="update_old_price" value="<?php echo $edit_fetch['oldPrice'] ?>">
                        <input type="number" placeholder="Giá mới" name="update_new_price" value="<?php echo $edit_fetch['newPrice'] ?>">
                        <input type="text" placeholder="Màu sắc" name="update_p_color" value="<?php echo $edit_fetch['color'] ?>">
                        <input type="text" placeholder="Kích thước" name="update_p_size" value="<?php echo $edit_fetch['size'] ?>">
                        <input type="text" placeholder="Chất liệu" name="update_p_material" value="<?php echo $edit_fetch['material'] ?>">
                        <input type="number" placeholder="Giảm giá" name="update_p_sale" value="<?php echo $edit_fetch['sale'] ?>">
                        <input type="file" name="update_p_img" accept="image/png, image/jpg, image/jpeg, image/webp">
                        <textarea name="update_p_desc" placeholder="Mô tả" id="" rows="10">
                            <?php echo $edit_fetch['description'] ?>
                        </textarea>
                        <input type="text" placeholder="Danh mục" name="update_p_category" value="<?php echo $edit_fetch['category'] ?>">


                        <input type="submit" value="Cập nhật sản phẩm" class="update_product_btn" name="update_product">
                        <input type="button" value="Đóng" id="close-btn">
                    </form>

        <?php
                endwhile;
            };
            echo "
                <script>document.querySelector('.edit-product-container').style.display = 'flex';</script>
                ";
        };
        ?>
    </section>

    <script>
        document.querySelector('#close-btn').onclick = () => {
            window.location.href = 'admin.php';
        };
    </script>
</body>

</html>