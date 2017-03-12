<html>
<head></head>
<body>
<?php
	
	$data = $_POST['data'];

	$arry = json_decode($data, true); 
	
	$username = $arry["name"];
	
	//echo $name;

	$password = $arry["pass"];

	//echo $password;

	/*$data = $_POST['data'];


	$username = $_POST['username'];
	$password = $_POST['password'];*/
	
	

	$connect = mysql_connect("yingwanwan.cn","root","mysqlmm");

	mysql_select_db("test",$connect);

	$result = mysql_query("SELECT * FROM login WHERE username='$username' AND password = '$password'");
	//if($result = mysql_query("SELECT * FROM login WHERE username='$username' AND password = '$password'") == 1)
	//{
		//echo '0';
	//}
	//else
	//{
		while($row = mysql_fetch_array($result))
		{
			echo 1;
				
		}

	//}

	
?>
</body>
</html>