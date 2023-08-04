<!doctype html>
<html lang="en">
<?php
// Định nghĩa một hằng số bảo vệ project
session_start();

// Lấy module và action trên URL
$pages = isset($_GET['p']) ? $_GET['p'] : '';
if (empty($pages)) {
    $pages = 'user-infor';
}
// Tạo đường dẫn và lưu vào biến $path
$path =  './' . $pages . '.php';
// session_start();
// if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser']->role !== '1') {
//     header('Location: login.php');
// }
// var_dump($_SESSION['currentUser']->username)
// 
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/admin.css">
    <style>
        .navbar {
            margin-bottom: 50px;

        }

        .navbar-nav {
            width: 100%;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .category {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .category button {
            margin-left: 30px;
        }

        .user__dashboard {
            padding: 64px 0;
        }
    </style>
</head>

<body>
    <div class="container user__dashboard m-auto">

        <div class="row">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <div class="flex">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="../../index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <form action="../../controller/logout.php">
                                        <input type="submit" value="Log Out" name="log-out">
                                    </form>

                                </li>
                            </div>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="col col-lg-2">
                <ul class="list-group">
                    <li class="list-group-item"><a href="./user-dashboard.php?p=user-infor">Account Information</a></li>
                    <li class="list-group-item"><a href="../controller/index.php?m=category&a=cat">Cart</a></li>
                    <li class="list-group-item"><a href="./user-dashboard.php?p=orders">Order</a></li>
                    <li class="list-group-item">Setting</li>
                    <li class="list-group-item">Logout</li>
                </ul>
            </div>
            <div class="col col-lg-10">
                <?
                if (file_exists($path)) {
                    include('../../controller/database/user.php');
                    include('../../controller/database/connect.php');
                    include('../../controller/database/function.php');
                    include_once($path);
                }
                ?>
            </div>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script> -->
</body>

</html>