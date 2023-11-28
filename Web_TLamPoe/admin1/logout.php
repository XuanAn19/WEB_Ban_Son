<?php
session_start();
require_once "connect_db.php";

if (!empty($_SESSION['cart'])) {
    // Lưu thông tin giỏ hàng vào cơ sở dữ liệu
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Thực hiện truy vấn INSERT vào bảng order_detail trong cơ sở dữ liệu
        $price = 0; // Thay đổi giá trị của $price tùy theo logic của bạn để lấy giá sản phẩm từ cơ sở dữ liệu hoặc tính toán từ thông tin khác.
        $stmt = $conn->prepare("INSERT INTO order_detail (id_order, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $_SESSION['order_id'], $product_id, $quantity, $price);
        $stmt->execute();
    }
}

// Thực hiện các xử lý khác khi đăng xuất

session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Log Out</title>
	</head>
	<body>
		<script>
			alert('Đăng xuất thành công');
			window.location.href = "http://localhost/Web_TLamPoe/giaodienmenu.php";
		</script>
	</body>
</html>