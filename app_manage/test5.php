<?php 
require_once('mysql_class.php');
require_once('geohash.class.php');
require_once('JsonHelper.php');

$mysql=new Mysql("localhost","root","root","geohash");

$geohash=new Geohash;

$jsonHelper=new Json_Helper;


//将数据库表的列值赋值给数组

//获取附近的信息
$n_latitude = $_GET['la'];
$n_longitude = $_GET['lo'];

//当前 geohash值
$n_geohash = $geohash->encode($n_latitude,$n_longitude);

//附近
$n = $_GET['nn'];
$like_geohash = substr($n_geohash, 0, $n);

$sql = 'select * from store_info where geohash like "'.$like_geohash.'%"';

$str=' where geohash like "'.$like_geohash.'%"';
/*echo $sql;
echo "\n";*/

$data = $mysql->select("store_info",$str);
$count = mysql_affected_rows();
echo "一共".$count."行\n";


$key=0;
$newarray = array();
while ($row = mysql_fetch_array($data)) {

	$distance = getDistance($n_longitude,$n_latitude,$row['longitude'],$row['latitude'],1);
	$newarray[$key][0]=$distance;
	$newarray[$key][1] = $row['geohash'];
	$newarray[$key][2] = $row['id'];
	$newarray[$key][3] = $row['pic_url'];
	$newarray[$key][4] = $row['address'];
	$key++;
}
print_r($newarray);

//多维数组排序
$arr2=multi_array_sort($newarray,0);
echo("<br>");
echo "排序后：";
echo("<br>");
print_r($arr2);

$str=json_encode_ex($arr2);

// $str=$jsonHelper->encode($arr2);
echo("<br>json格式：<br>");
echo str_replace('\\','',$str);

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



	/**
	*多维数组排序
	*
	*/
	function multi_array_sort($multi_array,$sort_key,$sort=SORT_ASC){ 
		if(is_array($multi_array)){ 
			foreach ($multi_array as $row_array){ 
				if(is_array($row_array)){ 
					$key_array[] = $row_array[$sort_key]; 
				}else{ 
					return false; 
				} 
			} 
		}else{ 
			return false; 
		} 
		array_multisort($key_array,$sort,$multi_array); 
		return $multi_array; 
	} 


	/**
 * 计算两点地理坐标之间的距离，根据经纬度计算距离
 * @param  Decimal $longitude1 起点经度
 * @param  Decimal $latitude1  起点纬度
 * @param  Decimal $longitude2 终点经度 
 * @param  Decimal $latitude2  终点纬度
 * @param  Int     $unit       单位 1:米 2:公里
 * @param  Int     $decimal    精度 保留小数位数
 * @return Decimal
 */
	function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit=2, $decimal=2){

    $EARTH_RADIUS = 6370.996; // 地球半径系数
    $PI = 3.1415926;

    $radLat1 = $latitude1 * $PI / 180.0;
    $radLat2 = $latitude2 * $PI / 180.0;

    $radLng1 = $longitude1 * $PI / 180.0;
    $radLng2 = $longitude2 * $PI /180.0;

    $a = $radLat1 - $radLat2;
    $b = $radLng1 - $radLng2;

    $distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
    $distance = $distance * $EARTH_RADIUS * 1000;

    if($unit==2){
    	$distance = $distance / 1000;
    }

    return round($distance, $decimal);

}
?> 