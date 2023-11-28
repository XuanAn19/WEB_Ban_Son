<?php
include 'header.php';
if (!empty($_SESSION['username'])) {
    ?>
    <div class="main-content">
        <h1>Phân quyền thành viên</h1>
        <div id="content-box">
            <?php
            if (!empty($_GET['action']) && $_GET['action'] == "save"
            ) {
                $data = $_POST;
                $insertString = "";
                $deleteOldPrivileges = mysqli_query($kn, "DELETE FROM `phanquyen_user` WHERE `user_id` = ".$data['user_id']);
                foreach ($data['privileges'] as $insertPrivilege) {
                    $insertString .= !empty($insertString) ? "," : "";
                    $insertString .= "(NULL, " . $data['user_id'] . ", " . $insertPrivilege . ", '".time()."', '".time()."')";
                }
                $insertPrivilege = mysqli_query($kn, "INSERT INTO `phanquyen_user` (`id`, `user_id`, `phanquyen_id`, `created-time`, `last-updated`) VALUES " . $insertString);
                if(!$insertPrivilege){
                    $error = "Phân quyền không thành công. Xin thử lại";
                }
                ?>
                <?php if(!empty($error)){ ?>
                    <?php echo $error="Không có quyền nào.";?>
                <?php } else { ?>
                    Phân quyền thành công.<br> <a href="account_listing.php">Quay lại danh sách thành viên</a>
                <?php } ?>
            <?php } else { ?>
                <?php
                $phan_quyen = mysqli_query($kn, "SELECT * FROM `phan_quyen`");
                $phan_quyen = mysqli_fetch_all($phan_quyen, MYSQLI_ASSOC);
                
                $nhom_phanquyen = mysqli_query($kn, "SELECT * FROM `nhom_phanquyen` ORDER BY `nhom_phanquyen`.`position` ASC");
                $nhom_phanquyen = mysqli_fetch_all($nhom_phanquyen, MYSQLI_ASSOC);
                
                $phanquyen_user = mysqli_query($kn, "SELECT * FROM `phanquyen_user` WHERE `user_id` = ".$_GET['id']);
                $phanquyen_user = mysqli_fetch_all($phanquyen_user, MYSQLI_ASSOC);
                $currentPrivilegeList = array();
                if(!empty($phanquyen_user)){
                    foreach($phanquyen_user as $currentPrivilege){
                        $currentPrivilegeList[] = $currentPrivilege['phanquyen_id'];
                    }
                }
                ?>
                <form id="product-form" method="POST" action="?action=save" enctype="multipart/form-data">
                    <input type="submit" title="Lưu thành viên" value="" />
                    <input type="hidden" name="user_id" value="<?= $_GET['id'] ?>" />
                    <div class="clear-both"></div>
                    <?php foreach ($nhom_phanquyen as $group) { ?>
                        <div class="privilege-group">
                            <h3 class="group-name"><?= $group['ten_nhom'] ?></h3>
                            <ul>
                                <?php foreach ($phan_quyen as $privilege) { ?>
                                    <?php if ($privilege['ID_nhom'] == $group['id']) { ?>
                                        <li>
                                            <input type="checkbox"
                                                <?php if(in_array($privilege['id'], $currentPrivilegeList)){ ?> 
                                                checked=""    
                                                <?php } ?>
                                                value="<?= $privilege['id'] ?>" id="privilege_<?= $privilege['id'] ?>" name="privileges[]" />
                                            <label for="privilege_<?= $privilege['id'] ?>"><?= $privilege['ten'] ?></label>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                                <div class="clear-both"></div>
                            </ul>
                        </div>
                    <?php } ?>
                </form>
            <?php } ?>
        </div>
    </div>

    <?php
}
include './footer.php';
?>