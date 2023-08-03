<?
require('../database/connect.php');
// update_cart.php (file xử lý AJAX)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem dữ liệu đã được gửi lên hay chưa
    if (isset($_POST['cart_id']) && isset($_POST['quantity'])) {
        // Lấy dữ liệu từ yêu cầu AJAX
        $cart_id = $_POST['cart_id'];
        $quantity = $_POST['quantity'];
        $productId = $_POST['product_id'];
        $check_price = mysqli_query($mysqli, "SELECT price FROM products WHERE product_id='$productId'");
        $rowPrice = mysqli_fetch_array($check_price);
        $productPrice = $rowPrice['price'];
        $newTotalPrice = $productPrice * $quantity;
        
        $sql_update = "UPDATE cart_items SET quantity = $quantity , total_price = $newTotalPrice WHERE cart_id = $cart_id";
        $result_update = mysqli_query($mysqli, $sql_update);
        if ($result_update) {
            // Nếu cập nhật số lượng thành công, gửi phản hồi về cho JavaScript
            echo json_encode(array('status' => 'success', 'message' => 'Cập nhật thành công', 'icon' => '<i class="fa-solid success-color fa-check"></i>'));
        } else {
            // Nếu có lỗi trong quá trình cập nhật
            echo json_encode(array('status' => 'error', 'message' => 'Cập nhật thất bại','icon' => '<i class="fa-solid error-color fa-exclamation"></i>'));
        }
    } else {
        // Không có dữ liệu hoặc dữ liệu không hợp lệ
        echo "Error"; // Ví dụ: gửi chuỗi "Error" để cho JavaScript biết rằng có lỗi xảy ra
    }
}
