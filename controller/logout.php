<?php
session_start();

if (isset($_GET['log-out'])) {
    unset($_SESSION['username']); 
    unset($_SESSION['user_id']); // Xóa session đăng nhập   
    // Xóa session đăng nhập   
    $_SESSION['isLogined'] = false;
    echo "SUccesfully logout  ";    
    header("Refresh: 2; url=../index.php");
    exit;
}
else echo 'Error';
