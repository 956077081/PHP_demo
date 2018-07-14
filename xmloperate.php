<?php
  //1加载XML格式数据常用的两个函数 simplexml
    echo "<pre>";
  $xmlobj = simplexml_load_file("./xml.xml");//返回的为一个对象
  /**
  object(SimpleXMLElement)#1 (1) {
  ["library"]=>
  object(SimpleXMLElement)#2 (1) {
    ["book"]=>
    array(3) {
      [0]=>
      object(SimpleXMLElement)#3 (3) {
        ["title"]=>
        string(13) " 格林童话"
        ["content"]=>
        string(6) "故事"
        ["price"]=>
        string(2) "50"
      }
      [1]=>
      object(SimpleXMLElement)#4 (3) {
        ["title"]=>
        string(12) "绿野仙踪"
        ["content"]=>
        string(9) "稻草人"
        ["price"]=>
        string(2) "25"
      }
      [2]=>
      object(SimpleXMLElement)#5 (3) {
        ["title"]=>
        string(15) "一千零一夜"
        ["content"]=>
        string(9) "没看过"
        ["price"]=>
        string(2) "56"
      }
    }
  }
}
   *  */
  //2更据对象来操作数据
  foreach ($xmlobj->library->book  as $xml){
      var_dump($xml);
     echo  $xml->content;
  }  
  //3通过attribute()来得到标签的属性
  foreach ($xmlobj->library->book  as $xml){
        var_dump($xml);
     echo  $xml->content->attributes();  //得到标签对应的属性  
  }
    //加载 XML  DOM
  //将DOMdocument等其他节点函数转为 simpleXML格式的进行操作
  //simplexml_import_dom($node)
   
  //4返回xml信息  文本格式的
  $xmlstr = $xmlobj->asXML();
  echo htmlspecialchars($xmlstr);  //转为字符串  html不能解析无法识别的便签
//操作子节点
var_dump( $xmlobj->library->children());//library的子节点
 var_dump( $xmlobj->library->book[2]->page->children());//book[0]的子节点

//5得到节点信息Xpath
 $books = $xmlobj->xpath('/root/library/book/title');  // 返回array 参数为子节点属性  /root/library/book/title title必须为子便签 
 var_dump($books);
   
//字符串加载文件
 $strxml = '<?xml version="1.0" encoding="UTF-8"?>
<root>
    <library>
        <book> 
            <title> 格林童话</title>
            <content type="treat">故事</content>
            <price>50</price>
        </book>
        <book>
            <title>绿野仙踪</title>
            <content type="story">稻草人</content>
            <price>25</price>
        </book>
        <book>
            <title>一千零一夜</title>
            <content type="erro">没看过</content>
            <price>56</price>
            <page>
                <cost>1</cost>
                <cost>2</cost>
                <cost>3</cost>
            </page>
                                
        </book>
    </library>
</root>';
$xmlstr = simplexml_load_string($strxml);
foreach ($xmlstr->library->book as $book)
{
    var_dump($book);
}