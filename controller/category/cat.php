<?php
include('../inc/connect.php');
if (isset($_POST['add-cat'])) {
    $catname = $_POST['cat-name'];
    $stmt = $mysqli->prepare("INSERT INTO cat_product (cat_name) values(?)"); // Thay 'column_name' bằng tên cột chứa tên danh mục
    $stmt->bind_param("s", $catname);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: " . $mysqli->error;
    }
    $stmt->close(); // Đóng câu lệnh chuẩn bị
} else {
    echo "Form submission not detected.";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Danh sách Category</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?
                $sql = "SELECT * FROM cat_product";
                $result = $mysqli->query($sql);
                echo "<tr>";
                echo '<form method="post" action="">';
                echo '<td> auto ID</td>';
                echo "<td> <div class='form-group'>
                <input type='text' class='form-control' name='cat-name' placeholder='Tên category'>
            </div> </td>";
                echo "<td>";
                echo "<input type='submit' name='add-cat' value='Thêm Category' class='btn btn-info btn-sm'></input>";
                echo "</td>";
                echo "</tr>";
                echo '</form>';
                // Hiển thị dữ liệu trong bảng
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["cat_id"] . "</td>";
                        echo "<td>" . $row["cat_name"] . "</td>";
                        echo "<td>";
                        echo "<a href='../controller/category/delete.php?id=" . $row["cat_id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a>";
                        echo '<a href="../controller/index.php?m=category&a=edit&id=' . $row['cat_id'] . '" class="btn btn-info btn-sm ml-2 m-1" ">Chỉnh sửa</a>';
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Không có dữ liệu.</td></tr>";
                }
                $mysqli->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>