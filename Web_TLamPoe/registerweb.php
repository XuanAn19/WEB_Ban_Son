<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registerweb.css">
    <link rel="stylesheet" href="javascript.js">
    <title>Đăng ký tài khoản</title>
</head>
<?php
	include './connect_db.php';
	if(isset($_POST['dk']))
	{//Lay du lieu tu form
		$tendn= $_POST['user'];		
		$diaChiMail= $_POST['Mail'];
		$hoTen= $_POST['name'];
		$matKhau=($_POST['pass']);
		$repass = ($_POST['repass']);
		//1.Ket noi su lieu
		//$kn = mysqli_connect("localhost","root","","tbkhachhang") or die ("Khong co ket noi");
		//2. chon du lieu
		//3.chon bang max
		mysqli_query($kn, "'SET NAME', 'utf8'");
		//4.Xay dung cau lenh truy van
		$cauLenh="insert into tbtaikhoan(Username,Mail,HoTen,Password) values('".$tendn."','".$diaChiMail."','".$hoTen."','".$matKhau."')";
		$cauLenhKt="select * from tbtaikhoan where Username='".$tendn."'";
		//5.Thuc hien cau lenh
			//Kiem tra mat khau
		if($matKhau==$repass){
			//Kiem tra ten dang nhap co trung hay khong.
			$kqkt=mysqli_query($kn, $cauLenhKt);
			if($dong=mysqli_fetch_array($kqkt)){
				
				echo "<script>
				alert('Tai khoan da duoc dang ky, vui long dang ky voi tai khoan khac');
				window.history.back();
				</script>";
				}else{
					($kq=mysqli_query($kn, $cauLenh));
					echo "<script>
					alert('Dang ki thanh cong');
					</script>";
					header('location: giaodienmenu.php');
				}
		}else{
			echo "<script>
			alert('Nhap Mat khau khong dung');
			window.history.back();
			</script>";
		}
		//6.Lay ket qua tra ve
		//7.8. Dong
		//mysqli_close($kn);
	}
	?>
<body>
	
      <div class="login-card-container">
        <div class="login-card">
            <div class="login-card-logo">
                <img src="https://th.bing.com/th/id/OIP.ddp2QKqPKbnSRSKeoSE9DwHaHX?pid=ImgDet&rs=1" alt="logo">
            </div>
            <div class="login-card-header">
                <div><h3>ĐĂNG KÝ TÀI KHOẢN</h3>
                    <p>Vui lòng nhập đầy đủ thông tin đăng ký.</p>
                </div>
            </div>
            <div class="login-card-form" align= "center" >
				<form  action = "<?php echo ($_SERVER['PHP_SELF']);?>" method="POST">
                <div class="form-item">
                    <input type="text" name= "user" required>
                    <span class="fotm-item-icon material-symbols-outlined"></span>
                    <div class="label">Username</div>
                </div><br>
				<div class="form-item">
                    <input type="text" name="Mail" required>
                    <span class="fotm-item-icon material-symbols-outlined">
                        </span>
                    <div class="label">Email</div>
                </div><br>
				<div class="form-item">
                    <input type="text" name="name" required>
                    <span class="fotm-item-icon material-symbols-outlined">
                    </span>
                    <div class="label">Account Name</div>
                </div><br>
                <div class="form-item">
                    <input type="password" name="pass" required>
                    <span class="fotm-item-icon material-symbols-outlined">
                    </span>
                    <div class="label">Password</div>
                </div><br>
				<div class="form-item">
                    <input type="password" name= "repass" required>
                    <span class="fotm-item-icon material-symbols-outlined">
                    </span>
                    <div class="label">Repassword</div>
                </div><br>
                <div class="form-item-other">
                    <div class="checkbox">
                        <input type="checkbox" id="remembermecheckbox">
                        <label for="remembercheckbox">I Agree To The Terms Of The System. </label>
                    </div>
                </div>
                <button type="submit" name ="dk" >Register</button>
				</form>
            </div>
            <div class="login-card-footer">
                Do you already have an account? <a href="logindnweb.php">Log in</a>
            </div>
        </div>
      </div>
    </body>
</html>