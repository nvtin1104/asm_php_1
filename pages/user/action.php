<?
$order_id = $_GET['id'];
if (isset($order_id)) {
    $main_action = $_GET['d'];
    if (isset($main_action)) {
        switch ($main_action) {
            case "confirm":
                $result = setStatusOrder($mysqli, $order_id, 4);
                $mess = successAlert("Your order was successful delivery.");
                echo $mess;
                refreshAndGoBack();
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
