<?php
//开启验证
session_start();
//获取用户名
$YongH = $_POST["YongH"];
if ($YongH == "管理员"){
	echo "<script>alert('该账户被禁止！');history.back()</script>;";
}else{
	$_SESSION['YongH'] = $YongH;//写入标识
	echo "<script>location.href = '../index.php'</script>";//跳转主页
}
////获取密码
//$MiM = md5($_POST["MiM"]);
////获取连接信息
//include 'db.php';
////查询账户
//$sql = "SELECT MID from Users where YongH='$YongH' ";
////执行查询
//$result = $conn->query($sql);
////判断数据
//if ($result->num_rows > 0) { 
////	登录成功
//	$_SESSION['YongH'] = $YongH;//写入标识
//	echo "<script>location.href = '../index.php'</script>";//跳转主页
//    }
////	判断失败
//else {
////删除标识
//	unset($_SESSION['YongH']);
////返回登录页
//	echo "<script>alert('账号或密码错误！');history.back()</script>;";
//	}
////关闭连接
//$conn->close();
