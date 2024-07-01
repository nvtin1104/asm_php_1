<?php
// Include necessary files and initialize variables (e.g., database connection, helper functions)
// include 'config.php'; // assuming you have a config file for database connection
// include 'functions.php'; // assuming you have a file for helper functions

// If it's not a registration event, do not process
if (isset($_POST['register'])) {
    // Fetch user inputs
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $email = $_POST['txtEmail'];

    // Check if the username already exists
    $result = getRecord1Where($mysqli, 'users', 'username', $username);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Tên đăng nhập này đã tồn tại. Vui lòng chọn tên khác.";
        echo "<script>history.go(-1);</script>";
        exit;
    }

    // Validate user inputs (assuming validateUser is a function that checks the validity of inputs)
    $returnMess =  validateRegister($username, $password, $email);
    if ($returnMess) {
        $_SESSION['error'] = $returnMess;
        echo "<script>history.go(-1);</script>";
        exit;
    }

    // Hash the password
    $hashedPassword = md5($password); // Note: Consider using a stronger hashing algorithm like password_hash()

    // Check if the email already exists
    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Email này đã tồn tại. Vui lòng chọn email khác.";
        echo "<script>history.go(-1);</script>";
        exit;
    }
    $stmt->close();

    // Use prepared statements to add the user information to the database
    $stmt = $mysqli->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $email);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Đăng ký thành công.";
        echo "<script>history.go(-1);</script>";
        exit;
    } else {
        $_SESSION['error'] = "Có lỗi xảy ra.";
        echo "<script>history.go(-1);</script>";
    }
    $stmt->close();
    $mysqli->close();
}

// Function to log errors and redirect back (assuming you have such a function in your helper file)
