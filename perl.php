<?php

/**
 * 修饰符
 * I   不区分大小写的搜索
 * G 查找所有出现的(全局搜索)
 * M  看做多行 默认 ^ $作为每行的开始和结尾 使用M修饰符将^  和$ 匹配每行的开始部分
 * S 将字符串看做一行 忽略其中的换行符 
 * X  忽略正则表达式中的空白和注释
 * U 第一次匹配后停止
 * 
 * 
 * 元字符
 * \A  匹配凯欧
 * \b 匹配边界
 * \B 匹配除边界外的任意字符  例如 /sa\B/及尾部不能出现sa  
 * \d  匹配数字字符 [0-9]
 * \D 匹配非数字
 * \s 匹配空白字符
 * \S 匹配非空白字符
 * [] 字符类
 * ()一个字符分组
 * $ 匹配行尾
 * ^匹配行首
 * . 匹配除换行外的其他任意字符
 * \引出下一个字符
 * \w  匹配下划线和数字,字母
 * \W  匹配非下划线字母数字
 * 
 */
//搜索数组  
$foods = array("Pass","port","pad");
$food = preg_grep("/^p/i", $foods);//匹配以开头的字符数组  i  代表忽略大小写
var_dump($food);//array(3) { [0]=> string(4) "pass" [1]=> string(4) "port" [2]=> string(3) "pad" }
//搜索字符串
$string =  "I hava a beautiful gift,do you want have a same one gift?";
$matchs = preg_match("/\bgift\b/i",$string,$marct);//匹配是否含gift返回bool值  不区分大小写
var_dump($matchs);
var_dump($marct);
//匹配字符串所有的出现
$userinfo = "<b>nanme</b><br> send <b>class</b>";
$res =preg_match_all("/<b>(.*)<\/b>/U",$userinfo,$result);
var_dump($result[0][0]) ;
var_dump($result[0][1]) ;
echo $res;  //显示匹配得到的数目


//定向的匹配替换  将 替换成gift
$string =  "I hava a beautiful gift,do you want have a same one gift?";
$re=  preg_replace("/gift/i","smell" , $string);
echo $re;
//不传正则式的替换
$key = array("/beautiful/",'/you/');
$res = array('beautiful'=>"wonderful","you"=>"me");
echo preg_replace($key, $res, $string);

//通过回调函数的方式替换匹配到的字符串
//preg_replace_callback($key, $callback, $re)  //$key 正则式 $re 闭包函数   $re 输入的字符串 $callback 闭包函数

//显示相同字符的数目
$str1 = "abc2d";
    $str2 = "bcd1 asd '";
  echo   strspn($str2, $str1);//3
  //只是开头首字符大写
 echo  ucfirst($str2);
 
 //每个单词的首字母大写
 echo  ucwords($str2); //Bcd1 Asd
    // htmlspecialchars($string) 将特殊符号转化  符号表为
 /**
  * & &amp
  * " &quot
  * '  &#039
  * < &lt
  * > &qt
  */
 $strs= "<h1>SEE there!</h1>";
   $strs =  htmlspecialchars( $strs); //不会出输出html格式 
   var_dump($strs);
  
  

        

        
        