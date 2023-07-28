<?
// File: Product.php

class Product
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function deleteProduct($product_id)
    {
        // Sử dụng câu truy vấn DELETE để xóa sản phẩm dựa vào product_id
        $sql = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        
        if (!$stmt) {
            // Xử lý lỗi nếu câu truy vấn không hợp lệ
            return false;
        }

        // Gán tham số cho câu truy vấn
        $stmt->bind_param("i", $product_id);

        // Thực thi câu truy vấn
        if ($stmt->execute()) {
            // Xóa thành công
            return true;
        } else {
            // Xử lý lỗi nếu không thể xóa sản phẩm
            return false;
        }
    }
}
?>
