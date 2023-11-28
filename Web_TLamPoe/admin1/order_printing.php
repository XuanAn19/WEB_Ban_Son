<?php session_start(); ?>

<html>
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta ten="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_style.css">
    <title>Chi tiết đơn hàng</title>
	</head>
	<body>
	<?php 
	if (!empty($_SESSION['username'])) {
		include '../connect_db.php';
		$orders = mysqli_query($kn, "SELECT orders.ten, orders.address, orders.phone, orders.note, order_detail.*, product.ten as product_name 
	FROM orders
	INNER JOIN order_detail ON orders.id = order_detail.orders_id
	INNER JOIN product ON product.id = order_detail.product_id
	WHERE orders.id = " . $_GET['id']);
	//mysqli_fetch_all lấy hết ra hiển thị dưới dạng array có thể xem  được
		$orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
	}
		?>
		<div id="order-detail-wrapper">
            <div id="order-detail">
                <h1>Chi tiết đơn hàng</h1>
				<!--lấy ra mảng $orders[0]['?'] thông tin đầu tiên(0)-->
                <label>Người nhận: </label><span> <?= $orders[0]['ten'] ?></span><br/>
                <label>Điện thoại: </label><span><?= $orders[0]['phone'] ?> </span><br/>
                <label>Địa chỉ: </label><span> <?= $orders[0]['address'] ?></span><br/>
                <hr/>
                <h3>Danh sách sản phẩm</h3>
                <ul>
                    <?php
                    $totalQuantity = 0;
                    $totalMoney = 0;
                    foreach ($orders as $row) {
                        ?>
                        <li>
                            <span class="item-name"><?= $row['product_name'] ?></span>
                            <span class="item-quantity"> - Số Lượng: <?= $row['quantity'] ?> sản phẩm</span>
                        </li>
                        <?php
                        $totalMoney += ($row['price'] * $row['quantity']);
                        $totalQuantity += $row['quantity'];
                    }
                    ?>
                </ul>
                <hr/>
                <label>Tổng SL:</label> <?= $totalQuantity ?> - <label>Tổng tiền:</label> <?= number_format($totalMoney, 0, ",", ".") ?> đ
                <p><label>Ghi chú: </label><?= $orders[0]['note'] ?></p>
            </div>
        </div>

	</body>
</html>