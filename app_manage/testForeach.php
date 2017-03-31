<?php 
/*//声明一个三维数组 
$info=array( 
	"user"=>array( 
		array(1,"zhangsan",20,"nan"), 
		array(2,"lisi",20,"nan"), 
		array(3,"wangwu",25,"nv") 
		), 
	"score"=>array( 
		array(1,100,98,95,96), 
		array(2,56,98,87,84), 
		array(3,68,75,84,79) 
		), 
	"connect"=>array( 
		array(1,'2468246',"salkh@bbs.com"), 
		array(2,'343681643',"aikdki@sina.com"), 
		array(3,'3618468',"42816@qq.com") 
		) 
	); 
//循环遍历，输出一个表格 
foreach($info as $tableName=>$table){ 
	echo "<table align='center' border='1' width=300>"; 
echo "<caption><h1>".$tableName."</h1></caption>";//以每个数组的键值作为表名 
foreach($table as $row){ 
	echo "<tr>"; 
	foreach($row as $col){ 
		echo "<td>".$col."</td>"; 
	} 
	echo "</tr>"; 
} 
echo "</table>"; 
} */

//二维数组动态赋值
/*$a=array();
$m=1;
for($j=0;$j<3;$j++){
	for($i=0;$i<4;$i++){
		$a[$j][$i]=$m++;
		echo "".$a[$j][$i] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		}
	echo "<br>";
	}

$count = count($a);
$a[1][0]=15;
echo "个数:".$count."<br>";
print_r($a);
array_multisort($a,SORT_DESC); //按照第一列大小降序排列
for($j=0;$j<3;$j++){
	for ($i=0;$i<4;$i++){
		echo "out: " . $a[$j][$i] . "&nbsp;";
		}
	echo "<br>";
	}
	
	echo array_sum($a);*/



/*//将数据库表的列值赋值给数组
	require_once('mysql_class.php');
	require_once('geohash.class.php');

	$mysql=new Mysql("localhost","root","root","geohash");
	$result=$mysql->select("store_info","");
	$key=0;
	$newarray = array();
	while ($row = mysql_fetch_array($result)) {
		$newarray[$key][0]=$distance;
		$newarray[$key][1] = $row['geohash'];
		$newarray[$key][2] = $row['id'];
		$newarray[$key][3] = $row['pic_url'];
		$newarray[$key][4] = $row['address'];
		$key++;
	}
	print_r($newarray);*/


	$info=array( 
		array("id"=>1,"name"=>"zhangsan","age"=>20,"sex"=>"nan"), 
		array("id"=>2,"name"=>"zhangsan","age"=>20,"sex"=>"nan"), 
		array("id"=>3,"name"=>"李四","age"=>20,"sex"=>"nan"),
	); 
    $aaa=array("user"=>$info);


	// print_r($info);
	$str=json_encode($aaa);
	echo ($str);
	?> 