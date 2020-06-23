<!DOCTYPE html>
<html>
<head>
	<meta charset=“UTF-8”>
	<title></title>
</head>
<body>
	<?php
	$connect = mysqli_connect("localhost","root","","test");
	$sql = "set names utf8";
	mysqli_query($connect,$sql);
	if(!$connect)
		echo "失敗";
		
	if(isset($_POST["sure"]))
	{
		$sql = "INSERT INTO `message` 
		                    ( `PERSON`, 
		                      `CONTENT`) 
		             VALUES ('".$_POST["person"]."', 
		                     '".$_POST["content"]."')";
		mysqli_query($connect,$sql);
	}
	?>
	<form method="post">
		留言人
		<input type="text" name="person" id="">
		<br>
		留言
		<textarea name="content" cols="20" rows="3"></textarea>
		<input type="submit" name="sure" value="留言">
	</form>
	<table border="1" width="500">
		<tr>
			<td>選</td>
			<td>功能</td>
			<td>時間</td>
			<td>留言人</td>
			<td>內容</td>
		</tr>
			<?php
			$sql = "SELECT * FROM `tbl_message`";
			$result = mysqli_query($connect,$sql);
			while($row = mysqli_fetch_assoc($result))
			{
				echo "<tr>";
				echo "<td><input type='checkbox'></td>";
				echo "<td><input type='submit' value='編'><input type='submit' value='刪'></td>";
				echo "<td>".$row["TIME"]."</td>";
				echo "<td>".$row["PERSON"]."</td>";
				echo "<td>".$row["CONTENT"]."</td>";
				echo "<tr>";
			}
			?>
	</table>
</body>
</html>