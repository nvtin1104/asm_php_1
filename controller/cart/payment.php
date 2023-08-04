<?
session_start();
require('../database/connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $user_id = $_POST['user_id'];
    if (isset($_POST['note'])) {
        $note = $_POST['note'];
    } else {
        $note = "";
    }
    $selectedIds =  $_SESSION["ids"];
    foreach ($selectedIds as $cart_id) {
        $stmt = $mysqli->prepare("SELECT cart_items.product_id, cart_items.quantity, cart_items.total_price
        FROM cart_items
        INNER JOIN products ON cart_items.product_id = products.product_id
        WHERE cart_items.cart_id = ?");
        $stmt->bind_param("i", $cart_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $total_price = $row['total_price'];

        $stmt = $mysqli->prepare("INSERT INTO orders (name, address, phone, note, user_id, product_id, quantity, total_price)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiiid", $name, $address, $phone, $note, $user_id, $product_id, $quantity, $total_price);
        if ($stmt->execute()) {
            $stmt_delete = $mysqli->prepare("DELETE FROM cart_items WHERE cart_id =?");
            $stmt_delete->bind_param("i", $cart_id);
            $stmt_delete->execute();
            unset($_SESSION['ids']);
            unset($selectedIds);
            echo json_encode(array('status' => 'success', 'message' => 'Đặt hàng thành công!', 'icon' => '<i class="fa-solid success-color fa-check"></i>'));
        }
    }

    // Tiếp tục xử lý dữ liệu tại đây...
}
