<?php session_start(); ?>
<?php
require_once "connect_db.php";
// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['username'])) {
    // Người dùng chưa đăng nhập, không cần xử lý giỏ hàng, chỉ cần đăng xuất
    logout();

} else {
    // Người dùng đã đăng nhập, lưu thông tin giỏ hàng vào cơ sở dữ liệu
    $user = $_SESSION['username'];
    // // Xóa thông tin giỏ hàng cũ của người dùng trong cơ sở dữ liệu
    $sql_delete = "DELETE FROM giohangtemp WHERE name = '$user'";
    $kn->query($sql_delete);

    // Lưu thông tin giỏ hàng mới vào cơ sở dữ liệu
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
		$product_query = mysqli_query($kn, "SELECT * FROM product WHERE id = $product_id");
     if ($product_query && mysqli_num_rows($product_query) > 0) {
        $product_row = mysqli_fetch_assoc($product_query);
        $price = $product_row['price'];
}
		$sql_insert = mysqli_query($kn, "INSERT INTO giohangtemp (`id`,`name`, `product_id`, `quantity`,`price` ) 
                       VALUES ('null','".$user."', '".$product_id."', '".$quantity."','".$price."');");
        $kn->query($sql_insert);
    
	}
    // Xóa session giỏ hàng
    unset($_SESSION['cart']);

    // Thực hiện các xử lý khác khi đăng xuất
    logout();
}

// Hàm đăng xuất
function logout()
{
    // Thực hiện các xử lý đăng xuất

    // Hủy session và chuyển hướng người dùng đến trang đăng nhập hoặc trang khác
    session_unset();
    session_destroy();
    header("Location: giaodienmenu.php");
    exit();
}
?>