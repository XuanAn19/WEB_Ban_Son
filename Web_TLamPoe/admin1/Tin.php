<?php
include 'header.php';
if (!empty($_SESSION['username'])) {
    ?>
    <div class="main-content">
        <h1>Thông tin hệ thống</h1>
        <div class="listing-items">
            <img style="max-width: 100%; height: 300px;" src="../images/logoaltt.jpg" />
			<ul>
            <li>Điện thoại:<a href="tel:036-999-9999"> <span>036-999-9999</span></a></li>
                        <li>Email:<a href = "mailto: altt@gmail.com"> <span>altt@gmail.com</span></a></li>
                        <li>Số đăng ký kinh doanh: <span>0368989898</span></li>
                        <li>Địa chỉ: Trường Đại Học Quy Nhơn, TP Quy Nhơn, Tỉnh Bình Định</li>
            </ul>
            <div class="clear-both"></div>
        </div>
    </div>
    <?php
}
include './footer.php';
?>