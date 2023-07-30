<?php
session_start();
include('../database/connect.php');
include('../database/user.php');
// Xử lý đăng nhập
if (isset($_POST['login'])) {
    // Kết nối tới database
    // Lấy dữ liệu nhập vào và xử lý chống SQL Injection
    $username = addslashes($_POST['txtUsername']);
    $password = addslashes($_POST['txtPassword']);

    // Kiểm tra đã nhập đủ tên đăng nhập và mật khẩu chưa
    if (!$username || !$password) {
        echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    // Mã hóa password
    $password = md5($password);
    // Kiểm tra tên đăng nhập có tồn tại không
    $query = mysqli_query($mysqli, "SELECT username, password, user_id, role FROM users WHERE username='$username'");
    if (mysqli_num_rows($query) == 0) {
        echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    // Lấy mật khẩu trong database ra
    $row = mysqli_fetch_array($query);
    // So sánh 2 mật khẩu có trùng khớp hay không
    if ($password == $row['password']) {
        $user = new User($row['user_id'], $row['username'], $row['role']);
        $serializedUser = serialize($user);
        $_SESSION['current_user'] = $serializedUser;
        $_SESSION['isLogined'] = true;
        if ($row['role'] == 2) {
            header("Refresh: 2; url =../index.php");
        } elseif ($row['role'] == 1) {
            header("Refresh: 2; url=../../index.php");
        } else {
            echo "Error";
        }
    } else {
        echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>

</body>

</html>