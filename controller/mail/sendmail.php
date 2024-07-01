<?php
require '../libs/PHPMailer-master/src/PHPMailer.php';
require '../libs/PHPMailer-master/src/SMTP.php';
require '../libs/PHPMailer-master/src/Exception.php';
require '../libs/PHPMailer-master/language/phpmailer.lang-vi.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_GET['id']) {
    $user_id = $_GET['id'];
    $order_id = $_GET['orderid'];
    $sql = 'SELECT * FROM users WHERE user_id = ' . $user_id . '';
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $name = $row['fullname'];

    // Tạo đối tượng PHPMailer mới
    $mail = new PHPMailer(true);

    try {
        // Cấu hình thông tin email
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Địa chỉ máy chủ SMTP
        $mail->SMTPAuth   = true;                // Bật xác thực SMTP
        $mail->Username   = 'camtinlqd123@gmail.com';     // Tên đăng nhập SMTP
        $mail->Password   = 's';     // Mật khẩu SMTP
        $mail->SMTPSecure = 'tls';               // Bật mã hóa TLS
        $mail->Port       = 587;                 // Cổng SMTP (TLS)

        // Thông tin người gửi và người nhận
        $mail->setFrom('camtinlqd123@gmail.com', 'Ashion');
        $mail->addAddress($email,  $name);

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Lời cảm ơn';
        $mail->Body    = '
        Kính gửi quý khách hàng,

Cảm ơn quý khách đã mua sắm tại shop áo đồ Ashion của chúng tôi. Chúng tôi rất vui khi biết quý khách hài lòng với sản phẩm và dịch vụ của chúng tôi.

Chúng tôi luôn mong muốn mang đến cho quý khách những trải nghiệm tốt nhất khi mua sắm tại shop của chúng tôi. Vì vậy, chúng tôi rất mong nhận được phản hồi và góp ý của quý khách để cải thiện chất lượng sản phẩm và dịch vụ của chúng tôi.

Nếu quý khách có bất kỳ thắc mắc hay yêu cầu nào, xin vui lòng liên hệ với chúng tôi qua số điện thoại 0123456789 hoặc email shop@Ashion.com. Chúng tôi luôn sẵn sàng hỗ trợ quý khách.

Một lần nữa, xin cảm ơn quý khách đã tin tưởng và ủng hộ shop áo đồ Ashion của chúng tôi. Chúc quý khách một ngày vui vẻ và hạnh phúc.

Trân trọng,
Shop áo đồ Ashion
        ';

        // Gửi email
        $mail->send();
        $mess = successAlert("Email sent successfully.");
        echo $mess;
        echo '<a href="./index.php?m=orders&a=action&d=complete&id=' . $order_id . '" class="btn btn-primary">Complete</a>'; // Edit button with a link to edit_product.php
    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
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