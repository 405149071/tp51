<?php
//需要接收到传过来的值code
//$a=$_POST["diaohao"];
//include("DBDA.class.php");
//$dx=new DBDA;
//$sql="select mingzu from minzu where daihao='{$a}'";
//$attr = $dx->Query($sql);//返回的是二维数组

//二维数组的里面，有一个民族minzu的值。最简单的做法是返回字符串，但是用JSON返回，应该怎么做。要变成JSON返回

//第一步：做一个关联数组
//（这个方法是返回二维数组的，不是关联数组）

//定义一个空数组
//$arr = array();
////然后往$arr里面放一个数据
//$arr["name"] = $attr[0][0];//索引是name
//现在是一个关联数组了,要把它变为JSON，怎么变呢？？？

$arr = array();
$arr["name"] = "张三";
//将数组转化为JSON
echo json_encode($arr);//json_encode这个方法里面需要一个数组

//调用这方法，它会将关联数组，转化成JSON数据，然后就可以返回他了
//json_encode()  这个是PHP里面，提供的一个方法，可以直接将关联数组转化成json数据



//然后在KeJian.php  就可以接收到JSON数据了
//如果是个JSON数据

?>