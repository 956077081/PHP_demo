<?php
//创建数组
$arr = array();
//或者$arr[] 形式
for($i =1 ;$i<10;$i++){
    $arr[] =$i;
}
//一次从数组取多个值
$arrstr="red-white-green";
list($red,$white,$green) =  explode("-",$arrstr );
echo $red."--".$white.$green; ///red--whitegreen一般用于数据库取值
echo "\r\n";
//枚举的使用
$array= range(1,5);
$arrs= range(1,30,2);//1,3,5,7,11----39  每次隔2  步长为2
print_r($arrs);// Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 )

            //数组的增删  查
//非关联数组的  插入
// 1 .头插元素  适合不是关联的数组  
$arr_link = array("name"=>"pan","age"=>"25","class"=>"计");
$arr_unshift  = array_unshift($array, "1","2");
print_r($array);
//2 尾插 (适合与非关联数组)
    $arr_push = array_push($array, "name","end");
print_r($array);



//1.  查找元素(按值查找  各种数组都适合) 返回bool值
$bool  = in_array("pan",$arr_link);
var_dump($bool);

//2.按键查找
$boolKey = array_key_exists("name", $arr_link);
var_dump($boolKey);


//3.按值查找返回该元素的键
$bool_sea = array_search("25", $arr_link);
echo $bool_sea;//age
//4. 返回所有的key
$keys = array_keys($arr_link);
print_r($keys);
//5. 返回所有的值  value
$values = array_values($arr_link);
print_r($values);

//获取当前数组的键值对通过移动数组指针来遍历数组
//1得到数组的第一行  数组指针下移
$each = each($arr_link);
print_r($each);//Array ( [1] => pan [value] => pan [0] => name [key] => name )
//2数组指针下移  //返回下一个元素对应的值
$each_next = next($arr_link);

print_r($each_next);
//3指针上移 得到  上个元素的值
$prev = prev($arr_link);
var_dump($prev);
//4返回最后一个元素的值 //计
$end = end($arr_link);
var_dump($end);


//5回调函数   向数组传递参数 并进行递归 
//call_user_func_array($callback, $arr)也是回调函数
$fun =function ($a,$b){ //参数顺序为 先传 值 在传键  $a=value $b =key
echo $a,"---".$b;
};
array_walk($arr_link,$fun);


//6 确定函数大小
$count = count($arr_link);
$size = sizeof($arr_link);
echo $count.$size;

//7显示数组值出现的频度
$ping = array_count_values($arr_link);
var_dump($ping);//["pan"]=> int(1) [25]=> int(1) ["计"]=> int(1) }
//8 显示唯一元素
$unique_arr  = array_unique($arr_link);
var_dump($unique_arr);

//数组排序
//1   逆置数组元素  保持 键值映射  (原参数不改变$arr_link)
$arr_revers = array_reverse($arr_link);
var_dump($arr_revers);
var_dump($arr_link);
//2 转换数组键值
$arr_flip = array_flip($arr_link);
var_dump($arr_flip);


//按值排序
//1.数组排序  按值 升序排序    不保持键值关系
$arr_link = array("name"=>"pan","age"=>"25","class"=>"计");
//sort( $arr_link ,0);
var_dump($arr_link);
//2保持键值对的排序//按值排序
asort($arr_link,1);//后面参数1 按照 ASCII表排序  0为 按数值排序 3 按自然认知排序 例pic1.tx pic2.txt pic3.txt 排序时
var_dump($arr_link);

//3  逆序排序  //既降序 
//rsort($arr_link);
var_dump($arr_link);
//逆序保持键值关系
arsort($arr_link);
var_dump($arr_link);

//按键排序sort前加k   保持键值关系
//1
ksort($arr_link);
var_dump($arr_link);
//2逆序 的按键排序
krsort($arr_link);
var_dump($arr_link);

//1 usort自定义排序关系  uasort 保持键值映射关系.
uasort($arr_link, function ($value ,$key){ //$value 第一个参数 $key 为数组第二个值  不断往下递归来排序 相当于泡沫排序判断条件
    $value = strlen($value);
    $key = strlen($key);
   if( $value>$key){
       return 1; //进行交换
   }else if($value == $key){
       return 0;//继续进行
   }else{
       return -1;
   }
});
var_dump($arr_link);

//合并数组 //出现相同的键会覆盖掉
$arr1= array("name"=>'pan',"class"=>'j计',"age"=>'25',"address"=>'宝');
$arr2= array("name"=>'pan',"classb"=>'j计','ageb'=>'31');
$arr_merge = array_merge($arr1,$arr2);
echo "\r\n"."<br>";
print_r($arr_merge);
echo "\r\n"."<br>";
//2 array_merge_recursive() 合并数组 回将 相同键合并为一个数组存储   不会去覆盖前面的值
$arr_merge_re= array_merge_recursive($arr1, $arr2);
var_dump($arr_merge_re);

//拆分数组
//1 截取 数组 的前两行 当 第二个参数为负数时 从后往前截取 第三个参数 为负数时代表count(arr)-|length| 的值 为截取到的数组arr[] arr[ count(arr)-|length|]
$sub_arr = array_slice($arr2, -2,1);
var_dump($sub_arr);
//2 接合数组 //返回 截取的数组相比前一个此函数可以替换掉删除的部分  会改变原函数
var_dump($arr2);
echo "<br>";
$arr_splice = array_splice($arr2,1,2,array('nub'=>"213"));
var_dump($arr2);


//数组求交集  只比较值
$inter = array_intersect($arr2, $arr1);
var_dump($inter);
//不仅比较值而且比较键
$integ_acc = array_intersect_assoc($arr2, $arr1);
var_dump($integ_acc);
$arr1= array("name"=>'pan',"class"=>'j计',"age"=>'25',"address"=>'宝');
$arr2= array("name"=>'pan',"classb"=>'j计','ageb'=>'31');
//数组求差集
$dirr = array_diff($arr2, $arr1);
var_dump($dirr);
//考虑 键值求差集
$dirr_acc = array_diff_assoc($arr2, $arr1);
var_dump($dirr_acc);


//产生随机键
$arr_ar = array_rand($arr2);
var_dump($arr_ar);
//打乱数组顺序  对于关联数组不会保持键值关系
echo "<br>";
var_dump($arr2);
$suff = shuffle($arr2);  //返回boolean 值
var_dump($suff); // bool(true)
var_dump($arr2);//array(3) { [0]=> string(2) "31" [1]=> string(3) "pan" [2]=> string(4) "j计" }


//数组求和  对于关联与否没影响
$arr =array('a'=>'1',"b"=>'2',"c"=>'3',"d"=>'4');
$arr_sum  = array_sum($arr);
var_dump($arr_sum);

//划分为多维数组  不保持键值关系
$arr_chun = array_chunk($arr, 2);//划分为 每两个数据为合并一个数组  
var_dump($arr_chun);