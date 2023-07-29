<?
$action = isset($_GET['a']) ? $_GET['a'] : '';
$module = isset($_GET['m']) ? $_GET['m'] : '';
if (empty($module) || empty($action)) {
    $module = 'pages';
    $action = 'main';
}
$path =  './' . $module . '/' . $action . '.php';
require('./controller/database/user.php');
require('./controller/database/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <?
        require('./layout/header.php')
        ?>
    </header>
    <main>
        <?
        require($path);
        ?>
    </main>
    <footer>
        <?
        require('./layout/footer.php')
        ?>
    </footer>
</body>

</html>