<!DOCTYPE html>
<?php 
	session_start();
	require_once "connect_db.php";
	if(empty($_SESSION['username'])){
		header("location: http://localhost/Web_TLamPoe/index1.php");
		exit;
	}
?>
<html>
<head>
	<title>ALTTH SHOP</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="admin1/css/giaodienmenu.css">
	<link rel="stylesheet" href="admin1/css/menu.css">
</head>
<body>

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
                					<li><a href="http://localhost/Web_TLamPoe/cartt.php"><button type="button">Giỏ hàng</button></a></li>

				</ul>
                </div>
             </nav>
        </header>
		<?php

		include './connect_db.php';
        $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:4;
        $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
        $offset = ($current_page - 1) * $item_per_page;// sản phẩm bắt đầu từ offset trong database
        $products = mysqli_query($kn, "SELECT * FROM `product` ORDER BY `id` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
        $totalRecords = mysqli_query($kn, "SELECT * FROM `product`");//tổng số sản phẩm
        $totalRecords = $totalRecords->num_rows;
		//ceil làm tròn
        $totalPages = ceil($totalRecords / $item_per_page);//tổng số trang
		mysqli_close($kn);
        ?>
        <section class="products">
            <div class="products-content">
			<?php
               while($row = mysqli_fetch_array($products)) {
				   if($row['quantity']>0){
                ?>
				<ul>
				<div class="product">
                <div class="product__avatar">
				<a href="http://localhost/Web_TLamPoePoe/detail.php?id=<?=$row['id'] ?>"><img src="admin1/<?=$row['images'] ?>" title="<?= $row['ten'] ?>" class="product__avatar--front"/></a>
               <a href="http://localhost/Web_TLamPoePoe/detail.php?id=<?=$row['id'] ?>"><img src="admin1/<?=$row['images'] ?>" title="<?= $row['ten'] ?>" class="product__avatar--back" /></a>
                </div>
                <div class="product__name"><a href="http://localhost/Web_TLamPoe/detail.php?id=<?= $row['id'] ?>"><?= $row['ten'] ?></div>    
                <div class="product__price">
                    <span><a href="http://localhost/Web_TLamPoe/index1.php">Giá: <?= number_format($row['price'], 0, ",", ".") ?></a><span>đ</span></span>
                    <span class="price--normal"><a href="http://localhost/Web_TLamPoe/index1.php"><?= number_format($row['price'], 0, ",", ".") ?></a><span>đ</span></span>
					</div>
					<p><?= $row['content'] ?></p>
					<br>
                        <div class="buy-button">
                            <form id="add-to-cart-form" action="cartt.php?action=add" method="POST" >
								<input type="text" value="1" name="quantity[<?= $row['id']?>]">
								<input type="submit" value="Mua sản phẩm" />
							</form>
                        </div>
                
				</ul>
			   <?php }else{ ?>
				<ul>
				<div class="product">
                <div class="product__avatar">
				<a href="http://localhost/Web_TLamPoe/detail.php?id=<?=$row['id'] ?>"><img src="admin1/<?=$row['images'] ?>" title="<?= $row['ten'] ?>" class="product__avatar--front"/></a>
               <a href="http://localhost/Web_TLamPoe/detail.php?id=<?=$row['id'] ?>"><img src="admin1/<?=$row['images'] ?>" title="<?= $row['ten'] ?>" class="product__avatar--back" /></a>
                </div>
                <div class="product__name"><a href="http://localhost/Web_TLamPoe/detail.php?id=<?= $row['id'] ?>"><?= $row['ten'] ?></div>    
                <div class="product__price">
                    <span><a href="http://localhost/Web_TLamPoe/index1.php">Giá: <?= number_format($row['price'], 0, ",", ".") ?></a><span>đ</span></span>
                    <span class="price--normal"><a href="http://localhost/Web_TLamPoe/index1.php"><?= number_format($row['price'], 0, ",", ".") ?></a><span>đ</span></span>
					</div>
					<p><?= $row['content'] ?></p>
					<br>
                        <div class="buy-button">
                            <p align ="center">Hết hàng</p>
                        </div>
				</ul>
				<?php } ?> 
			<?php } ?>   
			  
        </section>
		 <?php
                include './pagination.php';
                ?>
		
		
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
        <script src="scriptt.js"></script>
    </div>
</body>
</html>