<?php
if (isset($_GET['id'])) {
    $cat_id = $_GET['id'];
    $result = getRecord1Where($mysqli, 'products', 'cat_id', $cat_id);
    /** @intelephense-ignore-error */
    $num_rows = mysqli_num_rows($result);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <h3>Danh sách sản phẩm:</h3>
    <?php
    // Check if there are products to display
    if ($num_rows > 0) {
        echo '<table class="table table-bordered table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Tên sản phẩm</th>';
        echo '<th>Giá</th>';
        echo '<th>Nhãn hàng</th>';
        echo '<th>Hình ảnh</th>';
        echo '<th>Thao tác</th>'; // New column for action buttons
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row["product_name"] . '</td>';
            echo '<td>' . $row["price"] . '</td>';
            echo '<td>' . $row["brand"] . '</td>';
            echo '<td><img src=".' . $row["image"] . '" alt="Product Image" class="img-thumbnail" style="max-width: 100px;"></td>';
            echo '<td>';
            echo '<a href="./index.php?m=products&a=edit&id=' . $row["product_id"] . '" class="btn btn-primary">Sửa</a>'; // Edit button with a link to edit_product.php
            echo ' ';
            echo '<a href="./index.php?m=products&a=delete&id=' . $row["product_id"] . '" class="btn btn-danger">Xóa</a>'; // Delete button with a link to delete_product.php
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "Không có sản phẩm.";
    }
    // Đóng kết nối đến cơ sở dữ liệu
    ?>
    <a href="../controller/index.php?m=products&a=add" class="btn btn-primary">Thêm sản phẩm</a>
</body>

</html>