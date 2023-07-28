<?php
if (isset($_GET['id'])) {
    $cat_id = $_GET['id'];
    include('../../inc/connect.php');
    $sql = "DELETE FROM cat_product WHERE cat_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $cat_id);
    if (
        $stmt->execute()
    ) {
        echo "success";
        header('Refresh: 2; url=../index.php?m=category&a=cat');
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>

</body>

</html>