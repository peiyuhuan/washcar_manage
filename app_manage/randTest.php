<?php

$data=array(array(1,"lo1","la1"),array(2,"lo2","la2"),array(3,"lo3","la3"));

foreach($data as $key=>$row){
	foreach($row as $va){
		echo "$va\t";
	}
	echo "\n";
}
?>