<?php session_start(); ?>
<html>
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="doimatkhau.css">
    <link rel="stylesheet" href="javascript.js">
    <title>Đổi Mật Khẩu</title>
</head>
   <?php
					include './connect_db.php';
                    if(isset($_POST['dn']))
                    {

                    $tentk = $_POST['tk'];
                    $mkcu = $_POST['mkcu'];
                    $mkmoi = $_POST['mkmoi'];
                    $remkmoi = $_POST['remkmoi'];
                    //$kn = mysqli_connect("localhost","root","","dbkhachhang") or die("tài khoản hoặc mật khẩu của bạn sai");
                    $sql = "SELECT * FROM tbtaikhoan WHERE Username = ? AND Password = ?";
                    $stmt = mysqli_prepare($kn, $sql);
                    mysqli_stmt_bind_param($stmt, "ss", $tentk, $mkcu);
                    mysqli_stmt_execute($stmt);
                    
                    $kq = mysqli_stmt_get_result($stmt);
                    
                    if (!$kq) {
                        die('Lỗi truy vấn: ' . mysqli_error($kn));
                    }else{
                        if($row = (mysqli_fetch_assoc($kq))){
                           
                            if( $tentk == $row['Username'])
                            {
                                if($mkcu == $row['Password'])
                                {
                                    if($mkmoi == $remkmoi)
                                    {
                                        $sql2 = "UPDATE tbtaikhoan SET Password = ? WHERE Username = ?";
                                        $stmt2 = mysqli_prepare($kn, $sql2);
                                        mysqli_stmt_bind_param($stmt2, "ss", $remkmoi, $tentk);
                                        mysqli_stmt_execute($stmt2);
                                        $kq2 = mysqli_stmt_affected_rows($stmt2);
                                        
                                        echo "<script> alert('doi thanh cong')  </script>";
                                    }
                                    else{
                                         echo "<script> alert('mat khau khong khop')  </script>";
									}
                                }
                                else{
                                     echo "<script> alert('ban nhap sai mat khau')  </script>";
								}
                            }
                            

                    }
                    else{
                          echo "<script> alert('khong tim thay ten tai khoan')  </script>";
                   
                          mysqli_close($kn);
                    }
					}
					}
   ?>
   <body>
    <center>
	<div class="login-card-container">
        <div class="login-card">
            <div class="login-card-logo">
                <img src="https://th.bing.com/th/id/OIP.ddp2QKqPKbnSRSKeoSE9DwHaHX?pid=ImgDet&rs=1" alt="logo">
            </div>
            <div class="login-card-header">
                <div><h3> DOI MAT KHAU</h3>
                    <p>Vui lòng nhập đầy đủ thông tin </p>
                </div>
            </div>
            <div class="login-card-form" >
				<form method ="POST" action = "<?php echo ($_SERVER['PHP_SELF']);?>" align ="center" >
                <div class="form-item">
                    <input type="text" name="tk"  required>
                   
                    <div class="label">Username</div>
                </div><br>
                <div class="form-item">
                    <input type="password" name ="mkcu"required>
                    
                    
                    <div class="label">Password</div>
                </div><br>
				<div class="form-item">
                    <input type="password" name ="mkmoi"required>
                    
                    
                    <div class="label">Newpassword</div>
                </div><br>
				 <div class="form-item">
                    <input type="password" name ="remkmoi"required>
                   
                    
                    <div class="label">Renewpassword</div>
                </div><br>
					<button type="submit" name="dn" >Đổi Mật Khẩu</button>
				</form>
            </div>
		</div>
	</div>
	</body>			   
</html>			