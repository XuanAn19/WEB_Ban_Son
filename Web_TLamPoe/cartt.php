<?php
session_start();

// Kết nối cơ sở dữ liệu (kn là biến kết nối đã được khởi tạo trước đó)
include 'connect_db.php';
if (!isset($_SESSION['username'])) {
		header("location: http://localhost/Web_TLamPoe/index1.php");
		exit;
	}else{
	var_dump($_SESSION['username']);
    // Lấy tên người dùng từ session
    $user = $_SESSION['username'];
    // Truy vấn để lấy thông tin giỏ hàng từ giohangtemp
    $sql = "SELECT giohangtemp.*, product.ten AS product_name 
            FROM giohangtemp 
            INNER JOIN product ON giohangtemp.product_id = product.id 
            WHERE giohangtemp.name = '$user'";
    $result = mysqli_query($kn, $sql);
	//var_dump($result);
    // Kiểm tra kết quả truy vấn
    if ($result && mysqli_num_rows($result) > 0) {
        // Tạo một mảng để lưu trữ thông tin giỏ hàng
        $cart = array();

        // Lặp qua các mục trong giỏ hàng
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];

            // Lưu thông tin sản phẩm vào giỏ hàng
            $cart[$product_id] = $quantity;
        }

        // Lưu giỏ hàng vào session
        $_SESSION['cart'] = $cart;
    }
}

// Kiểm tra nếu giỏ hàng tồn tại trong session
if (!empty($_SESSION['cart'])) {
    // Lấy danh sách sản phẩm từ giỏ hàng
    $product_ids = array_keys($_SESSION['cart']);
    $product_ids_string = implode(",", $product_ids);

    // Truy vấn để lấy thông tin sản phẩm từ CSDL (product là bảng chứa thông tin sản phẩm)
    $sql = "SELECT * FROM product WHERE id IN ($product_ids_string)";
    $result = mysqli_query($kn, $sql);
	mysqli_close($kn);
    // Kiểm tra kết quả truy vấn
    if ($result && mysqli_num_rows($result) > 0) {
        // Lặp qua các sản phẩm trong giỏ hàng
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['id'];
            $product_name = $row['ten'];
            $quantity = $_SESSION['cart'][$product_id];
            $price = $row['price'];

            // Hiển thị thông tin giỏ hàng
            // echo "Product ID: $product_id<br>";
            // echo "Product Name: $product_name<br>";
            // echo "Quantity: $quantity<br>";
            // echo "Price: $price<br>";
            // echo "<br>";
        }
    } else {
        // Giỏ hàng rỗng
        echo "Giỏ hàng rỗng";
    }
} else {
    // Giỏ hàng rỗng
    echo "Giỏ hàng rỗng";
}

?>
<html>
    <head>
 
        <title>Giỏ Hàng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="admin1/css/style_goihang.css">
		<link rel="stylesheet" href="giaodienmenu.css">
		<link rel="stylesheet" href="giaodien.css">
    </head>
    <body>
        <?php
		$error= false;
		$success =false;
		include 'connect_db.php';
		if(!isset($_SESSION["cart"])){
			$_SESSION["cart"]=array();
		}else{
		if(isset($_GET['action'])){
			function update_cart($add = false){
			// Key = id; value = quantity
			foreach ($_POST['quantity'] as $id => $quantity) {
				if ($quantity == 0) {
					unset($_SESSION["cart"][$id]);
				} else {
					if ($add) {
						// Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
						if (isset($_SESSION["cart"][$id])) {
							// Nếu đã tồn tại, tăng số lượng lên
							$_SESSION["cart"][$id] += $quantity;
						} else {
							// Nếu chưa tồn tại, thêm sản phẩm vào giỏ hàng với số lượng mới
							$_SESSION["cart"][$id] = $quantity;
						}
					} else {
						$_SESSION["cart"][$id] = $quantity;
					}
				}
			}
		}
			switch($_GET['action']){
				case "add":
				update_cart(true);				
				//header("Location: ./cartt.php");
				break;
				
				case "delete":
					//nếu tồn tại cái id cần xóa thì ta unset cái session chứa id đó
					if(isset($_GET['id'])){
						unset($_SESSION["cart"][$_GET['id']]);
					}
					//header("Location: ./cartt.php");
				break;
				case "submit":
					if(isset($_POST['update_click'])){//Cập nhật số lượng
						update_cart();
						//header("Location: ./cartt.php");
					}elseif($_POST['order_click']){//Đặt hàng
						if(empty($_POST['name'])){
							$error="Bạn chưa nhập tên người nhận";
						}elseif(empty($_POST['phone'])){
							$error="Bạn chưa nhập số điện thoại người nhận";
						}elseif(empty($_POST['address'])){
							$error="Bạn chưa nhập địa chỉ người nhận";
						}elseif(empty($_POST['address'])){
							$error="Giỏ hàng khong có gì";
						}
						if($error==false &&!empty($_POST['quantity'])){//Xử lý lưu vào giỏ hàng
							$product = mysqli_query($kn, "SELECT * FROM `product` WHERE `id` IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
							//lấy ra
							$total =0; 
							//tạo mảng mới để lưu giỏ hàng
							$ordersProduct = array();
							while($row= mysqli_fetch_array($product)){
								$ordersProduct[] = $row;//lưu vào cho khỏi mất
								$total += $row['price']*$_POST['quantity'][$row['id']];								
							}
							$kq=true;
							foreach ($ordersProduct as $key => $product) {                              
								if(($_POST['quantity'][$product['id']])>$product['quantity']){
									$error="Sản phẩm ".$product['ten']." không đủ ";
									$kq=false;								
								}
							}						
							if($kq){
							$insertOrder = mysqli_query($kn, "INSERT INTO `orders`(`id`, `ten`, `phone`, `address`, `note`, `total`, `created-time`, `last-updated`) VALUES ('NULL','".$_POST['name']."','".$_POST['phone']."','".$_POST['address']."','".$_POST['note']."','".$total."','".time()."','".time()."');");
							$orderID = $kn->insert_id;
                            $insertString = "";
                            foreach ($ordersProduct as $key => $product) {                                								
									$insertString .= "(NULL, '" . $orderID . "', '" . $product['id'] . "', '" . $_POST['quantity'][$product['id']] . "', '" . $product['price'] . "', '" . time() . "', '" . time() . "')";
									if ($key != count($ordersProduct) - 1) {
                                    $insertString .= ",";
									}
									$new_quantity = $product['quantity'] - $_POST['quantity'][$product['id']];
									$updateProduct = mysqli_query($kn, "UPDATE `product` SET `quantity`='$new_quantity' WHERE `id`='".$product['id']."'");
									if (!$updateProduct) {
										$error = "Cập nhật số lượng sản phẩm thất bại";
									}								
                            }				
							$insertOrder_detail = mysqli_query($kn, "INSERT INTO `order_detail`(`id`, `orders_id`, `product_id`, `quantity`, `price`, `created-time`, `last-updated`) VALUES " . $insertString . ";");
							$success = "Đặt hàng thành công";
							
							$user = $_SESSION['username'];
							$sql_delete = "DELETE FROM giohangtemp WHERE name = '$user'";
							$kn->query($sql_delete);
							unset($_SESSION['cart']);
							
							}
						}
					}
				break;
			}
		}
		}
		//Nếu session tồn tại và k rỗng, in ra
		if(!empty($_SESSION["cart"])){
			//array_keys($_SESSION["cart"]): Lấy ra tất cả các key(id)
			//implode ; Kết dính các key lại
			$product = mysqli_query($kn, "SELECT * FROM `product` WHERE `id` IN (".implode(",", array_keys($_SESSION["cart"])).")");
		}

        ?>
		<div id="wrapper">
		<header>
	         <nav class="container">
                <div class="logo-main-menu">
                <a href="" id="logo">
                    <img src="./images/logoaltt.jpg" alt="ALTTHSHOP" width="200px">
                </a>
                
                </div>
                <div class="main-menu-right">
                    <ul id="main-menu-right2">
					<li> <?php if(isset($_SESSION['hoTen'])){echo 'Tài Khoản: '.$_SESSION['hoTen'];} ?></li>
                    <li><a href="http://localhost/Web_TLamPoe/DoiMatKhau.php"><button type="button">Đổi Mật Khẩu</button></a></li>
					<li><a href="http://localhost/Web_TLamPoe/logout.php"><button type="button">Đăng Xuất</button></a></li>
                </ul>
                </div>
             </nav>
			 </header>
			<?php if(!empty($error)){ ?>
			<?php echo "<script>
					alert('$error');
					window.history.back();
					</script>";?>
			<?php }elseif(!empty($success)){?>
			<?php echo "<script>
					alert('$success');
					</script>";?>
					<a href ="http://localhost/Web_TLamPoe/menu.php">Tiếp tục mua hàng</a>
			<?php }else{ ?>
				<a href ="http://localhost/Web_TLamPoe/menu.php" class="product-tc">Quay Lại</a>
            <h1>Giỏ hàng</h1>
			<form id="cart-form" action="cartt.php?action=submit" method="POST">
            <table>
				<tr>
					<th class ="product-number">STT</th>
					<th class ="product-name">Tên Sản Phẩm</th>
					<th class ="product-img">Ảnh sản phẩm</th>
					<th class ="product-price">Đơn giá</th>
					<th class ="product-quantity">Số lượng</th>
					<th class ="total-money">Thành tiền</th>
					<th class ="product-delete">Xóa</th>
				</tr>
				<?php 
				if(!empty($product)){
						$stt=1;
						$total=0;
					while($row =mysqli_fetch_array($product)){ ?>
					<tr>
						<td class ="product-number"><?= $stt; ?></td>
						<td class ="product-name"><?= $row['ten'] ?></td>
						<td class ="product-img"><img src="admin1/<?= $row['images'] ?>"/></td>
						<td class ="product-price"><?= number_format($row['price'], 0, ",", ".") ?></td>
						<td class ="product-quantity"><input type="text" value="<?= number_format($_SESSION["cart"][$row['id']], 0, ",", ".") ?>" name="quantity[<?= $row['id'] ?>]" /></td>
						<td class ="total-money"><?= number_format($row['price']*$_SESSION["cart"][$row['id']], 0, ",", ".") ?></td>
						<td class ="product-delete"><a href="cartt.php?action=delete&id=<?=$row['id'] ?>">Xóa</td>
					</tr>
						<?php 
						$total +=$row['price']*$_SESSION["cart"][$row['id']];
						$stt++;
						}?>
						<tr id="row-total">
							<td class ="product-number">&nbsp;</td>
							<td class ="product-name">Tổng tiền</td>
							<td class ="product-img">&nbsp;</td>
							<td class ="product-price">&nbsp;</td>
							<td class ="product-quantity">&nbsp;</td>
							<td class ="total-money"><?= number_format($total, 0, ",", ".") ?></td>
							<td class ="product-delete"></td>
						</tr>
				<?php } ?>				
				</table>
			<div id="form-button">
					<input type="submit" name="update_click" value="Cập nhật">
				</div>
			<table>
			<div class="label_list">
			<!--<div><label class="name">Tài khoản đặt: </label><?php echo $_SESSION['username']; ?></div>-->
			<div><label class="name">Người nhận: </label><input type="text" name="name" value="" /></div>
			<div><label class="name">Điện thoại: </label><input type="text" name="phone" value="" /></div>
			<div><label class="name">Địa chỉ: </label><input type="text" name="address" value="" /></div>
			<div><label class="name">Ghi chú: </label><textarea type="text" name="note" col="50" rows="7" ></textarea></div>
			<input type="submit" name="order_click" value="Đặt hàng" />
			</form>
			</div>
			<div class="label_list_item">
				<img src="https://th.bing.com/th/id/OIP.ddp2QKqPKbnSRSKeoSE9DwHaHX?pid=ImgDet&rs=1" alt="">
				<h3>ALTTH SHOP</h3>
			</div>
			</table>
			<?php } ?>
			<footer>
                <div>
                    <h3>Dịch vụ khách hàng</h3>
                    <ul>
                        <li><a href="https://www.google.com/">Hỏi đáp-FAQs</a></li>
                        <li><a href="https://www.google.com/">Chính sách đổi trả</a></li>
                        <li><a href="https://www.google.com/">Chính sách giao hàng</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Địa chỉ liên hệ</h3>
                    <ul>
            <li><a href="tel:036-999-9999">Điện thoại: <span>036-999-9999</span></a></li>
                        <li><a href = "mailto: altt@gmail.com">Email: <span>altt@gmail.com</span></a></li>
                        <li>Số đăng ký kinh doanh: <span>0368989898</span></li>
                        <li>Địa chỉ: Trường Đại Học Quy Nhơn, TP Quy Nhơn, Tỉnh Bình Định</li>
                    </ul>
                </div>
                <div>
                    <h3>Tuyển dụng</h3>
                    <ul>
                        <li><a href="https://www.google.com/">Thông tin tuyển dụng</a></li>
                        <li><a href="https://www.google.com/">Chính sách đãi ngộ</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Về chúng tôi</h3>
                    <ul>
                        <li><a href="https://www.google.com/">Giới thiệu</a></li>
                        <li><a href="https://www.google.com/">Blogs</a></li>
                        <li><a href="https://www.google.com/">Kế hoạch tương lai</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Mạng xã hội</h3>
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/"><img src="./images/facebook.png" alt="facebook"></a>
                            <a href="https://www.instagram.com/"><img src="./images/instagram.png" alt="instagram"></a>
                            <a href="https://www.youtube.com/"><img src="./images/youtube.png" alt="youtube"></a>
                        </li>
                    </ul>
                </div>
        </footer>
				</div>
	        </div>
			
		</div>
    </body>
</html>