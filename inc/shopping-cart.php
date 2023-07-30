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