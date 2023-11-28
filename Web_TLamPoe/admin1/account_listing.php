<?php
include 'header.php';
$config_name = "account";
$config_title = "thành viên";
if (!empty($_SESSION['username'])) {
	$where = "id != ". $_SESSION['username']['id'];
	$item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
	$current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
	$offset = ($current_page - 1) * $item_per_page;
	if(!empty($where)){
		$totalRecords = mysqli_query($kn, "SELECT * FROM `admin` where (".$where.")");
	}else{
		$totalRecords = mysqli_query($kn, "SELECT * FROM `admin`");
	}
	$totalRecords = $totalRecords->num_rows;
	$totalPages = ceil($totalRecords / $item_per_page);
	if(!empty($where)){
		$products = mysqli_query($kn, "SELECT * FROM `admin` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
	}else{
		$products = mysqli_query($kn, "SELECT * FROM `admin` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
	}
	mysqli_close($kn);
	?>
	<div id="member-listing" class="main-content">
		<h1>Danh sách <?=$config_title?></h1>
		<div class="listing-items">
			<div class="buttons">
				<a href="./<?=$config_name?>_editing.php">Thêm <?=$config_title?></a>
			</div>
			
			<div class="total-items">
				<span>Có tất cả <strong><?=$totalRecords?></strong> <?=$config_title?> trên <strong><?=$totalPages?></strong> trang</span>
			</div>
			<ul>
				<li class="listing-item-heading">
					<div class="listing-prop listing-username">Tên đăng nhập</div>
					
					<div class="listing-prop listing-button">
						Xóa
					</div>
					<div class="listing-prop listing-button">
						Sửa
					</div>
					<div class="listing-prop listing-privilege">
						Phân quyền
					</div>
					<div class="listing-prop listing-email">Email</div>
					<div class="listing-prop listing-fullname">Họ tên</div>
					<div class="clear-both"></div>
				<?php
				while ($row = mysqli_fetch_array($products)) {
					?>
					<li>
						<div class="listing-prop listing-username"><?= $row['Username'] ?></div>
						<div class="listing-prop listing-fullname"><?= $row['HoTen'] ?></div>
						<div class="listing-prop listing-button">
							<a href="./<?=$config_name?>_delete.php?id=<?= $row['id'] ?>">Xóa</a>
						</div>
						<div class="listing-prop listing-button">
							<a href="./<?=$config_name?>_editing.php?id=<?= $row['id'] ?>">Sửa</a>
						</div>
						<div class="listing-prop listing-privilege">
							<a href="<?=$config_name?>_privilege.php?id=<?= $row['id'] ?>">Phân quyền</a>
						</div>
						<div class="listing-prop listing-email"><?= $row['Mail'] ?></div>
						<div class="clear-both"></div>
					</li>
				<?php } ?>
			</ul>
			<?php
			include './pagination.php';
			?>
			<div class="clear-both"></div>
		</div>
	</div>
	<?php
}
include './footer.php';
?>