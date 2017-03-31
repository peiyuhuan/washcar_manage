<?php


/*

require("mysql_class.php");
//查询数据输出
$db=new Mysql("localhost","root","root","near");
$select = $db->select("gps","where geohash like 'uxvxyrv%'");
$row = $db->rows($select);
if($row>=1){
	?>
	<table border="1px">
		<tr>
			<th>uers_id</th>
			<th>lo</th>
			<th>la</th>
			<th>geohash</th>
		</tr>
		<?php
		while($array = $db->myArray($select)){
			echo "<tr>";
			echo "<td>".$array['user_id']."</td>";
			echo "<td>".$array['longitude']."</td>";
			echo "<td>".$array['latitude']."</td>";
			echo "<td>".$array['geohash']."</td>";
			echo "</tr>";
		}
		?>
	</table>
	<?php
}else{
	echo "查不到任何数据!";
}

$db->dbClose();*/



//测试2：多维数组：

/*$array=array("hyb"=>array("hyb",1999,"china"),"ywh"=>array("ywh",2000,"amic"),"ok"=>array("hc",1994,"中国"));

print_r($array);

echo "我的名字：".$array['hyb'][0]."\n";
echo "我的年龄：".$array['hyb'][1]."\n";
echo "我的国家：".$array['hyb'][2]."\n";*/

$array=array(array("hyb",1999,"china"),array("ywh",2000,"amic"),array("hc",1994,"中国"));

print_r($array);

echo "我的名字：".$array['0']['1']."\n";
echo "我的年龄：".$array['1'][1]."\n";
echo "我的国家：".$array['2'][0]."\n";


?>
