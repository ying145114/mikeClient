<?php
//数据库配置
$servername = "*********";//数据库地址
$username = "************";//用户名
$password = "***********";//密码
$dbname = "f**********";//数据库名

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);//连接数据库
$conn->query("set names utf8");//中文乱码解决方法
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} //判断连接状态
