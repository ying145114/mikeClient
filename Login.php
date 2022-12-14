<!DOCTYPE html>
<?php
//开启验证
session_start();
//获取用户名
$YongH = $_SESSION['YongH'];
//用户存在
if (isset($YongH) && $YongH <> ''){
	
	//调用主页
	echo "<script>location.href = 'index.php'</script>";
	
} 
?>
<html lang="ch">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>登录</title>
<!--引入样式-->
<link href="1/Main.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="container">
<!--头像-->
  <img src="2022.jpg" width="100px" height="100px" alt="图像丢失" style="Border-radius:50px">
<!--登录表单-->
  <form action="1/Login.php" method="post" onSubmit="return check()" >
<!--账号-->
	 <font color=" #A0FF22">当前处于测试（游客）模式</font>
  <div class="row">
    <div class="col-75">
      <label><input type="text" name="YongH" placeholder="请输入你的名字！"></label>
    </div>
  </div>
<br>
<!--登录-->
  <div class="row">
    <div class="col-75">
    <input type="submit" style="background : #66CCFF;background : rgba(102, 204, 255, 1);width : 241px;height : 37px;border-radius : 35px;" value="登录">
    </div>
  </div>
</form>
</div>
	<font>随意输入名字即可进入测试</font><font color="#FF0004">（只能使用中文）</font>
	<br>
	<font>特别鸣谢【<a href="http://www.freehost.cc"><font>免费主机</font></a>】存储支持</font>
<script>
	function check(){
		//获取姓名
		let YongH = document.getElementsByName('YongH')[0].value.trim();
//用户名验证
		//正则判断
		let YongHReg = /^[\u4E00-\u9FA5]+$/;
		//不符合规则
		if(!YongHReg.test(YongH)){
			alert('请输入正确的名字');
			return false;
		   }
		//符合规则
			return true;
	}
</script>
</body>
</html>
