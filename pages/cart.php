<?php

require('../inc/connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../public/css/cart.css">
    <link rel="stylesheet" href="../public/css/reponsive.css">
    <link rel="stylesheet" href="../libs/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <header><? include('../inc/header.php') ?></header>
    <main>
        <?
        if (isset($_SESSION['isLogined']) && $_SESSION['isLogined'] == true) {

            $serializedUser = $_SESSION['current_user'];
            $user = unserialize($serializedUser);
            $user_id = $user->user_id;
            // $sql = "SELECT * FROM cart_items WHERE user_id ='$user_id'";
            $sql = "SELECT cart_items.product_id, cart_items.quantity, cart_items.total_price, products.product_name,products.image
                    FROM cart_items
                    INNER JOIN products ON cart_items.product_id = products.product_id;
                    ";
            $result = mysqli_query($mysqli, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<div class=cart__content">
                <table class=cart--table">
                    <tr>
                        <th class="stt">STT</th>
                        <th class="name">Name</th>
                        <th class="img">Image</th>
                        <th class="quantity">Quantity</th>
                        <th class="action">Action</th>
                    </tr>
                    <tr class="tb-row">                                     
                        <td class="stt">1</td>
                        <td class="name ">
                            <p>' . $row['product_name'] . '</p>
                        </td>
                        <td class="img"><img src=' . $row['image'] . ' alt="Product A"></td>
                        <td class="quantity">' . $row['quantity'] . '</td>
                        <td class="action">
                            <a href="#"><i class="fa-solid fa-xmark"></i></a>
                        </td>
                    </tr>
                </table>
                <div class=cart__bottom  d-flex justify-content-between">
                    <div class=cart--total"><span class="total-title">Total price:</span>10000</div>
                    <div class=cart--acction">
                        <a class="go-to-cart" href="#">Go to Cart</a>
                        <a class="go-to-payment" href="#">Go to Payment</a>
                    </div>
                </div>
            </div>';
            } else
                echo ' <div class=cart__nocontent d-flex justify-content-center">
            <p class="no-content">No Product</p><span><a class="go-to-shop" href="#">Go to shop</a></span>
        </div>';
        }
        ?>
    </main>
    <footer><? include('../inc/footer.php') ?></footer>

</body>

</html>