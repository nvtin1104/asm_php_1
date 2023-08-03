<?
include('./controller/database/function.php');
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="./public/css/cart.css">
    <link rel="stylesheet" href="./public/css/toast.css">
    <link rel="stylesheet" href="./public/css/reponsive.css">
    <link rel="stylesheet" href="./public/css/paging.css">
    <link rel="stylesheet" href="./libs/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?
    if (isset($_SESSION['isLogined']) && $_SESSION['isLogined'] == true) {
        $serializedUser = $_SESSION['current_user'];
        $user = unserialize($serializedUser);
        $user_id = $user->user_id;
        // $sql = "SELECT * FROM cart_items WHERE user_id ='$user_id'";
        $sql = "SELECT cart_items.cart_id, cart_items.product_id, cart_items.quantity, cart_items.total_price,products.price, products.product_name,products.image
                                FROM cart_items
                                INNER JOIN products ON cart_items.product_id = products.product_id;
                                ";
        $result = mysqli_query($mysqli, $sql);
        $sql_total = "SELECT SUM(total_price) AS total_price FROM cart_items";
        $result_total = $mysqli->query($sql_total);

        // Kiểm tra và lấy giá trị tổng giá tiền
        if ($result_total) {
            $row = $result_total->fetch_assoc();
            $total_price = $row['total_price'];
        } else {
            $total_price = 0; // Nếu không có dữ liệu hoặc có lỗi trong truy vấn
        }
        if (mysqli_num_rows($result) > 0) {
            echo ' <div class="container cart-main">
            <h1>Cart</h1>
            <form  action="index.php?m=pages&a=payment" method="POST">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá tiền</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng giá tiền</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                <td><img src="' . $row['image'] . '" alt="Product Image" width="60" height="60"></td>
                <td>' . $row['product_name'] . '</td>
                <td>' . $row['price'] . '<span class="ml-2">VND</span></td>
                <td>
                    <input type="number" name="quantity" value="' . $row['quantity'] . '" min="1" max="100">
                </td>
                <td>' . $row['total_price'] . '<span class="ml-2">VND</span></td>
                <td>
                <button type="button" class="btn btn-sm btn-primary btn-update" data-product-id="' . $row['product_id'] . '" data-cart-id="' . $row['cart_id'] . '">Update</button>
                <button type="button" data-cart-id="' . $row['cart_id'] . '" class="btn btn-danger btn-sm btn-delete">Remove</button>
                <input type="checkbox" name="ids[]" value="' . $row['cart_id'] . '"><br>
                </td>
            </tr>';
            }
            echo ' </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <div class="table__footer--action">
                            <a href="#" class="btn btn-primary btn-sm">Home</a>
                            <button class="btn btn-info btn-sm type="submit" id="btn-submit">Payment</button>
                        </div>
                    </td>
                    <td><strong>Total:</strong></td>
                    <td>' . $total_price . '<span class="ml-2">VND</span></td> 
                </tr>
            </tfoot>
            </table>
            </form>';
        } else
            echo ' <div class="shopping-cart__nocontent d-flex justify-content-center">
                        <p class="no-content">No Product</p><span><a class="go-to-shop" href="./index.php?m=pages&a=shop">Go to shop</a></span>
                    </div>';
    }
    ?>
    </div>
    <div id="toast">
        <div id="img"></div>
        <div id="desc"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Xử lý khi nhấp vào nút "Gửi"
            $("#btn-submit").click(function() {
                // Lấy tất cả các cart_id từ các checkbox được chọn
                var cartIds = [];
                $("input[name='ids[]']:checked").each(function() {
                    cartIds.push($(this).val());
                });

                // Gửi cartIds lên máy chủ bằng Ajax
                $.ajax({
                    url: "./pages/payment.php",
                    method: "post",
                    data: {
                        cartIds: cartIds
                    },
                    success: function(response) {
                        // Xử lý phản hồi từ máy chủ (nếu cần)
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi (nếu có)
                        console.error(error);
                    }
                });
            });
        });
    </script>

    <script src="./public/js/cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>