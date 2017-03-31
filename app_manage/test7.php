<?php
/*$arr = array(array('name' => 'hehe','add'=>'hyb'),array('name' => '111','add'=>'ssssssssssss'));

print_r($arr);
echo("\n");
echo json_encode($arr);*/


//2
/*$arr = array('1'=>array('name'=>'张三','age'=>'23','sex'=>'男'),
			'2'=>array('name'=>'李四','age'=>'43','sex'=>'女'),
			'3'=>array('name'=>'王五','age'=>'32','sex'=>'男'),
			'4'=>array('name'=>'赵六','age'=>'12','sex'=>'女'));*/

$arr = array(array('name'=>'张三','age'=>'23','sex'=>'男'),
			array('name'=>'李四','age'=>'43','sex'=>'女'),
			array('name'=>'王五','age'=>'32','sex'=>'男'),
			array('name'=>'赵六','age'=>'12','sex'=>'女'));

print_r($arr);

$str=json_encode_ex($arr);
echo ($str);




/*require_once('mysql_class.php');
require_once('geohash.class.php');

$mysql=new Mysql("localhost","root","root","geohash");

$geohash=new Geohash;


$data = $mysql->select("store_info","");

$select=array();
while($row=mysql_fetch_array($data)){
	$select[]=array("id"=>$row['id'],"name"=>$row['name'],"address"=>$row['address'],"pic"=>$row['pic_url']);
}
// print_r(json_encode_ex($select));
print_r($select);*/


/**
* 对变量进行 JSON 编码
* @param mixed value 待编码的 value ，除了resource 类型之外，可以为任何数据类型，该函数只能接受 UTF-8 编码的数据
* @return string 返回 value 值的 JSON 形式
*/
function json_encode_ex($value)
{
	if (version_compare(PHP_VERSION,'5.4.0','<'))
	{
		$str = json_encode($value);
		$str = preg_replace_callback(
			"#\\\u([0-9a-f]{4})#i",
			function($matchs)
			{
				return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
			},
			$str
			);
		return $str;
	}
	else
	{
		return json_encode($value, JSON_UNESCAPED_UNICODE);
	}
}
// print_r($arr);


?>



