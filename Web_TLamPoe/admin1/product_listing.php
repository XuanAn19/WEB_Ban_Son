<?php
include 'header.php';
$config_name = "product";
$config_title = "sản phẩm";
if (!empty($_SESSION['username'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
	
    if(!empty($where)){
        $totalRecords = mysqli_query($kn, "SELECT * FROM `product` where (".$where.")");
    }else{
        $totalRecords = mysqli_query($kn, "SELECT * FROM `product`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $products = mysqli_query($kn, "SELECT * FROM `product` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $products = mysqli_query($kn, "SELECT * FROM `product` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($kn);
    ?>
    <div class="main-content">
        <h1>Danh sách <?=$config_title?></h1>
        <div class="listing-items">
            <?php if (checkPrivilege($config_name.'_editing.php')) { ?>
            <div class="buttons">
                <a href="./<?=$config_name?>_editing.php">Thêm <?=$config_title?></a>
            </div>
            <?php } ?>
            <div class="total-items">
                <span>Có tất cả <strong><?=$totalRecords?></strong> <?=$config_title?> trên <strong><?=$totalPages?></strong> trang</span>
            </div>
            <ul>
                <li class="listing-item-heading">
                    <div class="listing-prop listing-img">Ảnh</div>
                    <div class="listing-prop listing-name">Tên <?=$config_title?></div>
                    <?php if (checkPrivilege($config_name.'_delete.php?id=0')) { ?>
                    <div class="listing-prop listing-button">
                        Xóa
                    </div>
                    <?php } ?>
                    <?php if (checkPrivilege($config_name.'_editing.php?id=0')) { ?>
                    <div class="listing-prop listing-button">
                        Sửa
                    </div>
                    <?php } ?>
                    <?php if (checkPrivilege($config_name.'_editing.php?id=0&task=copy')) { ?>
                    <div class="listing-prop listing-button">
                        Copy
                    </div>
                    <?php } ?>
                    <div class="listing-prop listing-time">Ngày tạo</div>
                    <div class="listing-prop listing-time">Ngày cập nhật</div>
                    <div class="clear-both"></div>
                </li>
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <li>
                        <div class="listing-prop listing-img"><img src="<?=$row['images']?>" alt="<?= $row['ten'] ?>" title="<?= $row['ten'] ?>" /></div>
                        <div class="listing-prop listing-name"><?= $row['ten'] ?></div>
                        <?php if (checkPrivilege($config_name.'_delete.php?id='.$row['id'])) { ?>
                        <div class="listing-prop listing-button">
                            <a href="./<?=$config_name?>_delete.php?id=<?= $row['id'] ?>">Xóa</a>
                        </div>
                        <?php } ?>
                        <?php if (checkPrivilege($config_name.'_editing.php?id='.$row['id'])) { ?>
                        <div class="listing-prop listing-button">
                            <a href="./<?=$config_name?>_editing.php?id=<?= $row['id'] ?>">Sửa</a>
                        </div>
                        <?php } ?>
                        <?php if (checkPrivilege($config_name.'_editing.php?id='.$row['id'].'&task=copy')) { ?>
                        <div class="listing-prop listing-button">
                            <a href="./<?=$config_name?>_editing.php?id=<?= $row['id'] ?>&task=copy">Copy</a>
                        </div>
                        <?php } ?>
                        <div class="listing-prop listing-time"><?= date('d/m/Y H:i', $row['created-time']) ?></div>
                        <div class="listing-prop listing-time"><?= date('d/m/Y H:i', $row['last-updated']) ?></div>
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