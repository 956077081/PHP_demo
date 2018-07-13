<?php
   //验证Http的两个参数 
//$_SERVER['PHP_AUTH_USER']
//$_SERVER['PHP_AUTH_PW'];
//echo $_SERVER['PHP_AUTH_USER']."\r\n";
//echo $_SERVER['PHP_AUTH_PW'];
function authenticate_user ()
{
    header("WWW-Authenticate: Basic realm ='Project'");
    header("HTTP/1.1 401 unauthorized");
}
$user = $_SERVER['PHP_AUTH_USER'];
$passwd =  $_SERVER['PHP_AUTH_PW'];
if( !isset($user) ||!isset($passwd)){
    authenticate_user();
}else{
   $db = new mysqli("localhost", "root", "123456", "httpauth");
   $stm = $db->prepare("select name ,passwd from auth where name=? and passwd=?");
   $stm->bind_param("ss",$user,$passwd);
   $stm->execute();
   $stm->store_result();
   if ( $stm->num_rows == 0 ){
       authenticate_user();
   }else{
       echo "you are sucessful to login !";
   }
}
