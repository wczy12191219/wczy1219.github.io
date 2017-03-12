<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	session_start();
	$userinfo = array(
		'name' => 'wangdi',
		'sex'  => 'man',
		'mail' => 'wczy1219@qq.com',
		'age'  => 21
	);
	header("content-type:text/html;charset=utf-8");

	$_SESSION['name'] = $userinfo['name'];
	$_SESSION['sex']  = $userinfo['sex'];
	$_SESSION['main'] = $userinfo['mail'];
	$_SESSION['userinfo']  = $userinfo;



	echo "working!";
	$value = time();
	setcookie("name",$value);
?>
</body>
</html>