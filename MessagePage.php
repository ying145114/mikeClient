<?php
//开启验证
session_start();
//防止越级
if (isset($_SESSION['YongH']) && $_SESSION['YongH'] <> ''){
//获取用户名
$YongH = $_SESSION['YongH'];
//定义初始消息数量
$spenddigit = $_SESSION['spenddigit'] = 0;
//懒得写多聊天室逻辑了，该模块自行摸索
$spendname = "公共聊天室";
?>
<html>
<head>
<!--设置网站标题-->
	<title>聊天室</title>
<!--设置编码格式-->
	<meta charset="utf-8" />
<!--设置网站内容摘要-->
	<meta name="description" content="聊天室">
<!--设置网站图标-->
	<link rel="shortcut icon" href="#">
<!--设置网站关键词-->
	<meta name="keywords" content="我爱着他爱着她爱着我，他爱着我爱着谁爱着她">
<!--基本自适应模式-->
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<!--引用ajax实时获取聊天记录-->
	<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.11.0.min.js"></script>
</head>
<!--网站加载运行刷新聊天记录-->
<body onload="setInterval('Allmessage()', 3000)";>
<!---------------------------------------------------------------------------留言板布局--------------------------------------------->
<!--引用聊天气泡样式文件-->
<link href="1/Message.css" rel="stylesheet" type="text/css"/>
<!--全局底板-->
<div class="maindiv-A">
<!--_______________________________________________________________--><!--顶部标题栏--><!--____________________________________________________-->
<!--标题栏外容器-->
<div class="title-div-out">
<?php echo($YongH) ?><a href="1/Exit.php" style="color: #66CCFF">[注销]</a>
<!--<input type="button" value="刷新" onclick="Allmessage()">-->
<!--标题栏内容器-->
<div class="title-div-in">
【<?php echo($spendname) ?>】
</div>
</div>
<!--________________________________________________________________--><!--中部消息容器--><!--____________________________________________________-->
<!--消息外容器-->
<div class="message-div" id="message-div">
<!--消息内容器-->
<ol class="chat" id="chat">
<!--数据库对接-->
</ol>
</div>
<!--____________________________________________________--><!--底部输入组件--><!--____________________________________________________-->
<!--输入框定位-->
<div class="input-div-out">
<!--二次定位-->
<div class="input-div-in">
<!--发送消息表单（不提交/由发送按钮事件代理）-->
<form target="myIframe" action=""  onsubmit="return false;">
<!--输入栏-->
<input type="text" name="Message" id="Message" class="input-div-main" value="" onchange="buttoncss()">
<!--发送按钮-->
<button class="spend-div" id="spendbutton" onclick="spendmessage()">发送</button>
</form>
</div>
	
</div>
</div>
<!--ajax传递-------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
//聊天记录更新
	function Allmessage() {
		$.ajax({
			//请求地址
			url: "1/Message.php",
			//请求方式
			type: "POST",
			//采用同步
			Async: "true" ,
			//需要上传的数据
			data: {
				//请求类型
				"type" : "flushed",
				//请求用户
				"spenduser" : "<?php echo($YongH) ?>",
				//目标群
//				"spendname" : <?php echo($spendname) ?>,
			}, 
			//数据的格式
			dataType: "text",
			//请求成功
			success: function (data) {
				//判断是否需要更新
				if(data != 0){ 
				//输出数据
				$("#chat").html(data);
				//自动滚动到聊天记录底部
				var message = document.getElementById('message-div');
					message.scrollTop = message.scrollHeight;
				 }
			},
			//请求响应错误
			error: function () {
				alert("数据请求超时..");
			},
		});
	}
//发送消息方法
	function spendmessage(){
		//取得数据
		var spendmessage = document.getElementById("Message").value;
		//判断输入框是否为空
		if (spendmessage != ""){
			//清空输入框
			document.getElementById("Message").value="";
			//执行发送请求
				$.ajax({
				//请求地址
				url: "1/Message.php",
				//请求方式
				type: "POST",
				//需要上传的数据
				data: {
					//请求类型
					"type" : "spendmessage",
					//消息内容
					"spendmessage": String(spendmessage),
					//请求用户
					"spenduser" : "<?php echo($YongH) ?>",
					//前端消息数量
//					"spenddigit" : "<?php echo($spenddigit) ?>",
		//			"spendname" : <?php echo($QID) ?>,
				}, 
				//数据的格式
				dataType: "text",
				//请求成功
				success: function (data) {
					//打印数据
					console.log(data);
					//输出数据
				},
				//请求响应错误
				error: function () {
					alert("数据异常..");
				},
			});
		}
	}
	//发送按钮样式变换方法
	function buttoncss(){
		if (document.getElementById("Message").value != ""){
//			$("#spendbutton").toggleClass("spend-div-0");
			$("#spendbutton").css("color", "#000000");
		}
	}
</script>
</body>
</html>


<?php
}
//标识不存在，出现越级访问
else{
	echo "<script>alert('账号异常');location.href = '../index.php'</script>;";
}
	
