<?php

error_reporting(E_ALL);
 set_time_limit(0);
 echo "<h2>TCP/IP Connection</h2>\n";
  
  $port = 8888;
  $ip = "45.32.253.198";
  
 
 $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
 if ($socket < 0) {
     echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
 }else {
     echo "OK.\n";
 }
 
 echo "试图连接对应的后端接口...\n";
 $result = socket_connect($socket, $ip, $port);
 if ($result < 0) {
     echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
 }else {
     //echo "连接OK\n";
 }
 


 //$house_name = "wczy_house";
 //$house_name = "shengyilou";
 $type = "update";
 $house_name = "yuankongjian";
 $tempreture_now = 11;
 $height_now = 11;
 $dampness_now = 11;
 $out = '';

 if(!socket_write($socket, $type, strlen($type))) {
     echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
 }
 else
 {

    if(!socket_write($socket, $house_name, strlen($house_name))) {
     echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
 }
    else{

       //echo "send messages to the server successful！\n";
       echo "修改的内容为 元空间 的相关信息。 \n";
       socket_write($socket, $tempreture_now, strlen($tempreture_now));
       socket_write($socket, $height_now, strlen($height_now));
       socket_write($socket, $dampness_now , strlen($dampness_now ));
       echo "修改成功！";
    }
}




 
 /*while($out = socket_read($socket, 8192)) {
     //echo "接收服务器回传信息成功！\n";
     echo "接受的内容为:\n";
     echo $out ;
     echo "\n";
 }*/
 
 
 //echo "关闭SOCKET...\n";
 socket_close($socket);
 //echo "关闭OK\n";
 ?>
