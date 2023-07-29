<?
function delete1Where($mysqli,$tb_name, $where, $where_id)
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
            header('Refresh: 2; url=./index.php?m=category&a=cat');
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
function validateCategory($mysqli,$catname){
    $url_back =" <a href='../controller/index.php?m=category&a=cat'>Trở lại</a>";
    if(empty($catname)){
        echo "Vui lòng nhập đầy đủ thông tin.". $url_back;
        die();
    }
    $row_check = getRecord1Where($mysqli,'cat_product', 'cat_name', $catname);
    if(!empty($row_check)){
        echo "Tên cat bị trùng.". $url_back;
        die();
    }
    else {
        return true;
    }
}