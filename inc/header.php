<?php



?>

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
                    include('../libs/function/user.php');
                   
                    if (isset($_SESSION['isLogined']) && $_SESSION['isLogined'] == true) {
                        session_start();
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
                    <div class="shop-action__icon">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>

                    </div>
                </div>
            </div>
        </nav>
        <input type="btn" name="check" id="check" class="d-none">
        <label for="check" class="open-menu"><i class="fa-solid fa-bars"></i></label>
    </header>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div id="custom-modal" class="d-flex justify-content-center align-items-center h-100">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    let nav = document.querySelector('nav');
    let check = document.querySelector('#check');
    check.addEventListener('click', function() {
        nav.classList.toggle('open-menu-rule');
    });
    let close = document.querySelector('#custom-modal');
    close.addEventListener('click', function() {
        console.log('close');
    });
</script>

</html>