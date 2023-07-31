<?php
// Nếu không phải là sự kiện đăng ký thì không xử lý
if (!isset($_POST['txtUsername'])) {
    die('');
}
// Nhúng file kết nối với database
include('./database/connect.php');
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
$row = mysqli_num_rows($result);
if ($row > 0) {
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
    <form action="" method="post" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="txtUsername">User name</label>
            <input type="text" class="form-control" name="txtUsername" id="txtUsername" required>
            <div class="invalid-feedback">
                Please provide a valid username.
            </div>
        </div>
        <div class="form-group">
            <label for="txtPassword">Password</label>
            <input type="password" class="form-control" name="txtPassword" id="txtPassword" required>
            <div class="invalid-feedback">
                Please provide a valid password.
            </div>
        </div>
        <div class="form-group">
            <label for="txtEmail">Email</label>
            <input type="email" class="form-control" name="txtEmail" id="txtEmail" required>
            <div class="invalid-feedback">
                Please provide a valid email.
            </div>
        </div>
        <div class="form-group">
            <label for="txtFullname">Full name</label>
            <input type="text" class="form-control" name="txtFullname" id="txtFullname" required>
            <div class="invalid-feedback">
                Please provide your full name.
            </div>
        </div>
        <div class="form-group">
            <label for="txtBirthday">Birthday</label>
            <input type="date" class="form-control" name="txtBirthday" id="txtBirthday" required>
            <div class="invalid-feedback">
                Please provide your birthday.
            </div>
        </div>
        <div class="form-group">
            <label for="txtSex">Sex</label>
            <select class="form-control" name="txtSex" id="txtSex" required>
                <option value="">Choose...</option>
                <option value="Men">Men</option>
                <option value="Women">Women</option>
                <option value="Other">Other</option>
            </select>
            <div class="invalid-feedback">
                Please select your sex.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>

</body>

</html>