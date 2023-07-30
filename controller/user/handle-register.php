<?php
// Nếu không phải là sự kiện đăng ký thì không xử lý
if (!isset($_POST['txtUsername'])) {
    die('');
}
// Nhúng file kết nối với database
include('../database/connect.php');
include('../database/function.php');
// Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

// Lấy dữ liệu từ file dangky.php
$username = $_POST['txtUsername'];
$password = $_POST['txtPassword'];
$email = $_POST['txtEmail'];
$fullname = $_POST['txtFullname'];
$birthday = $_POST['txtBirthday'];
$sex = $_POST['txtSex'];
// Kiểm tra tên đăng nhập này đã có người dùng chưa
$result = getRecord1Where($mysqli, 'users', 'username', $username);
if (!empty($result)) {
    echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}


validateUser($username, $password, $fullname, $email, $birthday, $sex);
$password = md5($password);
// Kiểm tra email đã có người dùng chưa
$stmt = $mysqli->prepare("SELECT email FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}
$stmt->close();

// Sử dụng prepared statements để thêm thông tin thành viên vào bảng
$stmt = $mysqli->prepare("INSERT INTO users (username, password, email, fullname, birthday, sex) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $username, $password, $email, $fullname, $birthday, $sex);
if ($stmt->execute()) {
    echo "Quá trình đăng ký thành công. <a href='../index.php'>Về trang chủ</a>";
} else {
    echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='../login.php'>Thử lại</a>";
}
$stmt->close();
$mysqli->close();
