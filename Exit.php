<?php
//开启验证
session_start();
//删除标识
unset($_SESSION['YongH']);
//返回主页
echo"<script>alert('已注销');history.go(-1);</script>";
