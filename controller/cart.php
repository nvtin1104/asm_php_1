<?

if (isset($_POST['add-to-cart'])) {
    session_start();
    include('../inc/connect.php');
    include('../libs/function/user.php');
    $serializedUser = $_SESSION['current_user'];
    $user = unserialize($serializedUser);
    $user_id = $user->user_id;
    $productId = $_POST['product_id'];
    $quantity = $_POST['product-quantity'];
    $check_price = mysqli_query($mysqli, "SELECT price FROM products WHERE product_id='$productId'");
    $rowPrice = mysqli_fetch_array($check_price);
    $productPrice = $rowPrice['price'];

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
    $check_cart = mysqli_query($mysqli, "SELECT * FROM cart_items WHERE product_id='$productId' AND user_id='$user_id'");
    if (mysqli_num_rows($check_cart) == 1) {
        $row = mysqli_fetch_array($check_cart);
        $new_quantity = $row['quantity'] + $quantity;
        $new_total = $new_quantity * $productPrice;

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $update_query = "UPDATE cart_items SET quantity = '$new_quantity', total_price = '$new_total' WHERE product_id = '$productId' AND user_id = '$user_id'";
        if (mysqli_query($mysqli, $update_query)) {
            echo "Success";
        } else {
            echo "Failed to update quantity.";
        }
    } else {
        // Thêm sản phẩm mới vào giỏ hàng
        $totalPrice = $productPrice * $quantity;
        $insert_query = "INSERT INTO cart_items (product_id, user_id, quantity, total_price) VALUES ('$productId', '$user_id', '$quantity', '$totalPrice')";
        if (mysqli_query($mysqli, $insert_query)) {
            echo "Success";
        } else {
            echo "Failed to insert item." . mysqli_error($mysqli);
        }
    }
}
