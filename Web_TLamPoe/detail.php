<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start(); ?>
<?php 
	if(empty($_SESSION['username'])){
		header("location: http://localhost/Web_TLam/index1.php");
		exit;
	}
?>
<html>
    <head>
        <title>ALTTH Shop - Shop Bán Mỹ Phẩm, Quà Tặng Chính Hãng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="admin1/css/style_detail.css">
    </head>
    <body>
        <?php
        include './connect_db.php';
        $result = mysqli_query($kn, "SELECT * FROM `product` WHERE `id` = ".$_GET['id']);
        $product = mysqli_fetch_assoc($result);
        $imgLibrary = mysqli_query($kn, "SELECT * FROM `image_library` WHERE `product_id` = ".$_GET['id']);
        $product['image'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
		if($product['quantity']>0){
        ?>
        <div class="container">
            <h2>Chi tiết sản phẩm</h2>
            <div id="product-detail">
                <div id="product-img">
                    <img src="admin1/<?=$product['images']?>" />
                </div>
                <div id="product-info">
                    <h1><?=$product['ten']?></h1>
                    <label>Giá: </label><span class="product-price"><?= number_format($product['price'], 0, ",", ".") ?> VND</span><br/>
                    <form id="add-to-cart-form" action="cart.php?action=add" method="POST" >
						<input type="text" value="1" name="quantity[<?= $product['id']?>]" size="2" /><br>
						<input type="submit" value="Mua sản phẩm" />
					</form>
                    <?php if(!empty($product['images'])){ ?>
                    <div id="gallery">
                        <ul>
                            <?php foreach($product['image'] as $img) { ?>
                                <li><img src="admin1/<?=$img['path']?>" /></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                <div class="clear-both"></div>
                <?=$product['content']?>
            </div>
        </div>
		<?php }else{ ?>
		<div class="container">
            <h2>Chi tiết sản phẩm</h2>
            <div id="product-detail">
                <div id="product-img">
                    <img src="admin1/<?=$product['images']?>" />
                </div>
                <div id="product-info">
                    <h1><?=$product['ten']?></h1>
                    <label>Giá: </label><span class="product-price"><?= number_format($product['price'], 0, ",", ".") ?> VND</span><br/>
                    <p><h2>Hết hàng</h2></p>
                    <?php if(!empty($product['images'])){ ?>
                    <div id="gallery">
                        <ul>
                            <?php foreach($product['image'] as $img) { ?>
                                <li><img src="admin1/<?=$img['path']?>" /></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                <div class="clear-both"></div>
                <?=$product['content']?>
            </div>
        </div>
		<?php } ?>
    </body>
</html>