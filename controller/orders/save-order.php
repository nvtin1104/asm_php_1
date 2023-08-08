<?
$save_id = $_GET['id'];
if (isset($save_id)) {
    $sql_check = "SELECT * FROM processed_order WHERE order_id = '$save_id'";
    $result = mysqli_query($mysqli, $sql_check);
    if (mysqli_fetch_assoc($result)>0){
        $mess = successAlert("Your order have been saved.");
        echo $mess;
        refreshAndGoBack();
        die();
    }
    $sql = "INSERT INTO processed_order (order_id, created_at, status, name , address, phone, user_id,product_id,quantity,total_price,note)
            SELECT order_id, created_at, status, name , address, phone, user_id,product_id,quantity,total_price,note
            FROM orders
            WHERE order_id = '$save_id';";
}
if (mysqli_query($mysqli, $sql)) {
    $result = setStatusOrder($mysqli, $save_id, 6);
    $mess = successAlert("Your order was saved.");
    echo $mess;
    refreshAndGoBack();
}
