<?php
include 'header.php';
if (!empty($_SESSION['username'])) {
    ?>
    <div class="main-content">
        <h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy thành viên" : "Sửa thành viên") : "Thêm thành viên" ?></h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
               if (isset($_POST['username']) && !empty($_POST['username']) 
					&& isset($_POST['password']) && !empty($_POST['password'])
					&& isset($_POST['re_password']) && !empty($_POST['re_password'])) {
					if (empty($_POST['username'])) {
						$error = "Bạn phải nhập tên đăng nhập";
					} elseif (empty($_POST['password'])) {
						$error = "Bạn phải nhập mật khẩu";
					} elseif (empty($_POST['re_password'])) {
						$error = "Bạn phải nhập xác nhận mật khẩu";
					} elseif ($_POST['password'] != $_POST['re_password']) {
						$error = "Mật khẩu xác nhận không khớp";
					}
                    if (!isset($error)) {
						$where = "id != ". $_SESSION['username']['id'];
						//var_dump($_GET['id']); exit;
						$checkExistUser = mysqli_query($kn, "SELECT * FROM `admin` WHERE `Username` = '".$_POST['username']."' AND (".$where.")");
						
                    	if($checkExistUser->num_rows != 0){ //tồn tại user rồi
                    		$error = "Username đã tồn tại. Bạn vui lòng chọn username khác";
                    	}else{
                    		if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { //Cập nhật lại thành viên
	                        	$result = mysqli_query($kn, "UPDATE `admin` SET `HoTen` = '".$_POST['fullname']."', `Password` = '".$_POST['password']."', `Mail` = '".$_POST['mail']."' WHERE `tbtaikhoan`.`id` = ".$_GET['id'].";");
								
	                        } else { //Thêm thành viên
                        		$result = mysqli_query($kn, "INSERT INTO `admin` (`id`, `Username`, `Password`, `Hoten`,`Mail`) VALUES (NULL, '".$_POST['username']."', '".$_POST['password']."', '".$_POST['fullname']."', '".$_POST['mail']."');");
	                        }
                    	}
						
                        if (isset($result) && empty($result)) { //Nếu có lỗi xảy ra
                        	$error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        }
                    }
				}else {
                    $error = "Bạn chưa nhập thông tin khách.";
                }
                ?>
                <div class = "container">
                	<div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                	<a href = "account_listing.php">Quay lại danh sách thành viên</a>
                </div>
                <?php
            } else {
            	if (!empty($_GET['id'])) {
            		$result = mysqli_query($kn, "SELECT * FROM `admin` WHERE `id` = " . $_GET['id']);
            		$account = $result->fetch_assoc();
            	}
            	?>
                <form id="product-form" method="POST" action="<?= (!empty($account) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
                    <input type="submit" title="Lưu tài khoản" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
            			<label>Tên đăng nhập: </label>
            			<input type="text" name="username" value="<?= (!empty($account) ? $account['Username'] : "") ?>" />
            			<div class="clear-both"></div>
            		</div>
            		<div class="wrap-field">
            			<label>Mật khẩu: </label>
            			<input type="password" name="password" value="" />
            			<div class="clear-both"></div>
            		</div>
            		<div class="wrap-field">
            			<label>Xác nhận mật khẩu: </label>
            			<input type="password" name="re_password" value="" />
            			<div class="clear-both"></div>
            		</div>
            		<div class="wrap-field">
            			<label>Họ tên: </label>
            			<input type="text" name="fullname" value="<?= !empty($account) ? $account['HoTen'] : "" ?>" />
            			<div class="clear-both"></div>
            		</div>
					<div class="wrap-field">
            			<label>Mail: </label>
            			<input type="text" name="mail" value="<?= !empty($account) ? $account['Mail'] : "" ?>" />
            			<div class="clear-both"></div>
            		</div>
            	</form>
            	<div class="clear-both"></div>
    <?php } ?>
        </div>
    </div>

    <?php
}
include './footer.php';
?>