<?php
//public function __construct(string $dsn, string $username = null, string $password = null, array $options = null) {}
try{
   $db =new PDO("mysql:host=localhost;dbname=test","root","123456"); 
//   $quert  = "select * from t1";
//    $result = $db->exec($quert);
}catch(PDOException $e){
    dir($e->getMessage()."----------");
}
//getattribute使用
//echo $db->getAttribute(PDO::ATTR_CONNECTION_STATUS); //localhost via TCP/IP
//$db->setAttribute($attribute, $e)设置参数
///var_dump($result);
//当同样的语句需要执行多次时需要准备语句  prepare 执行为 execute
function insert(){
       $query = "INSERT INTO t5 set name = :name,class = :class";
        $stmt=  $db->prepare($query);
        $name ="pan2";
        $net  = "网络";
        $stmt->bindParam(":name",$name,PDO::PARAM_STR); //bindparm  函数第二个传递的为一个应用 所以必须参数参数变量 不能传递直接字符串
        $stmt->bindParam(":class",$net,PDO::PARAM_STR);
         //$result = $stmt->execute(array(":name"=>"pan1",":class"=>"1234") );  //两种绑定参数的方式
         $stmt->execute();
        var_dump($result); //true

}
//insert();
        $result =  var_dump($db->errorInfo());//) array(3) { [0]=> string(5) "00000" [1]=> NULL [2]=> NULL }
        var_dump($db->errorCode());//string(5) "00000
function select_noPrepare()
{

        //非准备语句exec (PDO的直接函数)为执行操作 只能用于  insert delete update  查询使用  query();
        $sql = 'select * from t5';
        $res = $db->query($sql);//返回的为 PDOstate的类 
        //object(PDOStatement)#3 (1) { ["queryString"]=> string(16) "select * from t5" }
        var_dump($res);
        //遍历方式
        echo "<pre>";
        foreach ( $res as $row ){ 
            echo $row['id']."---".$row['name']."----".$row['class']."<br>";
        }
        /**
         * 返回格式
         * array(6) {
          ["id"]=>
          string(1) "1"
          [0]=>
          string(1) "1"
          ["name"]=>
          string(3) "pan"
          [1]=>
          string(3) "pan"
          ["class"]=>
          string(3) "152"
          [2]=>
          string(3) "152"
        }
         */
    
}
//select_noPrepare();

//fetch 的使用得到结果集的下一行 //FETCH_ASSOC 返回的为关联数组
    $sql = 'select * from t5';
   $stmt=  $db->query($sql);
echo "<br>"."--------------------------"."<pre>";
//while( $row =  $stmt->fetch(PDO::FETCH_ASSOC) ){
//    var_dump($row);
//}
//获取所有
//$rows = $stmt->fetchAll(PDO::FETCH_NAMED);  //一次返回所有的数据 可以传递 来选择 参数格式
//var_dump($rows);
//获取一列fetchColumn   每次执行指针下移

//PDO的事务处理
function hanleBeginTransaction(){
    //开启事务
    global $db;
    $db->beginTransaction();//开事务
    $sql  = "select * from t5";
    $res =  $db->query($sql);
    if($res){
        $db->commit();
        echo "成功!";
    }else{
        $db->rollback();
        echo "失败";
    }
}
//hanleBeginTransaction(); 开启事务

