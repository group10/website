<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	include("mysql_connect.php");
	$serial = $_POST['select']; 
	$button = $_POST['button'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>國立臺北教育大學_學習網</title>
</head>

<body>
<div id="HEADER">
	<h2>電腦科學學習網</h2>
</div>
<div id="MAIN_NAV">
	<ul>
		<li><a href="reading.php">開始閱讀</a></li> 
		<li><a href="upload.php">檔案上傳</a></li>
		<li><a href="message.php">留言板</a></li>
		<li><a href="record.php">歷史紀錄</a></li>
		<li><a href="login.php">會員資料修改</li>
		<li><a href="group.php">管理團隊</a></li>
		<li><b>管理者專區</b></li>
		<li><a href="index.php" style="color:#FF99FF">回首頁</a></li>
	</ul>
</div>
<div id="CONTENT">
	<p>
		<h2>管理者專區<br/></h2>
		<br/>
		<br/>
		<center>
		<?php
			
			if($button === "新增"){
		?>
				<form name="form" method="post" action="admin_reading_done.php">
					<p>
					序號：<input type="text" name="serial" /> <br>
					類型：</h1><input type="text" name="type" /> <br>
					材料名：</h1><input type="text" name="name" /> <br>
					檔名：</h1><input type="text" name="content" /> <br>
					</p>
					<input type="submit" name="button" value="新增" />
					<p>
					</p>
				</form>
		<?php
			}
			else if($button === "修改"){
				$sql = "SELECT * FROM reading WHERE serial='$serial'";
				$result = mysql_query($sql);
											
				if (!$result) { 
					die('Invalid query: ' . mysql_error());
				}
				else{
					$row = mysql_fetch_array(mysql_query($sql)); 
		?>
					<form name="form" method="post" action="admin_reading_done.php">
						<p>
						序號：<input type="text" name="serial" value="<?php echo $row['serial']; ?>" /> <br>
						類型：</h1><input type="text" name="type" value="<?php echo $row['type']; ?>" /> <br>
						材料名：</h1><input type="text" name="name" value="<?php echo $row['name']; ?>" /> <br>
						檔名：</h1><input type="text" name="content" value="<?php echo $row['content']; ?>" /> <br>
						</p>
						<input type="submit" name="button" value="修改" />
						<p>
						</p>
					</form>
		<?php
				}
			}
			else if($button === "刪除"){
				$sql = "DELETE FROM reading WHERE serial='$serial'";//
				$result = mysql_query($sql);
											
				if (!$result) {
					die('Invalid query: ' . mysql_error());
				}
				else{
					echo "<h3>資料已刪除.....</h3>";
				}
			}	
		?>
		</center>
	</p>	
</div>
<div id="FOOTER">	
	<p>
		<br/><br/><br/><br/><br/><br/>
		<h2><center><br/>Author by <i>Yi-Chan Kao</i> & <i>Gung-Si Chen</i> </center></h2>
	</p>
</div>
</body>
</html>