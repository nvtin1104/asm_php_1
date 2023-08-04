<?php
$serializedUser = $_SESSION['current_user'];
$user = unserialize($serializedUser);
$user_id = $user->user_id;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <h3>List Order:</h3>
    <div class="container mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?
                $sql = "SELECT * FROM orders WHERE user_id = '$user_id'";
                $result = mysqli_query($mysqli, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = orderStatus($row["status"]);
                        echo "<tr>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "<td>" . $status . "</td>";
                        echo "<td>";
                        echo '<a href="./user-dashboard.php?p=order-detail&id=' . $row["order_id"] . '" class="btn btn-primary">View</a>'; // Edit button with a link to edit_product.ph
                        echo ' ';
                        if ($row["status"] == 3) {
                            echo '<a href="./user-dashboard.php?p=action&d=confirm&id=' . $row["order_id"] . '" class="btn btn-primary">Confirm</a>'; // Edit button with a link to edit_product.php
                        }
                        echo ' ';
                        if ($row["status"] != 0 && $row["status"] != 4 && $row["status"] !=5 && $row["status"] !=3) {
                            echo '<a href="./user-dashboard.php?p=action&d=cancel&id=' . $row["order_id"] . '" class="btn btn-danger">Cancel</a>'; // Edit button with a link to edit_product.php

                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>