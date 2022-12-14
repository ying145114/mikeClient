<?php
//开启验证
session_start();
//获取用户名
$YongH = $_SESSION['YongH'];
//用户存在（已登录）
if (isset($YongH) && $YongH <> ''){
	  
	//调用主页
	include ("1/MessagePage.php");
	
	} 


//用户丢失(未登录)
else{
	
	//调用登录
	include ("Login.php");
	
	}
