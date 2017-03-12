<?php
    $housename = $_POST["house_name"];//传感器需要查询信息的物体名称；

	
        $connect = mysql_connect("45.32.253.198", "root", "mysqlmm");
        mysql_select_db("wczy",$connect);

        $result = mysql_query("SELECT * FROM house_data WHERE name='$house_name'");
        while($row = mysql_fetch_array($result))
        {
          //socket_write($sockmsg, $row['tempreture'],strlen($row['tempreture']));
          //socket_write($sockmsg, $row['height'],strlen($row['height']));
          //socket_write($sockmsg, $row['dampness'],strlen($row['dampness']));
          echo $row['tempreture'] . " " . $row['height'] . " " . $row['dampness'];
          echo "<br />";
        }

	    mysql_close($connect);



	$user_id = $_POST["user_id"];



?>