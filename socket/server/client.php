<?php
	error_reporting(E_ALL);
	set_time_limit(0);
	echo "<h2>TCp/IP Connection</h2>\n";

	$port = 8888;
	$ip = 45.32.253.198;

	if($socket=socket_create(AF_INET, SOCK_STREAM, SOL_TCP) < 0)
	{
		echo "creat socket failed,the reason is ".socket_strerror($socket)"\n";
	}
	else
	{
		echo "creat socket success\n";
	}

	echo "I am connecting to the saved ip......\n";

	$connect_result=socket_connect($ip, $port);

	if($connect_result < 0)
	{
		echo "connect to the ip failed\n";
	}
	else
	{
		echo "connect success\n";
	}

	$in="HI first blood\r\n";
	//$in .="\r\n";
	$out="";

	if(socket_write($socket, $in, strlen($in))) < 0)
    {
    	echo "socket write failed,the reason is ".socket_strerror($socket)"\n";
    }
    else
    {
    	echo "writing succuss\n";
    	echo "the content is ,<font color='red'>$in</font><br>";
    }

    while($out = socket_read($socket,8192))
    {
    	echo "接收服务器回传信息成功！\n";
	    echo "接受的内容为:",$out;
    }
    echo "关闭SOCKET...\n";
    socket_close($socket);
    echo "关闭OK\n";

 ?>