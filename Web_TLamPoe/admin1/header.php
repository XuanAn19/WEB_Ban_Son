<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta ten="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="javascript.js">
    </head>
    <body>
        <?php
        session_start();
        include '../connect_db.php';
        include 'function.php';
		// var_dump(checkPrivilege());exit;
        // $regexResult = checkPrivilege(); //Kiểm tra quyền thành viên
        // if (!$regexResult) {
            // echo "<script>
					// alert('Bạn không có quyền truy cập chức năng này');
					// window.history.back();
					// </script>";
        // }
        if (!empty($_SESSION['username'])) { //Kiểm tra xem đã đăng nhập chưa?
            ?>
            <div id="admin-heading-panel">
                <div class="container">
                    <div class="left-panel">
                        Xin chào <span>Admin</span>
                    </div>
                    <div class="right-panel">
						<img height= "24" src ="./images/home.png"/>
						<a href="http://localhost/Web_TLamPoe/admin1/menu.php">Trang Chủ</a>
						<img height= "24" src ="./images/logout.png"/>
                        <a href="http://localhost/Web_TLamPoe/admin1/logout.php">Đăng Xuất</a>
                    </div> 
                </div>
            </div>
            <div id="content-wrapper">
                <div class="container">
                    <div class="left-menu">
                        <div class="menu-heading">Admin Menu</div>
                        <div class="menu-items">
                            <ul>
                                <li><a href="Tin.php">Thông tin hệ thống</a></li>
                                <?php if (checkPrivilege('product_listing.php')) { ?>
                                    <li><a href="product_listing.php">Sản phẩm</a></li>
                                <?php } ?>
                                <?php if (checkPrivilege('order_listing.php')) { ?>
                                    <li><a href="order_listing.php">Đơn hàng</a></li>
                                <?php } ?>
                                <?php if (checkPrivilege('account_listing.php')) { ?>
                                    <li><a href="account_listing.php">Quản lý thành viên</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>