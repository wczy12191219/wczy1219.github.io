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
        $type = socket_read($sockmsg, 8192);
        $connect = mysql_connect("45.32.253.198", "root", "mysqlmm");
        mysql_select_db("wczy",$connect);

        if($type == "update")
        {
            $house_name = socket_read($sockmsg, 8192);
            $tempreture_now = socket_read($sockmsg, 8192);
            //$tempreture_now = (float)$tempreture_now;
            $height_now = socket_read($sockmsg, 8192);
            $dampness_now = socket_read($sockmsg, 8192);
            echo $house_name;
            //echo "<br>";
            echo $tempreture_now;
            //echo $tempreture_now + $height_now;
            //echo "<br>";
            echo $height_now;
            echo "\n";
            echo $dampness_now;
           // echo "<br>";
           

            mysql_query("UPDATE house_data SET tempreture = 11 WHERE name = 'yuankongjian'");
            mysql_query("UPDATE house_data SET height = 11 WHERE name = 'yuankongjian'");
            mysql_query("UPDATE house_data SET dampness = 11 WHERE name = 'yuankongjian'");
             
        }
        else
        {   
            $result = mysql_query("SELECT * FROM house_data WHERE name= $house_name");
            while($row = mysql_fetch_array($result))
            { 
              $tempreture_now = "目前你房子的温度为： ";
              $tempreture_now.=$row['tempreture'];
              $tempreture_now.=" °.\n";

              $height_now = "目前你房子的高度为： ";
              $height_now.=$row['height'];
              $height_now.=" 米.\n";

              $dampness_now = "目前你房子的湿度为： ";
              $dampness_now.=$row['dampness'];
              $dampness_now.=" 度.\n";

              socket_write($sockmsg, $tempreture_now,strlen($tempreture_now));
              echo "\n";
              socket_write($sockmsg, $height_now,strlen($height_now));
              echo "\n";
              socket_write($sockmsg, $dampness_now,strlen($dampness_now));
              echo "\n";
    
            }
        }
  

	    mysql_close($connect);


		/*//send to the client;
		$msg = "测试成功\n";
		socket_write($sockmsg, $msg, strlen($msg));


		echo "哈哈，成功了";
		$buf = socket_read($sockmsg, 8192);

		$talkback = "收到的信息:$buf\n";
		echo $talkback;
		*/

		if(++$count >= 5)
		{
			break;
		}
	}

	socket_close($sockmsg);


}

socket_close($socket);


?>