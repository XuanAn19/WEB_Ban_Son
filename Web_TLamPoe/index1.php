<?php session_start(); ?>

<html>
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin1/css/logindnweb.css">
    <link rel="stylesheet" href="javascript.js">
    <title>ALTTH Shop - Shop Bán Mỹ Phẩm, Quà Tặng Chính Hãng</title>
</head>
<body>
	<?php
		//1.ket noi
		include './connect_db.php';
		if (isset($_POST['user']) && isset($_POST['pass'])) {
        $username = $_POST['user'];
        $password = ($_POST['pass']);
		//2,3
		//4 xay dung cau lenh truy van
		$sql="select * from tbtaikhoan where Username='".$username."' and Password='".$password."'";
		//$sql1="select * from tbtaikhoan where HoTen='".$hoTen."'";
		//5.thuc hien cau lenh truy van
		$result=mysqli_query($kn,$sql);
		if($row= mysqli_fetch_array($result)){
			$_SESSION['username']=$row['Username'];
			header("location:menu.php");
			//echo "<script>
			//		alert('Dang nhap thanh cong');
			//		window.history.back();
			//		</script>";
		}else{
			echo "<script>
				alert('Nhap sai tai khoan hoac mat khau');
				window.history.back();
				</script>";
			//$error = "Tên đăng nhập hoặc mật khẩu không hợp lệ. Vui lòng thử lại.";
			header('location: index1.php');
		}		
		mysqli_close($kn);
    }
	?>

      <div class="login-card-container">
        <div class="login-card">
            <div class="login-card-logo">
                <img src="https://th.bing.com/th/id/OIP.ddp2QKqPKbnSRSKeoSE9DwHaHX?pid=ImgDet&rs=1" alt="logo">
            </div>
            <div class="login-card-header">
                <div><h3>ĐĂNG NHẬP TÀI KHOẢN</h3>
                    <p>Vui lòng nhập đầy đủ thông tin đăng nhập.</p>
                </div>
            </div>
            <div class="login-card-form" >
				<form method ="POST" action ="<?php echo ($_SERVER['PHP_SELF']);?>" align ="center" >
                <div class="form-item">
                    <input type="text" name="user"  required>
                    <span class="fotm-item-icon material-symbols-outlined">
                        </span>
                    <div class="label">Username</div>
                </div><br>
                <div class="form-item">
                    <input type="password" name ="pass"required>
                    <span class="fotm-item-icon material-symbols-outlined">
                    </span>
                    <div class="label">Password</div>
                </div>
                <div class="form-item-other">
                    <div class="checkbox">
                        <input type="checkbox" id="remembermecheckbox">
                        <label for="remembercheckbox">Remember Me</label>
                    </div>
                    <a href="http://localhost/Web_TLamPoe/DoiMatKhau.php">Forgot password</a>
                </div>
					<button type="submit" name="dn" >Login</button>
				</form>
            </div>
            <div class="login-card-footer">
                Don't have an account ? <a href="http://localhost/Web_TLamPoe/registerweb.php">Sign Up</a>
            </div>
            <div class="login-card-social">
                <div>Or Sign Up Using</div>
                <div class="login-card-social-btn">
                    <a class="facebook-logo" href="https://www.facebook.com/index.php
                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"></path>
                         </svg>
                    </a>
                    <a href="https://www.facebook.com/index.php
                    ">Facebook</a>

                    <a class="instagram-logo" href="https://www.instagram.com/?hl=en">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M16.5 7.5l0 .01"></path>
                         </svg>
                    </a>
                    <a href="https://www.instagram.com/?hl=en">Instagram</a>

                    <a class="Google-logo" href="https://www.google.com.vn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-google" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M17.788 5.108a9 9 0 1 0 3.212 6.892h-8"></path>
                         </svg> 
                    </a>
                    <a href="https://www.google.com.vn">Google</a>
                </div>    
              </div>
            </div>
        </div>
      </div>
    </body>
</html>