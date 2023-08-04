<?
$order_id = $_GET['id'];
if (isset($order_id)) {
    $main_action = $_GET['d'];
    if (isset($main_action)) {
        switch ($main_action) {
            case "confirm":
                $result = setStatusOrder($mysqli, $order_id, 2);
                $mess = successAlert("Your order was successful confirmation.");
                echo $mess;
                refreshAndGoBack();
                break;
            case "delivery":
                $result = setStatusOrder($mysqli, $order_id, 3);
                $mess = successAlert("Your order was ready to deliver.");
                echo $mess;
                refreshAndGoBack();
                break;
            case "complete":
                $result = setStatusOrder($mysqli, $order_id, 5);
                $mess = successAlert("Your order has been completed.");
                echo $mess;

                echo '<script>';
                echo 'setTimeout(function() {';
                echo '   window.location.href = "./index.php?m=orders&a=orders";';
                echo '}, 2000);';
                echo '</script>';
                break;                
            case "cancel":
                $result = setStatusOrder($mysqli, $order_id, 0);
                $mess = successAlert("Your order has been cancel.");
                echo $mess;
                refreshAndGoBack();
                break;
            default:
                echo "Today is a different day";
        }
    }
}
