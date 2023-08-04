<?
include('./controller/database/function.php');
$limit = 12;
$current_page = 1;
$result = paging($mysqli, $limit, $current_page, 'products');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASM PHP</title>
    <link rel="stylesheet" href="./public/css/styles.css">
    <link rel="stylesheet" href="./public/css/reponsive.css">
    <link rel="stylesheet" href="./public/css/toast.css">
    <link rel="stylesheet" href="./libs/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <div id="toast">
            <div id="img"></div>
            <div id="desc"></div>
        </div>
        <section class="banner-grid px-0 row container-fluid">
            <div class="grid-left col-lg-6 col-md-12 pad-12">
                <div class="grid-left-bg d-flex align-items-center">
                    <div class="big-banner__content">
                        <h1 class="title">Women’s fashion</h1>
                        <p class="text">Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore
                            edolore magna aliquapendisse ultrices gravida.</p>
                        <a href="#" class="btn-banner">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="gird-right col-lg-6 col-md-12">
                <div class="grid-row--top row w-100">
                    <div class="pad-12 w-banner">
                        <div class="grid-row--top__1 h-100 d-flex align-items-center">
                            <div class="sm-banner__content">
                                <h1 class="title">Men’s fashion</h1>
                                <p class="text">375 items</p>
                                <a href="#" class="btn-banner">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="pad-12 w-banner">
                        <div class="grid-row--top__2 h-100 d-flex align-items-center">
                            <div class="sm-banner__content">
                                <h1 class="title">Kid’s fashion</h1>
                                <p class="text">375 items</p>
                                <a href="#" class="btn-banner">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid-row--bot row w-100">
                    <div class="pad-12 w-banner">
                        <div class="grid-row--bot__1 h-100 d-flex align-items-center">
                            <div class="sm-banner__content">
                                <h1 class="title">Cosmetics</h1>
                                <p class="text">375 items</p>
                                <a href="#" class="btn-banner">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="pad-12 w-banner">
                        <div class="grid-row--bot__2 h-100 d-flex align-items-center">
                            <div class="sm-banner__content">
                                <h1 class="title">Accessories</h1>
                                <p class="text">375 items</p>
                                <a href="#" class="btn-banner">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section class="new-product">
            <div class="row row--title">
                <div class="col-md-4 col-lg-4">
                    <div class="section-title">
                        <h4>new product</h4>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8">
                    <ul class="fiter-product">
                        <li>All</li>
                        <li> Women’s</li>
                        <li>Men’s</li>
                        <li>Kid’s</li>
                        <li>Accessories</li>
                        <li> Cosmetics</li>
                    </ul>
                </div>
            </div>
            <div class="row new-product--library">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    // Hiển thị thông tin của từng dòng dữ liệu
                    echo '<div class="col-lg-3 col-md-4 col-sm-6 mgb">
                    <div class="new-product--item">
                        <div class="new-product--item__img set-bg">
                        <a href=./index.php?m=pages&a=product-detail&id=' . $row["product_id"] . '" ><img src="' . $row['image'] . '"></img></a>
                            <div class="hover-content">
                                <a href="#"><i class="fa-solid fa-info"></i></a>
                                <a href="#"><i class="fa-regular fa-heart"></i></a>
                                 <form id="cartForm"  class="cartForm" action=""  method="post" >
                                 <input type="hidden" name="product_id" value="' . $row["product_id"] . '">
                                <button type="submit" ><i class="fa-solid fa-cart-plus"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="new-product--item__text">
                            <a name="product" href=./index.php?m=pages&a=product-detail&id=' . $row["product_id"] . '" class="name">' . $row["product_name"] . '</a>
                            <div class="rating">
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <div class="price">
                                $' . $row["price"] . '
                            </div>
                        </div>
                    </div>
                </div>';
                }

                ?>

            </div>
        </section>
    </main>
</body>
<script src="./libs/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    function launch_toast(icon, message) {
        var x = document.getElementById("toast")
        x.className = "show";
        const imgDiv = document.getElementById("img");
        imgDiv.innerHTML = icon; // Thay đổi thành nội dung mới
        // Để thay đổi nội dung của div có id="desc"
        const descDiv = document.getElementById("desc");
        descDiv.innerText = message;
        setTimeout(function() {
            x.className = x.className.replace("show", "");
            window.location.reload();
        }, 2000);

    }



    // Add event listener to the form submission
    function submitForm(formData) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./controller/cart/cart.php", true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        let icon = response.icon;
                        let message = response.message;
                        launch_toast(icon, message);
                        // Perform any additional actions if the addition was successful
                        // For example, you may want to reload the cart or update the UI.
                    } else if (response.status === 'error') {
                        let icon = response.icon;
                        let message = response.message;
                        launch_toast(icon, message);
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

    // Function to handle the form submission event
    function handleFormSubmit(event) {
        event.preventDefault(); // Prevent default form submission
        var form = event.target; // Get the form that triggered the event
        var formData = new FormData(form);
        submitForm(formData); // Call the function to handle form submission via Ajax
    }

    // Add event listener to the form submission
    var forms = document.querySelectorAll('.cartForm');
    forms.forEach(form => {
        form.addEventListener("submit", handleFormSubmit);
    });
</script>

</html>