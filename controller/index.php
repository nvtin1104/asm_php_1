<!doctype html>
<html lang="en">
<?php
// Định nghĩa một hằng số bảo vệ project
define("IN_SITE", true);
session_start();
include_once('./database/connect.php');

// Lấy module và action trên URL
$action = isset($_GET['a']) ? $_GET['a'] : '';
$module = isset($_GET['m']) ? $_GET['m'] : '';
if (empty($module) || empty($action)) {
    $module = 'user';
    $action = 'users';
}
if ($action == 'edit') {
    $edit_id = isset($_GET['id']) ? $_GET['id'] : '';
    $_SESSION['edit_id'] = $edit_id;
}
// Tạo đường dẫn và lưu vào biến $path
$path =  './' . $module . '/' . $action . '.php';
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
</head>

<body>
    <div class="container">
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
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Logout</a>
                                </li>
                            </div>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="col col-lg-2">
                <ul class="list-group">
                    <li class="list-group-item"><a href="../controller/index.php?m=user&a=users">User</a></li>
                    <li class="list-group-item"><a href="../controller/index.php?m=category&a=cat">Category</a></li>
                    <li class="list-group-item"><a href="../controller/index.php?m=products&a=products">Products</a></li>
                    <li class="list-group-item">Order</li>
                    <li class="list-group-item">Report</li>
                </ul>
            </div>
            <div class="col col-lg-10">
                <?
                if (file_exists($path)) {
                    include_once($path);
                    include('./database/user.php');
                }
                ?>
            </div>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script> -->
</body>

</html>