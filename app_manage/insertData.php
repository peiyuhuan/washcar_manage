<?php

require_once('mysql_class.php');
require_once('geohash.class.php');

$mysql=new Mysql("localhost","root","root","geohash");

$geohash=new Geohash;

//开始
$b_time = microtime(true);


$data = $mysql->select("store_info","");
$count=0;
while($row=mysql_fetch_array($data)){
	$lo=$row['longitude'];
	$la=$row['latitude'];
	$get_id=$row['id'];
//当前 geohash值
	$n_geohash = $geohash->encode($la,$lo);
/*	echo ($n_geohash);
echo ("\n");*/
$mysql->update("store_info","geohash='$n_geohash'","where id =$get_id");
$count++;
}
print $count;


*/
?>