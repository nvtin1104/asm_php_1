<?php
require('./controller/database/function.php');
$serializedUser = $_SESSION['current_user'];
$user = unserialize($serializedUser);
$user_id = $user->user_id;
$result = getRecord1Where($mysqli, 'users', 'user_id', $user_id);
$inforUser = mysqli_fetch_array($result);
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ids"])) {
    $selectedIds = $_POST["ids"];
    $_SESSION["ids"] = $selectedIds;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payment'])) {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
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
        $stmt->execute();
    }
    // Tiếp tục xử lý dữ liệu tại đây...
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<style>
    .payment-main {
        margin: auto !important;
        padding: 64px 0;
    }
</style>

<body>
    <div class="container payment-main">
        <div class="row">
            <div class="col-lg-6">
                <h1>Thông tin người dùng</h1>
                <form id="userForm" action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<? echo $user->username ?>" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<? echo $inforUser['fullname'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Ghi chú:</label>
                        <textarea class="form-control" id="note" name="note"></textarea>
                    </div>
                    <input type="submit" name="payment" class="btn btn-primary" value="Pay">
                </form>

            </div>
            <div class="col-lg-6">
                <h1>Thông tin giỏ hàng</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá tiền</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng giá tiền</th>
                        </tr>
                    </thead>
                    <tbody id="cartBody">
                        <?
                        $total_pay = 0;
                        foreach ($selectedIds as $cart_id) {
                            $sql = "SELECT cart_items.cart_id, cart_items.product_id, cart_items.quantity, cart_items.total_price, products.price, products.product_name, products.image
                            FROM cart_items
                            INNER JOIN products ON cart_items.product_id = products.product_id
                            WHERE cart_items.cart_id = $cart_id";
                            $result = mysqli_query($mysqli, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $total_pay += $row['total_price'];
                            echo '<tr>
                            <td><img src="' . $row['image'] . '" alt="Product Image" width="60" height="60"></td>
                            <td>' . $row['product_name'] . '</td>
                            <td>' . number_format($row['price'], 0, '.', ',') . '<span class="ml-2">VND</span></td>
                            <td>
                                <input type="number" name="quantity" value="' . $row['quantity'] . '" min="1" max="100">
                            </td>
                            <td>' .  number_format($row['total_price'], 0, '.', ',') . '<span class="ml-2">VND</span></td>
                            </tr>';
                        }
                        echo ' <tfoot>
                        <tr>
                            <td colspan="3">
                            </td>
                            <td><strong>Total:</strong></td>
                            <td>' .  number_format($total_pay, 0, '.', ',') . '<span class="ml-2">VND</span></td> 
                        </tr>
                    </tfoot>';

                        ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</body>

</html>