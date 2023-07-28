<?php
// Kết nối đến cơ sở dữ liệu (như đã mô tả ở bước 1)
include('../inc/connect.php');
// Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

// Xử lý dữ liệu gửi từ form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    $product_name = $_POST["product_name"];
    $product_code = $_POST["product_code"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $brand = $_POST["brand"];
    $shortDescription = $_POST["short-description"];
    $cat_id = $_POST["cat_id"];

    // Xử lý tệp hình ảnh
    $target_dir = addslashes("../uploads/");
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra kiểu tệp hình ảnh
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Chỉ chấp nhận các tệp JPG, JPEG, PNG.";
    } else {
        // Upload tệp hình ảnh vào thư mục "uploads"
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Lưu thông tin sản phẩm vào cơ sở dữ liệu
            $sql = "INSERT INTO products (product_name, product_code, brand, price, description,short_description, image, cat_id)
             VALUES ('$product_name','$product_code','$brand','$price', '$description','$shortDescription', '$target_file','$cat_id')";
            if (mysqli_query($mysqli, $sql)) {
                echo "Sản phẩm đã được tải lên thành công.";
            } else {
                echo "Lỗi: " . $sql . "<br>" . mysqli_error($mysqli);
            }
        } else {
            echo "Đã xảy ra lỗi khi tải lên hình ảnh.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <style>
        input,
        textarea {
            margin: 12px 0px !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="product_name">Tên sản phẩm:</label>
                        <input type="text" class="form-control" name="product_name" placeholder="Tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="brand">Tên nhãn hàng:</label>
                        <input type="text" class="form-control" name="brand" id="brand" placeholder="Tên nhãn hàng">
                    </div>
                    <div class="form-group">
                        <label for="product_code">Mã sản phẩm:</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Ví dụ: SP001">
                    </div>
                    <div class="form-group">
                        <label for="cat_id">Danh mục:</label>
                        <select name="cat_id" id="cat_id" class="form-control">
                            <?
                            $sqlCheckCat = "SELECT * FROM cat_product";
                            $result_check = mysqli_query($mysqli, $sqlCheckCat);
                            var_dump($result_check);
                            if (mysqli_num_rows($result_check) > 0) {
                                while ($row_cat = mysqli_fetch_assoc($result_check)) {
                                    echo '<option value="' . $row_cat["cat_id"] . '">' . $row_cat["cat_name"] . '</option>';
                                };
                            };
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Ví dụ: 1000">
                    </div>
                    <div class="form-group">
                        <label for="short-description">Mô tả ngắn</label>
                        <textarea name="short-description" id="short-description" class="form-control" placeholder="Mô tả ngắn 150 kí tự!"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Mô tả"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="flie">Hình ảnh:</label>
                        <input type="file" name="image" id="flie" class="form-control">
                    </div>
                    <input class="btn btn-primary" type="submit" name="add_product" value="Upload">
                </form>
            </div>
        </div>
    </div>
</body>

</html>