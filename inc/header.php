<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/reponsive.css">
    <link rel="stylesheet" href="../libs/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <header class="container-fluid d-flex">
        <div class="logo">
            <a href="../pages/index.php">
                <img src="../public/img/logo/logo.png.webp" alt="Logo">
            </a>
        </div>
        <nav class="menu-mb">
            <ul class="main-nav d-flex align-items-center">
                <li><a href="../pages/index.php">Home</a></li>
                <li><a href="#">Women's</a></li>
                <li><a href="#">Men's</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">Pages</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <label for="check" class="close-menu"><i class="fa-solid fa-xmark"></i></label>
            <div class="btn-action d-flex">
                <div class="login-action">
                    <?
                    session_start();
                    include('../libs/function/user.php');
                    if (isset($_SESSION['isLogined']) && $_SESSION['isLogined'] == true) {
                        $serializedUser = $_SESSION['current_user'];
                        $user = unserialize($serializedUser);
                        echo '<div class="login-control">
                        <a href="../frontend/accountManagement.php"><i class="fa-solid fa-user-large"></i></a>
                        <div class="login-control__content">
                            <a class="text-login" href="../pages/accountManagement.php">' . $user->username . '</a>
                            <form action="../controller/logout.php">
                                <input type="submit" value="Log Out" name="log-out">
                            </form>
                        </div>
                    </div>';
                    } else echo '<a  href="../pages/login.php"><span class="text-login">Login </span></a>';
                    ?>

                </div>
                <div class="shop-action d-flex">
                    <div class="shop-action__icon"><i class="fa-solid fa-magnifying-glass"></i> </div>
                    <div class="shop-action__icon"><i class="fa-solid fa-heart"></i></div>
                    <div class="shop-action__icon shopping-cart--icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <div class="shoping-cart__hover d-flex flex-column ">
                            <div class="shopping-cart__title d-flex align-items-center">
                                <p>Cart</p>
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
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
                                    echo '<div class="shopping-cart__content">
                                    <table class="shopping-cart--table">
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
                                    <div class="shopping-cart__bottom  d-flex justify-content-between">
                                        <div class="shopping-cart--total"><span class="total-title">Total price:</span>10000</div>
                                        <div class="shopping-cart--acction">
                                            <a class="go-to-cart" href="#">Go to Cart</a>
                                            <a class="go-to-payment" href="#">Go to Payment</a>
                                        </div>
                                    </div>
                                </div>';
                                } else
                                    echo ' <div class="shopping-cart__nocontent d-flex justify-content-center">
                                <p class="no-content">No Product</p><span><a class="go-to-shop" href="#">Go to shop</a></span>
                            </div>';
                            } else
                                echo ' <div class="shopping-cart__nocontent d-flex justify-content-center">
                            <p class="no-content">No Product</p><span><a class="go-to-shop" href="#">Go to shop</a></span>
                        </div>';
                            ?>


                        </div>
                    </div>

                </div>
            </div>
        </nav>
        <input type="btn" name="check" id="check" class="d-none">
        <label for="check" class="open-menu"><i class="fa-solid fa-bars"></i></label>
    </header>
    <!-- Modal -->
</body>
<script>
    let nav = document.querySelector('nav');
    let check = document.querySelector('#check');
    check.addEventListener('click', function() {
        nav.classList.toggle('open-menu-rule');
    });
</script>

</html>