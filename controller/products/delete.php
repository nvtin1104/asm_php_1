<?php
include('../../inc/connect.php');
include('../../libs/function/product.php');
$product_id = $_GET['id'];
if (isset($product_id)) {
    $product = new Product($mysqli);
    if ($product->deleteProduct($product_id)) {
        // Xóa thành công
        header("Location: ../index.php"); // Chuyển người dùng trở lại trang index.php sau khi xóa thành công
        exit;
    } else {
        // Xử lý lỗi nếu không thể xóa sản phẩm
        echo "Không thể xóa sản phẩm.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <a href="/inc/connect.php">đâsd</a>
</body>

</html>