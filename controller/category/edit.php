<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cat_id = (int)$_SESSION['edit_id'];

if (isset($_POST['edit-cat'])) {
    // Giả sử cat_id được gửi từ form khi submit.
    $cat_name = $_POST['cat_name'];
    $path = '../inc/connect.php';
    if (file_exists($path)) include($path);
    // Bước 1: Chuẩn bị truy vấn UPDATE sử dụng prepared statement
    $sql = "UPDATE cat_product SET cat_name = ? WHERE cat_id = ?";
    $stmt = $mysqli->prepare($sql);

    // Bước 2: Kiểm tra và thực thi truy vấn UPDATE
    if ($stmt) {
        // Sử dụng bind_param để gắn các giá trị vào truy vấn (bind parameters)
        $stmt->bind_param("si", $cat_name, $cat_id);
        // Thực thi truy vấn
        if ($stmt->execute()) {
            // Truy vấn UPDATE đã được thực hiện thành công
            echo "Dữ liệu đã được chỉnh sửa thành công.";
        } else {
            // Xảy ra lỗi khi thực hiện truy vấn
            echo "Lỗi khi thực hiện truy vấn: " . $stmt->error;
        }

        // Đóng câu truy vấn
        $stmt->close();
    } else {
        // Xảy ra lỗi khi chuẩn bị truy vấn
        echo "Lỗi khi chuẩn bị truy vấn: " . $mysqli->error;
    }

    // Đóng kết nối
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="cat_name">Tên Category:</label>
                        <input type="text" class="form-control" name="cat_name" placeholder="Tên Category">
                    </div>
                    <input class="btn btn-primary" type="submit" name="edit-cat" value="Edit">
                </form>
            </div>
        </div>
    </div>
</body>

</html>