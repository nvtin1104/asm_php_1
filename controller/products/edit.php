<?
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$edit_id = (int)$_SESSION['edit_id'];
$result = getRecord1Where($mysqli, 'products', 'product_id', $edit_id);
$product_row = mysqli_fetch_assoc($result);
// Xử lý dữ liệu gửi từ form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_product"])) {
    $product_name = $_POST["product_name"];
    $product_code = $_POST["product_code"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $brand = $_POST["brand"];
    $shortDescription = $_POST["short-description"];
    $cat_id = $_POST["cat_id"];

    validateProduct($product_name, $product_code, $price, $shortDescription, $description, $brand, $cat_id);
    // Kiểm tra kiểu tệp hình ảnh
    if (!empty($_FILES['image']['name'])) {
        $result = uploadImage($_FILES["image"],);
        if (isset($result)) {
            $sql = "UPDATE products 
            SET product_name = '$product_name', 
                product_code = '$product_code', 
                brand = '$brand', 
                price = '$price', 
                description = '$description', 
                short_description = '$shortDescription', 
                image = '$result', 
                cat_id = '$cat_id'
            WHERE product_id = '$edit_id'";
            if (mysqli_query($mysqli, $sql)) {
                echo "Sản phẩm đã được update thành công.";
                header("Refresh: 2; url=./index.php?m=products&a=products");
            } else {
                echo "Lỗi: " . $sql . "<br>" . mysqli_error($mysqli);
            }
        } else {
            echo $result;
        }
    } else {
        echo "Vui lòng chon 1 file" . $url_back;
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

        textarea {
            height: 6em;
            /* Chiều cao mặc định khi không có nội dung */
        }

        textarea::placeholder {

            color: transparent;
            /* Ẩn placeholder mặc định */
        }

        textarea:focus::placeholder {
            color: #aaa;
            /* Hiển thị placeholder khi textarea có focus */
        }

        textarea:not(:placeholder-shown) {
            height: auto;
            /* Khi có nội dung, textarea sẽ tự điều chỉnh chiều cao */
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
                        <input type="text" class="form-control" name="product_name" placeholder="<? echo $product_row['product_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="brand">Tên nhãn hàng:</label>
                        <input type="text" class="form-control" name="brand" id="brand" placeholder="<? echo $product_row['brand'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_code">Mã sản phẩm:</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="<? echo $product_row['product_code'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="cat_id">Danh mục:</label>
                        <select name="cat_id" id="cat_id" class="form-control">
                            <?
                            $sqlCheckCat = "SELECT * FROM cat_product";
                            $result_check = mysqli_query($mysqli, $sqlCheckCat);
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
                        <input type="number" class="form-control" id="price" name="price" placeholder="<? echo $product_row['price'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="short-description">Mô tả ngắn</label>
                        <textarea name="short-description" id="short-description" class="form-control" placeholder="<? echo $product_row['short_description'] ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <textarea name="description" id="description" class="form-control" placeholder="<? echo $product_row['description'] ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="flie">Hình ảnh:</label>
                        <input type="file" name="image" id="flie" class="form-control">
                    </div>
                    <input class="btn btn-primary" type="submit" name="edit_product" value="Save">
                </form>
            </div>
        </div>
    </div>
</body>

</html>