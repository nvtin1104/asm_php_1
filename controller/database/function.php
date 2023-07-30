<?
function delete1Where($mysqli, $tb_name, $where, $where_id)
{
    // Chuẩn bị câu truy vấn DELETE với tên bảng và tên cột được nối vào truy vấn SQL
    $sql = "DELETE FROM " . $tb_name . " WHERE " . $where . " = ?";
    $stmt = $mysqli->prepare($sql);

    // Kiểm tra và thực thi truy vấn DELETE
    if ($stmt) {
        // Sử dụng bind_param để gắn giá trị vào truy vấn (bind parameters)
        $stmt->bind_param("i", $where_id);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            // Truy vấn DELETE đã được thực hiện thành công
            echo "Xóa dữ liệu thành công.";
            header('Refresh: 2; url=./index.php');
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
function getRecord1Where($mysqli, $tb_name, $where, $where_id)
{
    // Chuẩn bị câu truy vấn SELECT với tên bảng và tên cột
    $sql = "SELECT * FROM " . $tb_name . " WHERE " . $where . " = '" . $mysqli->real_escape_string($where_id) . "'";

    // Thực thi truy vấn
    $result = $mysqli->query($sql);

    // Kiểm tra kết quả truy vấn
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        // Giải phóng bộ nhớ
        $result->close();

        return $row; // Trả về dữ liệu lấy được
    } else {
        // Xảy ra lỗi khi thực hiện truy vấn
        echo "Lỗi khi thực hiện truy vấn: " . $mysqli->error;
        return null; // Trả về null nếu có lỗi
    }
}
function countWordsCustom($string) {
    $words = explode(" ", trim($string));
    return count($words);
}

function getRecord($mysqli, $tb_name)
{
    // Chuẩn bị câu truy vấn SELECT với tên bảng được nối vào truy vấn SQL
    $sql = "SELECT * FROM " . $tb_name;
    $result = mysqli_query($mysqli, $sql);

    // Kiểm tra kết quả truy vấn SELECT
    if ($result) {
        // Lấy dữ liệu từ kết quả truy vấn
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        // Giải phóng bộ nhớ
        mysqli_free_result($result);

        // Đóng kết nối
        mysqli_close($mysqli);

        return $data; // Trả về dữ liệu lấy được
    } else {
        // Xảy ra lỗi khi thực hiện truy vấn
        echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($mysqli);
    }

    // Đóng kết nối
    mysqli_close($mysqli);

    return null; // Trả về null nếu có lỗi
}
function validateCategory($mysqli, $catname)
{
    $url_back = " <a href='../controller/index.php?m=category&a=cat'>Trở lại</a>";
    if (empty($catname)) {
        echo "Vui lòng nhập đầy đủ thông tin." . $url_back;
        die();
    }
    $row_check = getRecord1Where($mysqli, 'cat_product', 'cat_name', $catname);
    if (!empty($row_check)) {
        echo "Tên cat bị trùng." . $url_back;
        die();
    } else {
        return true;
    }
}
function uploadImage($file)
{
    $target_dir = "./uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $target_dir_upload = "../uploads/";
    $target_file_upload = $target_dir_upload . basename($file["name"]);

    // Kiểm tra kiểu tệp hình ảnh
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return "Chỉ chấp nhận các tệp JPG, JPEG, PNG.";
    } else {
        // Upload tệp hình ảnh vào thư mục "uploads"
        if (move_uploaded_file($file["tmp_name"], $target_file_upload)) {
            // Lưu thông tin sản phẩm vào cơ sở dữ liệu
            return $target_file;
        } else {
            return "Đã xảy ra lỗi khi tải lên hình ảnh.";
        }
    }
}
function validateProduct($product_name, $product_code, $price, $shortDescription, $description, $brand, $cat_id)
{
    $url_back = " <a href='../controller/index.php?m=products&a=products'>Trở lại</a>";
    $patternProductCode = "/^SP[A-Z0-9]{1,8}$/";
    $patternPrice = "/^\d{1,12}(\.\d{0})?$/";

    if (empty($description) || empty($brand) || empty($shortDescription) || empty($cat_id) || empty($product_code) || empty($product_name) || empty($price)) {
        // Nếu có bất kỳ trường dữ liệu nào bị rỗng, xử lý thông báo lỗi hoặc yêu cầu người dùng nhập đủ thông tin.
        echo "Vui lòng nhập đầy đủ thông tin sản phẩm." . $url_back;
        die();
    }
    if (strlen($product_name) > 79) {
        echo "Tên sản phẩm quá dài. Vui lòng nhập tên sản phẩm dưới 80 ký tự." . $url_back;
        die();
    }
    if (!preg_match($patternProductCode, $product_code)) {
        echo "Mã sản phẩm buộc phải bắt đầu bằng SP và không quá 10 kí tự !" . $url_back;
        die();
    }
    if (strlen($brand) > 50) {
        echo "Tên thương hiệu quá dài. Vui lòng nhập tên thương hiệu dưới 50 ký tự." . $url_back;
        die();
    }
    if(!preg_match($patternPrice,$price)){
        echo "Vui lòng nhập số tiền chính xác" . $url_back;
        die();
    }
    if (countWordsCustom($shortDescription)>150) {
            echo "Mô tả ngắn quá dài. Vui lòng nhập mô tả ngắn dưới 150 từ.". $url_back;
            die();
        }
}
