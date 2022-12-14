<?php 
//开启验证
session_start();
//获取连接信息
include 'db.php';
//获取登录用户名
$YongH = $_SESSION['YongH'];
//统一编码格式 
mysqli_query("set names utf8");
//获取发送用户名
$spenduser =  $_POST["spenduser"];
//获取前端消息数量
$spenddigit =  $_SESSION['spenddigit'];
//判断用户名是否一致（防越级）
if ($YongH == $spenduser){
	//判断请求
	$spendtype =  $_POST["type"];
	//刷新聊天记录
	if ($spendtype == "flushed"){
		//查询聊天记录
		$ReadSQL = "SELECT * FROM Message ORDER BY  MessageTime ASC";
		//执行查询
		$result = $conn->query($ReadSQL);
		//统计数据库消息数量
		$messagedigit = $result->num_rows;
		//判断是否有新消息
		if ($messagedigit != $spenddigit) {
			// 输出数据
			while($row = $result->fetch_assoc()) {
				//获取数据
				$spenduser = $row["YongH"];//发送用户名
				$spendtime = $row["MessageTime"];//发送时间
				$spendmessage = $row["Message"];//消息内容
				$spendname = $row["spendname"];//目标用户（群）
				$imgurl = $row["imgURL"];//附件
					//判断自己or他人消息
					if ($YongH == $spenduser) {
						//输出聊天记录（自己的消息）
						echo "
							<li class='li-R'>
								<div class='lidiv-R'>
									<font class='font-T'> 时间:$spendtime</font>
									<div class='frame-R'>
										<div class='triangle-R'></div>
											<span class='rotationtiao-R'>$spendmessage			
											</span>
										</div>
									</div>
								<div class='textcenter'>
									<font class='font-T'>$spenduser</font>
									<div class='avatar'><img src='../2022.jpg' draggable='false'/></div>
								</div>
							</li>
							";
					}else {
							//输出聊天记录（他人的消息）
							echo "
								<li class='li-L'>
									<div class='textcenter'>
										<font class='font-T'>$spenduser</font>
										<div class='avatar'><img src='../2022.jpg' draggable='false'/></div>
									</div>
									<div class='lidiv-L'>
										<font class='font-T'> 时间:$spendtime</font>
										<div class='frame-L'>
											<div class='triangle-L'></div>
												<span class='rotationtiao-L'>$spendmessage
												</span>
										</div>
									</div>
								</li>
							";
						}
				}
				//刷新前端消息条数
				$_SESSION['spenddigit'] = $messagedigit;
				}else {
					//超时响应
					return 444;
					//无输出
//					echo "0";
				}
		$conn->close();
		}
	//发送消息
	elseif ($spendtype == "spendmessage"){
		//获取数据
		$spenduser =  $_POST["spenduser"];//发送用户名
		$spendtime = date("Y-m-d H:i:s");//发送时间
		$spendmessage =  $_POST["spendmessage"];//消息内容
		$spendname =  $_POST["spendname"];//目标用户（群）
		//查询聊天记录
		$MessageSQL = "INSERT INTO Message (YongH,Message,MessageTime)VALUES('$spenduser','$spendmessage','$spendtime')";
		//执行插入
		$result = $conn->query($MessageSQL);
			if($result){
				//测试使用
				echo "spendmessage = > ok";
				//关闭连接
				$conn->close();
			}else{
				//测试使用
				echo "spendmessage = > no";
				//关闭连接
				$conn->close();
			}
	}
	}

else{
	//标识不存在或用户名不一致，出现越级访问
	echo "<script>alert('服务器错误！');</script>";
}
?>
