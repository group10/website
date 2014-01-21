<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>國立臺北教育大學_學習網</title>
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.author.value.length == 0)
          alert("作者欄位不可以空白哦！");
        else if (document.myForm.subject.value.length == 0)
          alert("主題欄位不可以空白哦！");
        else if (document.myForm.content.value.length == 0)
          alert("內容欄位不可以空白哦！");
        else
          myForm.submit();
      }
    </script>

</head>

<body>
<div id="HEADER">
	<h2>電腦科學學習網</h2>
</div>
<div id="MAIN_NAV">
	<ul>
		<li><a href="reading.php">開始閱讀</a></li>
		<li><a href="upload.php">檔案上傳</a></li>
		<li><b>留言板</b></li>
		<li><a href="record.php">歷史紀錄</a></li>
		<li><a href="login.php">會員資料修改</a></li>
		<li><a href="group.php">管理團隊</a></li>
		<li><a href="manager_login.php">管理者專區</a></li>
		<li><a href="index.php" style="color:#FF99FF">回首頁</a></li>
	</ul>
</div>
<div id="CONTENT"> 
	<p align="center"><img src="messagepicture\fig.jpg"></p>
    <?php
      require_once("dbtools.inc.php");
			
      
      $records_per_page = 5;

      
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;

      
      $link = create_connection();
			
      
      $sql = "SELECT * FROM message ORDER BY date DESC";	
      $result = execute_sql("group0", $sql, $link);

      
      $total_records = mysql_num_rows($result);

      
      $total_pages = ceil($total_records / $records_per_page);

      
      $started_record = $records_per_page * ($page - 1);

      
      mysql_data_seek($result, $started_record);

      
      $bg[0] = "#D9D9FF";
      $bg[1] = "#FFCAEE";
      $bg[2] = "#FFFFCC";
      $bg[3] = "#B9EEB9";
      $bg[4] = "#B9E9FF";

      echo "<table width='800' align='center' cellspacing='3'>";

      
      $j = 1;
      while ($row = mysql_fetch_assoc($result) and $j <= $records_per_page)
      {
        echo "<tr bgcolor='" . $bg[$j - 1] . "'>";
        echo "<td width='120' align='center'>
              <img src='messagepicture/" . mt_rand(0, 9) . ".gif'></td>";
        echo "<td>作者：" . $row["author"] . "<br>";
        echo "主題：" . $row["subject"] . "<br>";
        echo "時間：" . $row["date"] . "<hr>";
        echo $row["content"] . "</td></tr>";
        $j++;
      }
      echo "</table>" ;

      
      echo "<p align='center'>";

      if ($page > 1)
        echo "<a href='message.php?page=". ($page - 1) . "'>上一頁</a> ";

      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='message.php?page=$i'>$i</a> ";
      }

      if ($page < $total_pages)
        echo "<a href='message.php?page=". ($page + 1) . "'>下一頁</a> ";
      echo "</p>";

      
      mysql_free_result($result);
      mysql_close($link);
    ?>
    <form name="myForm" method="post" action="post.php">
      <table border="0" width="800" align="center" cellspacing="0">
        <tr bgcolor="#0084CA" align="center">
          <td colspan="2">
            <font color="#FFFFFF">請在此輸入新的留言</font></td>
        </tr>
        <tr bgcolor="#D9F2FF">
          <td width="15%">作者</td>
          <td width="85%"><input name="author" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#84D7FF">
          <td width="15%">主題</td>
          <td width="85%"><input name="subject" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#D9F2FF">
          <td width="15%">內容</td>
          <td width="85%"><textarea name="content" cols="50" rows="5"></textarea></td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="button" value="張貼留言" onClick="check_data()">　
            <input type="reset" value="重新輸入">
          </td>
        </tr>
      </table>
    </form>
</div>
<div id="FOOTER">	
	<p>
		<br/><br/><br/><br/><br/><br/>
		<h2><center><br/>Author by <i>Yi-Chan Kao</i> & <i>Gung-Si Chen</i> </center></h2>
	</p>
</div>
</body>