<?
// update_cart.php (file xử lý AJAX)
include_once('../database/connect.php');
include_once('../database/function.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem dữ liệu đã được gửi lên hay chưa
    if (isset($_POST['cart_id'])) {
        // Lấy dữ liệu từ yêu cầu AJAX
        $cart_id = $_POST['cart_id'];
        $sql = "DELETE FROM cart_items WHERE cart_id = ?";
        $stmt = $mysqli->prepare($sql);

        // Kiểm tra và thực thi truy vấn DELETE
        if ($stmt) {
            // Sử dụng bind_param để gắn giá trị vào truy vấn (bind parameters)
            $stmt->bind_param("i", $cart_id);

            // Thực thi truy vấn
            if ($stmt->execute()) {
                // Truy vấn DELETE đã được thực hiện thành công
                echo json_encode(array('status' => 'success', 'message' => 'Xóa sản phẩm thành công', 'icon' => '<i class="fa-solid success-color fa-check"></i>'));
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
    } else {
        // Không có dữ liệu hoặc dữ liệu không hợp lệ
        echo json_encode(array('status' => 'success', 'message' => 'Xóa sản phẩm thất bại', 'icon' => '<i class="fa-solid success-color fa-check"></i>'));
    }
}
