<?php

require_once('mysql_class.php');
require_once('geohash.class.php');

$mysql=new Mysql("localhost","root","root","geohash");

$geohash=new Geohash;
// echo $geohash;

//经纬度转换成Geohash

//获取附近的信息
$n_latitude = $_GET['la'];
$n_longitude = $_GET['lo'];

//开始
$b_time = microtime(true);

//方案A，直接利用数据库存储函数，遍历排序

//方案B geohash求出附近，然后排序

//当前 geohash值
$n_geohash = $geohash->encode($n_latitude,$n_longitude);

//附近
$n = $_GET['nn'];
$like_geohash = substr($n_geohash, 0, $n);

$sql = 'select * from store_info where geohash like "'.$like_geohash.'%"';

$str=' where geohash like "'.$like_geohash.'%"';
echo $sql;
echo "\n";

$data = $mysql->select("store_info",$str);

$count = mysql_affected_rows();
echo "一共".$count."行\n";

$arr=array();
while($row=mysql_fetch_array($data)){

    $distance = getDistance($n_longitude,$n_latitude,$row['longitude'],$row['latitude'],1);
    $key=$row['id'];
    echo '距离：'.$distance.'米';
    echo "<br>";

    // $arr[$key]['distance']=$distance;
    $arr[$key]=$distance;
   /* $arr[$key]=$row['name'];
    $arr[$key]=$row['address'];
    $arr[$key]=$row['pic_url'];
    $arr[$key]=$row['personal_note'];*/

}


foreach ($arr as $key => $value) {
 echo "$key-->$value<br>";
}

print_r($arr);
//asort() - 根据值，以升序对关联数组进行排序
asort($arr);
echo("<br>数组排序后：");
print_r($arr);


/*if(is_array($data) && !empty($data)){  
    //算出实际距离
    foreach($data as $key=>$val)  {
        $data[$key] = array();
        $distance = getDistance($n_longitude,$n_latitude,$val['longitude'],$val['latitude'],1);
        echo '距离：'.$distance.'米';
        echo '<br>';
        $data[$key]['distance'] = $distance; 

    //排序列
        $sortdistance[$key] = $distance;
    }
}
else {
    echo '错误9';
}*/

//距离排序
// array_multisort($sortdistance,SORT_ASC,$data);

//结束
$e_time = microtime(true);

echo '用时：'.($e_time - $b_time);
echo '<br>';

var_dump($data);

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