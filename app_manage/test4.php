<?php



//二维数组动态赋值
/*$a=array();
$m=1;
for($j=0;$j<3;$j++){
	for($i=0;$i<6;$i++){
		$a[$j][$i]=$m++;
		echo "".$a[$j][$i] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	echo "<br>";
}*/

/*$count = count($a);
$a[1][0]=15;
echo "个数:".$count."<br>";
print_r($a);
array_multisort($a,SORT_DESC); //按照第一列大小降序排列
for($j=0;$j<3;$j++){
	for ($i=0;$i<4;$i++){
		echo "out: " . $a[$j][$i] . "&nbsp;";
		}
	echo "<br>";
}*/
/*	
echo array_sum($a);
*/


/*$arr = array( 
 array('id' => 5, 'name' => 'aa1','age' => 7), 
array('id' => 2,'name' => 'aaa3','age' => 4), 
array('id' => 8,'name' => 'aaa10','age' => 5), 
array('id' => 1,'name' => 'aa2','age' => 2) 
); */

$arr = array( 
	array(5, 'aa1', 7), 
	array(2,'aaa3',4), 
	array(8,'aaa10',5), 
	array(1, 'aa2', 2) 
);
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
//处理 
// print_r(multi_array_sort($arr,2));
$arr2=multi_array_sort($arr,2);

foreach ($arr2 as  $value) {
	foreach ($value as$v2) {
	echo ($v2);
	echo("\t");
	}
	echo("\n");
}

exit; 
//输出 
/*Array 
( 
	[c] => Array 
	( 
		[id] => 1 
		[name] => 2 
		[age] => 2 
		) 
[b] => Array 
( 
	[id] => 2 
	[name] => 3 
	[age] => 4 
	) 
[a] => Array 
( 
	[id] => 8 
	[name] => 10 
	[age] => 5 
	) 
[d] => Array 
( 
	[id] => 5 
	[name] => 1 
	[age] => 7 
	) 
) */

?>