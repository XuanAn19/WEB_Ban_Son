<?php if (!empty($_SESSION['username'])) { ?>
    <div class="clear-both"></div>
    </div>
    </div>
    <div id="admin-footer">
        <div class="container">
            <div class="left-panel">
                © Copyright 2023 - ALTT 	
            </div>
            <div class="right-panel">
                <a target="_blank" href="https://www.facebook.com/" title="Facebook"><img height="48" src="./images/facebook.png" /></a>
                <a target="_blank" href="https://www.youtube.com/" title="Youtube"><img height="48" src="./images/youtube.png" /></a>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <div class="box-content">
            Bạn chưa đăng nhập. Mời bạn quay lại đăng nhập quản trị <a href="index.php">tại đây</a>
        </div>
    </div>
<?php } ?>
</body>
</html>