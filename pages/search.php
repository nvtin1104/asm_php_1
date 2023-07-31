<?
include('./controller/database/function.php');
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $_SESSION['keyword'] = $keyword;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $tb_name = 'products';
    $cl_name = 'product_name';
    // Truy vấn cơ sở dữ liệu
    $limit = 8; // Số kết quả hiển thị trên mỗi trang
    $result = pagingSearch($mysqli, $limit, $current_page, $tb_name, $cl_name, $keyword);
    $total_pages = toalPagesPagingSearch($mysqli, $limit, $tb_name, $cl_name, $keyword);
}
else {
    $keyword =  $_SESSION['keyword'];
    $current_page = isset($_GET['page'])? $_GET['page'] : 1;
    $tb_name = 'products';
    $cl_name = 'product_name';
    $limit = 8; // Số kết quả hiển thị trên mỗi trang
    $result = pagingSearch($mysqli, $limit, $current_page, $tb_name, $cl_name, $keyword);
    $total_pages = toalPagesPagingSearch($mysqli, $limit, $tb_name, $cl_name, $keyword);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="./public/css/styles.css">
    <link rel="stylesheet" href="./public/css/reponsive.css">
    <link rel="stylesheet" href="./public/css/paging.css">
    <link rel="stylesheet" href="./libs/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<style>
    .order-sort select{
        height: 40px;
    }
</style>
<body>
    <main>
        <section class="new-product">
            <div class="row row--title">
                <div class="col-md-3 col-lg-3">
                    <div class="section-title">
                        <h4>product</h4>
                    </div>
                </div>
                <form class="col-md-3 col-lg-3" action="search.php" method="GET">
                    <input type="hidden" name="keyword" value="<? echo $_SESSION['keyword']?>">
                    <div class="d-flex order-sort">
                    <label for="sort_by">Sắp xếp theo:</label>
                    <select name="sort_by" id="sort_by">
                        <option value="product_name">Tên sản phẩm</option>
                        <option value="price">Giá</option>
                        <!-- Thêm các tùy chọn sắp xếp khác nếu cần -->
                    </select>
                    </div>
                </form>
                <div class="col-md-6 col-lg-6">
                    <ul class="fiter-product">
                        <li>All</li>
                        <li> Women’s</li>
                        <li>Men’s</li>
                        <li>Kid’s</li>
                        <li>Accessories</li>
                        <li> Cosmetics</li>
                    </ul>
                </div>
            </div>
            <div class="row new-product--library">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    // Hiển thị thông tin của từng dòng dữ liệu
                    echo '<div class="col-lg-3 col-md-4 col-sm-6 mgb">
                    <div class="new-product--item">
                        <div class="new-product--item__img set-bg">
                        <img src="' . $row['image'] . '"></img>
                            <div class="hover-content">
                                <a href="#"><i class="fa-solid fa-info"></i></a>
                                <a href="#"><i class="fa-regular fa-heart"></i></a>
                                <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
                            </div>
                        </div>
                        <div class="new-product--item__text">
                            <a href=./index.php?m=pages&a=product-detail&id=' . $row["product_id"] . '" class="name">' . $row["product_name"] . '</a>
                            <div class="rating">
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <div class="price">
                                $' . $row["price"] . '
                            </div>
                        </div>
                    </div>
                </div>';
                }
                echo '<div class="pagination">';

                // Hiển thị các liên kết đến trang trước nếu trang hiện tại không phải là trang đầu
                if ($current_page > 1) {
                    echo '<a href="./index.php?m=pages&a=search&page=1"><i class="fa-solid fa-angles-left"></i></a>';
                    echo '<a href="./index.php?m=pages&a=search&page=' . ($current_page - 1) . '"><i class="fa-solid fa-angle-left"></i></a>';
                }

                // Hiển thị liên kết đến trang hiện tại
                echo '<a class="active" href="./index.php?m=pages&a=search&page=' . $current_page . '">' . $current_page . '</a>';

                // Hiển thị các liên kết đến trang sau nếu trang hiện tại không phải là trang cuối
                if ($current_page < $total_pages) {
                    echo '<a href="./index.php?m=pages&a=search&page=' . ($current_page + 1) . '"><i class="fa-solid fa-angle-right"></i></a>';
                    echo '<a href="./index.php?m=pages&a=search&page=' . $total_pages . '"><i class="fa-solid fa-angles-right"></i></a>';
                }

                echo '</div>';
                ?>
            </div>
        </section>
    </main>
</body>
<script src="./libs/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</html>