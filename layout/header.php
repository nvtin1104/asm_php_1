<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="./public/css/header.css">
    <link rel="stylesheet" href="./public/css/reponsive.css">
    <link rel="stylesheet" href="./libs/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <main class="main-header">
        <header class="container-fluid d-flex">
            <div class="logo">
                <a href="./pages/index.php">
                    <img src="./public/img/logo/logo.png.webp" alt="Logo">
                </a>
            </div>
            <nav class="menu-mb">
                <ul class="main-nav d-flex align-items-center">
                    <li><a href="./index.php">Home</a></li>
                    <!-- <li><a href="#">Women's</a></li> -->
                    <!-- <li><a href="#">Men's</a></li> -->
                    <li><a href="./index.php?m=pages&a=shop">Shop</a></li>
                    <!-- <li><a href="#">Pages</a></li> -->
                    <!-- <li><a href="#">Blog</a></li> -->
                    <!-- <li><a href="#">Contact</a></li> -->
                </ul>
                <label for="check" class="close-menu"><i class="fa-solid fa-xmark"></i></label>
                <div class="btn-action d-flex">
                    <div class="login-action">
                        <?php
                        session_start();
                        if (isset($_SESSION['isLogined']) && $_SESSION['isLogined'] == true) {
                            $serializedUser = $_SESSION['current_user'];
                            $user = unserialize($serializedUser);
                            echo '<div class="login-control">
                <a href="./pages/user/user-dashboard.php"><i class="fa-solid fa-user-large"></i></a>
                <div class="login-control__content">
                    <a class="text-login" href="./pages/user/user-dashboard.php">' . $user->username . '</a>
                    <form action="./controller/logout.php">
                        <input type="submit" value="Log Out" name="log-out">
                    </form>
                </div>
            </div>';
                        } else {
                            echo '<a  href="./pages/login.php"><span class="text-login">Login </span></a>';
                        }
                        ?>
                    </div>
                    <div class="shop-action d-flex">
                        <div class="shop-action__icon action-search"><i class="fa-solid fa-magnifying-glass"></i> </div>
                        <div class="shop-action__icon"><i class="fa-solid fa-heart"></i></div>
                        <div class="shop-action__icon shopping-cart--icon">
                            <a href="./index.php?m=pages&a=cart"> <i class="fa-solid fa-cart-shopping"></a></i>
                            <div class="shoping-cart__hover d-flex flex-column ">
                                <div class="shopping-cart__title d-flex align-items-center">
                                    <p>Cart</p>
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </div>
                                <?
                                require_once('./inc/shopping-cart.php');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <input type="btn" name="check" id="check" class="d-none">
            <label for="check" class="open-menu"><i class="fa-solid fa-bars"></i></label>
        </header>
        <div class="search-modal-bg">
            <div class="search-modal">
                <form action="index.php?m=pages&a=search" method="post">
                    <input type="text" name="keyword" placeholder="Search">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="search-modal--close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
    </main>

</body>
<script>
    let nav = document.querySelector('nav');
    let check = document.querySelector('#check');
    check.addEventListener('click', function() {
        nav.classList.toggle('open-menu-rule');
    });



    let search = document.querySelector('.action-search');
    let searchModal = document.querySelector('.search-modal-bg');
    let closeModal = document.querySelector('.search-modal--close');

    function toggleModal(event) {
        // Ngăn chặn sự kiện lan ra các phần tử cha
        event.stopPropagation();
        searchModal.classList.toggle('active-modal');
    }

    search.addEventListener('click', toggleModal);
    closeModal.addEventListener('click', toggleModal);

    // Bỏ xử lý sự kiện click trên nền nếu click vào input
    let searchInput = document.querySelector('.search-modal form');
    searchInput.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    // Đóng modal nếu click bất kỳ nơi nào ngoài modal
    searchModal.addEventListener('click', function(event) {
        // Kiểm tra nếu không phải là input thì đóng modal
        if (!event.target.closest('.search-modal')) {
            searchModal.classList.remove('active-modal');
        }
    });
</script>

</html>