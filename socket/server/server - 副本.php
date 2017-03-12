<?php

set_time_limit(0);

$host = '45.32.253.198';
$port = 8888;

if(($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0)
{
	echo "creat socket failed, the reason is ".socket_strerror($socket)."\n";
}

if(($result_bind = socket_bind($socket, $host, $port)) < 0)
{
	echo "bind failed, the reason is ".socket_strerror($result_bind)."\n";
}

if(($result_listen = socket_listen($socket,4)) < 0)
{
	echo "listen failed,the reason is ".socket_strerror($result_listen)."\n";
}

$count = 0;

while(1)
{
	if(($sockmsg = socket_accept($socket)) < 0)
	{
		echo "accept socket failed , the reason is ".socket_strerror($sockmsg)."\n";
		break;
	}
	else
	{
		//send to the client;
		$msg = "测试成功\n";
		socket_write($sockmsg, $msg, strlen($msg));


		echo "哈哈，成功了";
		$buf = socket_read($sockmsg, 8192);

		$talkback = "收到的信息:$buf\n";
		echo $talkback;

		if(++$count >= 5)
		{
			break;
		}
	}

	socket_close($msgsock);


}

socket_close($socket);


?>