<?php
header("Content-Type: text/html; charset=utf-8") ;


session_start();
$username = $_POST["username"];
$password=$_POST["password"];
//mysql_query("set names utf8");


$con = mysql_connect("localhost", "root","930323");

mysql_select_db("login", $con);

$check_query = mysql_query("select id, name from user where name = '$username' and password = '$password'");

$arr = array();

if($result = mysql_fetch_array($check_query)){
    
    $_SESSION['username'] = $result['name'];
    $_SESSION['userid'] = $result['id'];
   // 获取当前session id
    $sessionid=session_id();
    $_SESSION['$sessionid'] = $sessionid;
    $arr = array(
    'flag'=>'success',
    'name'=>$result['name'],
    'userid'=>$result['id'],
    'sessionid'=>$sessionid
    );
    echo json_encode($arr);
   
}
else{
    $arr = array(
    'flag'=>'error',
    'name'=>'',
    'userid'=>'',
    'sessionid'=>''
    ); 
    echo json_encode($arr);

}


//echo "success";


    


?>