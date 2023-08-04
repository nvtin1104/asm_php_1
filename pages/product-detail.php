<?php
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $sql = "SELECT * FROM products WHERE product_id = ?;";

    // Chuẩn bị và thực thi truy vấn
    $stmt = mysqli_prepare($mysqli, $sql);

    // Kiểm tra lỗi khi chuẩn bị truy vấn
    if (!$stmt) {
        die("Lỗi trong việc chuẩn bị truy vấn: " . mysqli_error($mysqli));
    }

    // Gán giá trị cho placeholder bằng hàm bind_param
    if (!mysqli_stmt_bind_param($stmt, "i", $productId)) {
        die("Lỗi trong việc gán giá trị cho placeholder: " . mysqli_stmt_error($stmt));
    }
    // Thực thi truy vấn sau khi đã gán giá trị cho placeholder
    if (!mysqli_stmt_execute($stmt)) {
        die("Lỗi trong việc thực thi truy vấn: " . mysqli_stmt_error($stmt));
    }
    // Lấy kết quả từ truy vấn
    $result = mysqli_stmt_get_result($stmt);
    // Hiển thị sản phẩm
    if (mysqli_num_rows($result) > 0) {
        if ($row = mysqli_fetch_assoc($result)) {
            $productId = $row['product_id'];
            $productName = $row['product_name'];
            $productPrice = $row['price'];
            $productImage = $row['image'];
            $productBrand = $row['brand'];
            $productShortDescription = $row['short_description'];
            $productDescripton = $row['description'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASM PHP</title>
    <link rel="stylesheet" href="./public/css/reponsive.css">
    <link rel="stylesheet" href="./public/css/toast.css">
    <link rel="stylesheet" href="./public/css/product_detail.css">
    <link rel="stylesheet" href="./libs/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <div id="toast">
            <div id="img">Icon</div>
            <div id="desc"><? global $mess;
                            echo $mess; ?></div>
        </div>
        <div class="breadcrumb-option">
            <div class="container m-auto">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__link">
                            <a href="index.php">
                                <i class="fa-solid fa-house"></i><span>Home</span>
                            </a>
                            <span>/</span>
                            <a href="#">Products</a>
                            <span>/</span>
                            <a href="#"><? echo $productName; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="product-detal">
            <div class="container m-auto">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="product-detail__img">
                            <div class="product-detail__img--main h-100">
                                <img class="w-100 h-100" src="<? echo $productImage; ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="product-detail__content">
                            <form id="cartForm" action="" method="post">
                                <h3 class="product-name">
                                    <? echo $productName; ?>
                                </h3>
                                <p class="product-band">
                                    Brand: <span><? echo $productBrand; ?></span>
                                </p>
                                <div class="product-detail--rating">
                                    <span class="star-rating">
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </span>
                                    <span class="count-rating">(150 reviews)</span>
                                </div>
                                <div class="product-detail__price">
                                    <span class="new-price">$ <? echo $productPrice; ?></span> <span class="old-price">$65</span>
                                </div>
                                <p class="short-escription"><? echo $productShortDescription; ?>
                                </p>
                                <div class="product-detail__control">
                                    <div class="control-quantity">
                                        <span class="quantity-text">Quantity:</span>
                                        <div class="count-quantity"><span class="count-quantity-minus"><i class="fa-solid fa-minus"></i></span>
                                            <input type="number" name="product-quantity" id="ip-count-quantity" min="1" max="100" value="1">
                                            <span class="count-quantity-plus"><i class="fa-solid fa-plus"></i></span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_id" value="<? echo $productId ?>">
                                    <input class="add-to-cart" name="add-to-cart" type="submit" value="Add to Cart">
                                    <div class="favourite-product">
                                        <i class="fa-regular fa-heart"></i>
                                    </div>
                                    <div class="share-product">
                                        <i class="fa-solid fa-share"></i>
                                    </div>
                                </div>
                                <div class="product__details__widget">
                                    <div class="color-checkbox">
                                        <span class="widget--title">Available color:</span>
                                        <select name="color-product" id="color-product">
                                            <option value="red">red</option>
                                            <option value="blue">blue</option>
                                            <option value="black">black</option>
                                        </select>
                                    </div>
                                    <div class="size-checkbox">
                                        <span class="widget--title">Available size:</span>
                                        <select name="color-product" id="color-product">
                                            <option value="xl">xl</option>
                                            <option value="l">l</option>
                                            <option value="m">m</option>
                                        </select>
                                    </div>
                                    <div class="promotions">
                                        <span class="widget--title">Promotions:</span><span class="widget--text">Free
                                            shiping</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-description">
                            <h3 class="product-description__title">Description</h3>
                            <h4 class="product-description__name"><? echo $productName; ?></h4>
                            <p class="product-description__content">
                                <?
                                echo $productDescripton;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="./libs/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    function launch_toast(icon, message, status) {
        var x = document.getElementById("toast")
        x.className = "show";
        const imgDiv = document.getElementById("img");
        imgDiv.innerHTML = icon; // Thay đổi thành nội dung mới
        // Để thay đổi nội dung của div có id="desc"
        const descDiv = document.getElementById("desc");
        descDiv.innerText = message;
        setTimeout(function() {
            x.className = x.className.replace("show", "");
            if (status == "success") {
                window.location.reload();
            } else if (status == "error") {
                window.location.href = "./pages/login.php";
            }
        }, 2000);

    }

    function submitForm() {
        var form = document.getElementById("cartForm");
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./controller/cart/cart.php", true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        let status = response.status;
                        let icon = response.icon;
                        let message = response.message;
                        launch_toast(icon, message, status);
                        // Perform any additional actions if the deletion was successful
                        // For example, you may want to reload the cart or update the UI.
                    } else if (response.status === 'error') {
                        let status = response.status;
                        let icon = response.icon;
                        let message = response.message;
                        launch_toast(icon, message, status);
                        // Handle the error appropriately, if needed
                    }
                } else {
                    // Handle error response (if needed)
                    console.error("Error:", xhr.status);
                }
            }
        };

        xhr.send(formData);
    }

    // Add event listener to the form submission
    document.getElementById("cartForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission
        submitForm(); // Call the function to handle form submission via Ajax
    });
    // control conut quantity
    let minus = document.querySelector('.count-quantity-minus');
    let plus = document.querySelector('.count-quantity-plus');
    let ipCount = document.querySelector('#ip-count-quantity');

    minus.addEventListener('click', function() {
        ipCount.value--;
        console.log(ipCount.value);
        if (ipCount.value < 1) {
            ipCount.value = 1;
        }
    });

    plus.addEventListener('click', function() {
        ipCount.value++;
        console.log(ipCount.value);
        if (ipCount.value > 100) {
            ipCount.value = 100;
        }
    });
</script>

</html>