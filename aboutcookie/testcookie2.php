<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	
$fp = fopen('E:/a.txt', 'rb');
$contents = '';
while(!feof($fp)) {
    $contents .= fread($fp, 4096); //一次读取4096个字符
}
fclose($fp);
echo "$contents";
?>
</body>
</html>