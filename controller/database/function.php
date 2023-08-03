<?
$url_back = " <a href='javascript: history.go(-1)'>Trở lại</a>";
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
    $result = mysqli_query($mysqli, $sql);
    return $result;
}


function countWordsCustom($string)
{
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
        return $result;
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
    global $url_back;
    if (empty($catname)) {
        echo "Vui lòng nhập đầy đủ thông tin." . $url_back;
        die();
    }
    $row_check = getRecord1Where($mysqli, 'cat_product', 'cat_name', $catname);
    
    $num_row = mysqli_num_rows($row_check);
    /** @intelephense-ignore-line */
    if ($num_row > 0) {
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
        if (file_exists($target_file_upload)) {
            $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
            $newFileName = $fileName . '-Copy';
            $target_file = $target_dir . $newFileName . '.' . $imageFileType;
            $target_file_upload = $target_dir_upload . $newFileName . '.' . $imageFileType;

            $cnt = 1;

            while (file_exists($target_file_upload)) {
                $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
                $newFileName = $fileName . '-Copy(' . $cnt . ')';
                $target_file = $target_dir . $newFileName . '.' . $imageFileType;
                $target_file_upload = $target_dir_upload . $newFileName . '.' . $imageFileType;;
                $cnt++;
            }
            if (move_uploaded_file($file["tmp_name"], $target_file_upload)) {
                // Lưu thông tin sản phẩm vào cơ sở dữ liệu
                return $target_file;
            } else {
                return "Đã xảy ra lỗi khi tải lên hình ảnh.";
            }
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file_upload)) {
                // Lưu thông tin sản phẩm vào cơ sở dữ liệu
                return $target_file;
            } else {
                return "Đã xảy ra lỗi khi tải lên hình ảnh.";
            }
        }
        // Upload tệp hình ảnh vào thư mục "uploads"

    }
}
function validateProduct($product_name, $product_code, $price, $shortDescription, $description, $brand, $cat_id)
{
    global $url_back;
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
    if (!preg_match($patternPrice, $price)) {
        echo "Vui lòng nhập số tiền chính xác" . $url_back;
        die();
    }
    if (countWordsCustom($shortDescription) > 150) {
        echo "Mô tả ngắn quá dài. Vui lòng nhập mô tả ngắn dưới 150 từ." . $url_back;
        die();
    }
}
function isValidPassword($password)
{
    // Biểu thức chính qui kiểm tra mật khẩu phải có ít nhất 1 ký tự đặc biệt, 1 chữ hoa và 1 số, và có từ 8 đến 30 ký tự
    $pattern = '/^(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[A-Z])(?=.*[0-9]).{8,30}$/';

    // Sử dụng hàm preg_match để kiểm tra
    if (preg_match($pattern, $password)) {
        return true; // Mật khẩu hợp lệ
    } else {
        return false; // Mật khẩu không hợp lệ
    }
}
function isValidDate($date)
{
    // Chuyển đổi chuỗi ngày thành đối tượng DateTime
    $inputDate = new DateTime($date);

    // Tính ngày hiện tại
    $currentDate = new DateTime();

    // Tính tuổi bằng cách tính hiệu giữa năm nhập vào và năm hiện tại
    $age = $currentDate->diff($inputDate)->y;

    // Kiểm tra nếu tuổi nhỏ hơn 10 hoặc lớn hơn 150 thì trả về false
    if ($age < 10 || $age > 150) {
        return false; // Ngày không hợp lệ
    } else {
        return true; // Ngày hợp lệ
    }
}

function isValidEmail($email)
{
    // Biểu thức chính qui để kiểm tra địa chỉ email
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    // Sử dụng hàm preg_match để kiểm tra
    if (preg_match($pattern, $email)) {
        return true; // Email hợp lệ
    } else {
        return false; // Email không hợp lệ
    }
}
function isValidFullName($fullName)
{
    // Biểu thức chính qui kiểm tra tên đầy đủ chỉ chứa chữ cái và khoảng trắng
    $pattern = '/^[a-zA-Z ]+$/';

    // Sử dụng hàm preg_match để kiểm tra
    if (preg_match($pattern, $fullName)) {
        return true; // Tên đầy đủ hợp lệ
    } else {
        return false; // Tên đầy đủ không hợp lệ
    }
}
function validateUser($username, $password, $fullname, $email, $birthday, $sex)
{
    global $url_back;
    $patternUsername = '/^[a-zA-Z0-9_]{4,16}$/';
    if (empty($username) || empty($password) || empty($email) || empty($fullname) || empty($birthday) || empty($sex)) {
        echo "Vui lòng nhập đầy đủ thông tin." . $url_back;
        die();
    }
    if (!preg_match($patternUsername, $username)) {
        echo "Username phải gồm chữ hoa, chữ thường, dấu gạch chân và có độ dài từ 4 đến 20 kí tự" . $url_back;
        die();
    }
    if (!isValidPassword($password)) {
        echo "Mật phải có ít nhất 1 chữ hoa, số, kí tự đặc biệt dấu gạch chân và có độ dài từ 8 đến 30 kí tự" . $url_back;
        die();
    }
    if (!isValidDate($birthday)) {
        echo "Ngày sinh không hợp lệ" . $url_back;
        die();
    }
    if (!isValidEmail($email)) {
        echo "Email không hợp lệ" . $url_back;
        die();
    }
    if (!isValidFullName($fullname)) {
        echo "Full name không hợp lệ" . $url_back;
        die();
    }
}
function paging($mysqli, $limit, $current_page, $tb_name)
{
    // Tính vị trí bắt đầu của dữ liệu trong câu truy vấn
    $start = ($current_page - 1) * $limit;
    // Truy vấn dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT * FROM $tb_name LIMIT $start, $limit";
    $result = mysqli_query($mysqli, $sql);
    return $result;
}
function pagingWhere($mysqli, $limit, $current_page, $tb_name, $whereClause)
{
    // Tính vị trí bắt đầu của dữ liệu trong câu truy vấn
    $start = ($current_page - 1) * $limit;
    // Truy vấn dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT * FROM $tb_name  $whereClause LIMIT $start, $limit";
    $result = mysqli_query($mysqli, $sql);
    return $result;
}

function toalPagesPaging($mysqli, $limit, $tb_name)
{
    $total_rows = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM $tb_name"));
    // Tính tổng số trang
    return ceil($total_rows / $limit);
}
function pagingSearch($mysqli, $limit, $current_page, $tb_name, $cl_name, $keyword)
{
    // Tính vị trí bắt đầu của dữ liệu trong câu truy vấn
    $start = ($current_page - 1) * $limit;
    // Truy vấn dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT * FROM $tb_name WHERE $cl_name LIKE '%$keyword%' LIMIT $start, $limit";
    $result = mysqli_query($mysqli, $sql);
    return $result;
}
function toalPagesPagingSearch($mysqli, $limit, $tb_name, $cl_name, $keyword)
{
    $total_results = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM $tb_name WHERE $cl_name LIKE '%$keyword%'"));
    // Tính tổng số trang
    return ceil($total_results / $limit);
}
