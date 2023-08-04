<?php
$order_id = (int)$_GET['id'];
if (isset($order_id)) {
    $sql = "SELECT orders.*, products.product_name, products.price, products.image
    FROM orders
    JOIN products
    ON orders.product_id = products.product_id
    WHERE orders.order_id = '$order_id'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
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
    <a class="btn btn-sm btn-primary" href='javascript: history.go(-1)'>Back</a>
    <div class="container mt-5">
        <h2>Order Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Note</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($row)) {

                    $status = orderStatus($row['status']);
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['note'] . "</td>"; // Added a closing angle bracket here
                    // Added a closing angle bracket here
                    echo "<td>";
                    echo $status;
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>

        </table>
    </div>
    <div class="container mt-5">
        <h2>Product Order Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($row)) {
                    echo "<tr>";
                    // Assuming you have the image file name in the database under 'image' column
                    // You need to modify the image path according to your directory structure
                    echo '<td><img src="../.' . $row['image'] . '" alt="Product Image" width="80" height="80"></td>';
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . number_format($row['price'], 0, '.', ',') . "VND</td>";
                    echo "<td>" . $row['quantity'] . "</td>";

                    // Assuming the total price is calculated as price multiplied by quantity
                    echo "<td>" . number_format($row['total_price'], 0, '.', ',') . "VND</td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>