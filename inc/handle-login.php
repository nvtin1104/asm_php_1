<?
session_start();
if (isset($_SESSION['isLogined']) && $_SESSION['isLogined']==true) {
    header("Refresh: 2; url =../index.php");
} else {
    if (isset($_POST['login'])) {
        // Kết nối tới database
        // Lấy dữ liệu nhập vào và xử lý chống SQL Injection
        $username = addslashes($_POST['txtUsername']);
        $password = addslashes($_POST['txtPassword']);

        // Kiểm tra đã nhập đủ tên đăng nhập và mật khẩu chưa
        if (!$username || !$password) {
            $mess = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu";
            $showToast = true;
        } else {
            $password = md5($password);
            // Kiểm tra tên đăng nhập có tồn tại không
            $query = mysqli_query($mysqli, "SELECT username, password, user_id, role FROM users WHERE username='$username'");
            if (mysqli_num_rows($query) == 0) {
                $mess = "Tên đăng nhập này không tồn tại.";
                $showToast = true;
            } else {
                $row = mysqli_fetch_array($query);
                // So sánh 2 mật khẩu có trùng khớp hay không
                if ($password == $row['password']) {
                    $user = new User($row['user_id'], $row['username'], $row['role']);
                    $serializedUser = serialize($user);
                    $_SESSION['current_user'] = $serializedUser;
                    $_SESSION['isLogined'] = true;
                    if ($row['role'] == 2) {
                        $mess = "Đăng nhập thành công";
                        $showToast = true;
                        header("Refresh: 2; url =../controller/index.php");
                    } elseif ($row['role'] == 1) {
                        $mess = "Đăng nhập thành công";
                        $showToast = true;
                        header("Refresh: 2; url =../index.php");
                    }
                } else {
                    $mess = "Sai mật khẩu!";
                    $showToast = true;
                }
            }
        }

        // Mã hóa password

    }
};
