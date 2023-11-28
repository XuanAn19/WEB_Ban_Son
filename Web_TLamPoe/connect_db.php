<?php
	$host="localhost";
	$user="root";
	$password="";
	$database="tbkhachhang";
	$kn=mysqli_connect($host, $user, $password, $database);
	mysqli_query($kn,"SET NAMES 'utf8'");
	//Kiểm tra kết nối
	if(mysqli_connect_errno())
		echo "Kết nối thất bại".mysqli_connect_errno().exit();
	
?>